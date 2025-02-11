<?php

namespace App\Exports;

use App\Models\Mikrobiologi_proses_produksi;
use App\Models\Sampel_mikrobiologi_proses_produksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithLimit;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Shared\Font;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class MikrobiologiProsesProduksiExport implements FromView, ShouldAutoSize, WithStyles, WithDrawings, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }


    public function view(): View
    {
        return view('Excel.mikrobiologi_proses_produksi.export_mikrobiologi_proses_produksi', [
            'mikrobiologi_proses_produksi' => Mikrobiologi_proses_produksi::where('id',$this->id)->first(),
            'sampel_mikrobiologi_proses_produksi' => Sampel_mikrobiologi_proses_produksi::where('id_proses_produksi', $this->id)->get(),
        ]);
    }

    public function shouldAutoSize(): bool
    {
        return true;
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo Futami');
        $drawing->setPath(public_path('assets/img/futami_bg_excel.png'));
        $drawing->setWidthAndHeight(170, 170); // Ubah ukuran gambar sesuai kebutuhan

        return $drawing;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->mergeCells('A1:C4');

                // Menghitung koordinat tengah gambar
                $imageWidth = 4; // Lebar sel dalam satuan kolom (untuk kolom A-C)
                $imageHeight = 12; // Tinggi sel dalam satuan baris (untuk baris 1-4)
                $columnStart = 'A';
                $columnEnd = 'C';
                $rowStart = 1;
                $rowEnd = 4;
                $imageWidthPixel = $imageWidth * $event->sheet->getColumnDimension($columnStart)->getWidth();
                $imageHeightPixel = $imageHeight * $event->sheet->getRowDimension($rowStart)->getRowHeight();

                $worksheet = $event->sheet->getDelegate();
                $drawingWidthPixel = $worksheet->getColumnDimension($columnStart)->getWidth();
                $drawingHeightPixel = $worksheet->getRowDimension($rowStart)->getRowHeight();

                $offsetX = ($drawingWidthPixel - $imageWidthPixel) / 2;
                $offsetY = ($drawingHeightPixel - $imageHeightPixel) / 2;

                // Menentukan koordinat tengah gambar
                $drawing = $this->drawings();
                $drawing->setOffsetX($offsetX);
                $drawing->setOffsetY($offsetY);


                $drawing = $this->drawings(); // Objek Drawing yang digunakan
                $coordinates = $columnStart.$rowStart;
                $worksheet = $event->sheet->getDelegate();
                $worksheet->getDrawingCollection()->offsetSet($coordinates, $drawing); //Menyimpan objek Drawing ke dalam DrawingCollection

                // Mengatur perataan gambar ke tengah
                $alignment = new Alignment();
                $styleArray = [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ];
                $alignment->applyFromArray($styleArray);

                $drawing->setWorksheet($worksheet); // Menetapkan worksheet untuk gambar
                $drawing->setCoordinates($coordinates); // Menetapkan koordinat gambar

                $drawing->getShadow()->setVisible(true); // Opsional: Menampilkan bayangan gambar

                // Mengatur perataan gambar ke tengah
                $drawing->setOffsetX($offsetX);
                $drawing->setOffsetY($offsetY);
                $drawing->setWidth($imageWidthPixel);
                $drawing->setHeight($imageHeightPixel);
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $styleArray = [
            // 'alignment' => [
            //     'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            //     'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            // ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];


        // Mendapatkan nomor baris terakhir yang berisi data
        $lastRow = $sheet->getHighestRow();

        // Mengatur area data yang sesuai (misalnya, mulai dari A1 hingga kolom terakhir dan baris terakhir yang berisi data)
        $startCell = 'A1';
        $endCell = $sheet->getHighestColumn() . $lastRow;
        $sheet->getStyle($startCell . ':' . $endCell)->applyFromArray($styleArray);

        // Mengatur gaya untuk kolom L
        $columnLRange = 'L1:L' . $lastRow;
        $sheet->getStyle($columnLRange)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);


        // menghapus border pada area nama dokumen
        $range = 'A5:L9';
        $borderStyle = \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_NONE;
        $sheet->getStyle($range)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => $borderStyle,
                ],
            ],
        ]);

        // Untuk mengatur center data sampelnya
        // $lastRow = $sheet->getHighestRow();
        // $range = 'A13:L13' . $lastRow;
        // $sheet->getStyle($range)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


        // mengatur size dari headernya
        $sheet->getStyle('D1:H1')->getFont()->setSize(13);
        $sheet->getStyle('D4:H4')->getFont()->setSize(13);
        $sheet->getStyle('D2:H3')->getFont()->setSize(14);



        // untuk melakukan middle align center
        $sheet->getStyle('D2:H3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D2:H3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        // $sheet->getStyle('B11:D12')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        // $sheet->getStyle('B11:D12')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);



        // untuk melakukan perataan pada cell
        // $sheet->getStyle('K7:L7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        // $sheet->getStyle('E12:H12')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


        //untuk melakuakn merge pada cell yang ada auto di tr nya
        // $sheet->mergeCells('A5:L5');
        // $sheet->mergeCells('A10:L10');

        // melakukan wrap text pada teks yang terllau panjang
        // $sheet->getStyle('K11:L11')->getAlignment()->setWrapText(true);


        // untuk mengatur border
        $borderStyleThin = \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN;
        // $sheet->getStyle('A10:L10')->getBorders()->getAllBorders()->setBorderStyle($borderStyleThin);
        // $borderStyleThin = \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN;
        // $sheet->getStyle('A10:L10')->getBorders()->getAllBorders()->setBorderStyle($borderStyleThin);
        // $sheet->getStyle('A10:L10')->getBorders()->getTop()->setBorderStyle($borderStyleThin);
        // $sheet->getStyle('D7:F7')->getBorders()->getBottom()->setBorderStyle($borderStyleThin);
        // $sheet->getStyle('D8:F8')->getBorders()->getBottom()->setBorderStyle($borderStyleThin);
        // $sheet->getStyle('K6:L6')->getBorders()->getBottom()->setBorderStyle($borderStyleThin);
        // $sheet->getStyle('K7:L7')->getBorders()->getBottom()->setBorderStyle($borderStyleThin);
        // $sheet->getStyle('K8:L8')->getBorders()->getBottom()->setBorderStyle($borderStyleThin);
        // $sheet->getStyle('K9:L9')->getBorders()->getBottom()->setBorderStyle($borderStyleThin);



        $sheet->mergeCells('D4:H4');
        $sheet->getColumnDimension('D')->setAutoSize(true);



        // untuk mengatur table terluar menjadi bold
        $highestRow = $sheet->getHighestRow();
        $borderStyle = \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM;
        $boldBorderStyle = \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK;

        // Mengatur border pada seluruh rentang
        $range = 'A1:L' . ($highestRow - 3);
        $sheet->getStyle($range)->applyFromArray([
            'borders' => [
                'outline' => [
                    'borderStyle' => $borderStyle,
                ],
            ],
        ]);

        // Mengatur border bold pada sel sebelum 4 sel terakhir
        $rangeBold = 'A1:L' . ($highestRow - 4);
        $sheet->getStyle($rangeBold)->applyFromArray([
            'borders' => [
                'outline' => [
                    'borderStyle' => $boldBorderStyle,
                ],
            ],
        ]);

        // // Menghapus border pada 4 sel terakhir
        $lastFourRowsRange = 'A' . ($lastRow - 3) . ':L' . $lastRow;
        $sheet->getStyle($lastFourRowsRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_NONE);




        // Mendapatkan nomor baris terakhir yang berisi data
        // $lastRow = $sheet->getHighestRow();

        // // Mengatur area data yang sesuai (misalnya, mulai dari A1 hingga kolom terakhir dan baris terakhir yang berisi data)
        // $startCell = 'A1';
        // $endCell = $sheet->getHighestColumn() . $lastRow;
        // $sheet->getStyle($startCell . ':' . $endCell)->applyFromArray($styleArray);

        // // Mengatur gaya untuk kolom L
        // $columnLRange = 'L1:L' . $lastRow;
        // $sheet->getStyle($columnLRange)->applyFromArray([
        //     'borders' => [
        //         'allBorders' => [
        //             'borderStyle' => Border::BORDER_THIN,
        //             'color' => ['argb' => '000000'],
        //         ],
        //     ],
        // ]);

        // // Menghapus border pada 4 sel terakhir
        // $lastFourRowsRange = 'A' . ($lastRow - 3) . ':' . $endCell;
        // $sheet->getStyle($lastFourRowsRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_NONE);

    }



}
