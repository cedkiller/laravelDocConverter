<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document Converter</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    {{-- Main Content --}}
    <br>

    <div style="display: flex; justify-content: center;">
        <div class="div">
            <form action="/convertDocToPdfAction" method="POST" enctype="multipart/form-data">
                @csrf 
                <div style="display: flex;">
                    <input type="file" name="file" class="form-control" accept=".doc,.docx" required>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <br>
    
    <div style="display: flex; justify-content: center;">
        <table class="table">
            <thead>
                <tr>
                    <th style="text-align: center; height: 50px; font-size: 20px; background-color: black; color: white;">File Name</th>
                    <th style="text-align: center; height: 50px; font-size: 20px; background-color: black; color: white;">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($readDocTbl as $doc)
                <tr>
                    <td style="text-align: center; height: 30px; font-size: 17px;">{{ $doc->doc_name }}</td>
                    <td style="text-align: center; height: 30px; font-size: 17px;">
                        @if($doc->doc_docx_path)
                        <a href="{{ asset('storage/' . $doc->doc_docx_path) }}" target="_blank" class="btn btn-dark">View Docx</a>
                        @endif
                        @if($doc->doc_pdf_path)
                        <a href="{{ asset('storage/' . $doc->doc_pdf_path) }}" target="_blank" class="btn btn-dark">View PDF</a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" style="text-align: center; height: 30px; font-size: 17px;">No files uploaded yet</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(isset($exeConvertDocToPdfExe))
        @if ($exeConvertDocToPdfExe == 1)
            <script>
                Swal.fire({
                    title: 'Success!',
                    text: 'File uploaded and converted successfully',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>
        @elseif ($exeConvertDocToPdfExe == 0)
            <script>
                Swal.fire({
                    title: 'Error!',
                    text: 'File conversion failed. Please try again.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                title: 'Error!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
</body>
</html>