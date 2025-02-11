@extends('layout-operator')

<div class="content-wrapper" style="margin-top: 130px; margin-left: 250px;">
    <div class="d-flex justify-content-center p-2" style="width: 95%;">
        <form method="GET" action="{{ route('exported.files') }}" class="d-flex justify-content-center" style="width: 50%;">
            <div class="input-group w-100 shadow-sm rounded-pill">
                <input
                    type="date"
                    id="specific_date"
                    name="specific_date"
                    class="form-control rounded-pill border-0 px-4 py-2"
                    value="{{ request('specific_date') }}"
                    placeholder="Pilih tanggal"
                    style="font-size: 16px;">
                <button type="submit" class="btn btn-primary rounded-pill px-4">
                    <i class="fas fa-search me-2"></i>
                </button>
            </div>
        </form>
    </div>

    <form method="POST" action="{{ route('exported.files.download') }}">
        @csrf
        <div class="table-responsive">
            <table class="table table-bordered table-md text-center">
                <thead class="table-light">
                    <tr>
                        <th scope="col">
                            <input type="checkbox" id="select_all" /> Pilih Semua
                        </th>
                        <th scope="col">No</th>
                        <th scope="col">Nama File</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($files as $index => $file)
                        <tr class="table-row">
                            <td>
                                <input type="checkbox" name="file_ids[]" value="{{ $file->id }}" class="file-checkbox">
                            </td>
                            <td>{{ $index + 1 }}</td>
                            <td class="text-left">{{ $file->filename }}</td>
                            <td>{{ $file->type }}</td>
                            <td>{{ $file->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ $file->path }}" class="btn btn-success btn-sm px-3 py-2" download>
                                    <i class="fas fa-download"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center font-italic">Tidak ada file yang tersedia</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-danger">Download File Terpilih</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('select_all').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.file-checkbox');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });
</script>

<style>
    /* Hover effect for search button */
    .btn-primary {
        display: flex;
        align-items: center;
        gap: 5px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-primary:hover {
        background-color: #0056b3;
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    }

    /* Styling for input field */
    .form-control {
        font-size: 16px;
        background-color: #f9f9f9;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .form-control:focus {
        background-color: #fff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
        border-color: #80bdff;
    }

    /* Table hover effects */
    .table-row:hover {
        background-color: rgba(0, 0, 0, 0.05);
        transition: background-color 0.3s ease;
    }

    .table-row:active {
        background-color: rgba(0, 0, 0, 0.1);
    }
</style>
