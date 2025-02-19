@extends('layout-operator')

<div class="content-wrapper" style="margin-top: 130px; margin-left: 250px;">
    <div class="d-flex justify-content-center p-2 w-100">
        <form method="GET" action="{{ route('exported.files') }}" class="w-50">
            <div class="d-flex justify-content-center">
                <div class="input-group shadow-sm rounded-pill w-100">
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
            </div>
        </form>
    </div>

    <form method="POST" action="{{ route('exported.files.download') }}">
        @csrf
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead class="table-light">
                    <tr>
                        <th scope="col">
                            <input type="checkbox" id="select_all" /> Pilih semua
                        </th>
                        {{-- <th scope="col">No</th> --}}
                        <th scope="col">Nama File</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Tanggal Export</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($files as $index => $file)
                        <tr class="table-row">
                            <td>
                                <input type="checkbox" name="file_ids[]" value="{{ $file->id }}" class="file-checkbox">
                            </td>
                            {{-- <td>{{ $index + 1 }}</td> --}}
                            <td class="text-left">{{ $file->filename }}</td>
                            <td>{{ $file->type }}</td>
                            <td>{{ $file->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ $file->path }}" class="btn btn-success btn-sm" download>
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
        <div class="ml-3 mt-3 d-flex justify-content-start">
            <button type="submit" class="btn btn-primary">Download File Terpilih</button>
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
    @media (max-width: 768px) {
        .content-wrapper {
            margin-left: 0;
            margin-top: 100px;
            padding: 10px;
        }
        .input-group {
            flex-direction: column;
        }
        .input-group .form-control {
            border-radius: 8px;
        }
        .btn-primary {
            width: 100%;
            margin-top: 5px;
        }
        .table-responsive {
            overflow-x: auto;
        }
    }
</style>
