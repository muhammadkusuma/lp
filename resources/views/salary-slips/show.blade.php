<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $salarySlip->slip_number }} - {{ $salarySlip->employee->full_name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Times New Roman', serif; background-color: #f3f4f6; }
        .sheet {
            background-color: white;
            width: 210mm;
            min-height: 148.5mm; /* A5 Size logic */
            margin: 20px auto;
            padding: 20mm;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            position: relative;
        }
        @media print {
            body { background-color: white; }
            .sheet { box-shadow: none; margin: 0; padding: 10mm; width: 100%; border: none; }
            .no-print { display: none; }
        }
        .double-border-bottom {
            border-bottom: 3px double #000;
        }
    </style>
</head>
<body class="py-10">

    <div class="no-print text-center mb-6">
        <button onclick="window.print()" class="bg-blue-700 text-white px-6 py-2 rounded shadow hover:bg-blue-800 font-bold">
            🖨️ Cetak Slip Gaji (Print)
        </button>
        <a href="{{ route('salary-slips.index') }}" class="ml-2 text-blue-600 hover:underline">Kembali</a>
    </div>

    <div class="sheet">
        {{-- Header --}}
        <div class="flex items-center gap-4 mb-4 pb-4 double-border-bottom">
            @if(isset($company->logo_url))
                <img src="{{ asset('storage/' . $company->logo_url) }}" alt="Logo" class="h-16 w-auto grayscale">
            @endif
            <div class="flex-1 text-center">
                <h1 class="text-xl font-bold uppercase tracking-widest">{{ $company->name ?? 'PERUSAHAAN' }}</h1>
                <p class="text-xs text-gray-600">{{ $company->address ?? 'Alamat Perusahaan' }}</p>
                <h2 class="text-lg font-bold mt-2 underline">SLIP GAJI</h2>
            </div>
            <div class="w-16"></div> {{-- Spacer for balance --}}
        </div>

        {{-- Info Table --}}
        <div class="grid grid-cols-2 gap-8 mb-6 text-sm">
            <table>
                <tr>
                    <td class="w-32 py-0.5 font-bold">No. Slip</td>
                    <td class="py-0.5">: {{ $salarySlip->slip_number }}</td>
                </tr>
                <tr>
                    <td class="py-0.5 font-bold">Periode</td>
                    <td class="py-0.5">: {{ DateTime::createFromFormat('!m', $salarySlip->period_month)->format('F') }} {{ $salarySlip->period_year }}</td>
                </tr>
                <tr>
                    <td class="py-0.5 font-bold">Tanggal Bayar</td>
                    <td class="py-0.5">: {{ $salarySlip->payment_date->format('d/m/Y') }}</td>
                </tr>
            </table>
            <table>
                <tr>
                    <td class="w-32 py-0.5 font-bold">Nama Karyawan</td>
                    <td class="py-0.5">: {{ $salarySlip->employee->full_name }}</td>
                </tr>
                <tr>
                    <td class="py-0.5 font-bold">Jabatan</td>
                    <td class="py-0.5">: {{ $salarySlip->employee->position }}</td>
                </tr>
                <tr>
                    <td class="py-0.5 font-bold">Status</td>
                    <td class="py-0.5">: {{ $salarySlip->employee->getEmployeeTypeLabel() }}</td>
                </tr>
            </table>
        </div>

        {{-- Salary Details --}}
        <div class="border border-gray-400 p-1 mb-6">
            <table class="w-full text-sm">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-3 py-1 text-left border-r border-gray-400 w-1/2">PENERIMAAN (EARNINGS)</th>
                        <th class="px-3 py-1 text-left w-1/2">POTONGAN (DEDUCTIONS)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border-r border-gray-400 align-top p-0">
                            {{-- Earnings List --}}
                            <table class="w-full">
                                <tr>
                                    <td class="px-3 py-1">Gaji Pokok</td>
                                    <td class="px-3 py-1 text-right">Rp {{ number_format($salarySlip->salary, 0, ',', '.') }}</td>
                                </tr>
                                @if($salarySlip->bonus > 0)
                                <tr>
                                    <td class="px-3 py-1">Tunjangan / Bonus</td>
                                    <td class="px-3 py-1 text-right">Rp {{ number_format($salarySlip->bonus, 0, ',', '.') }}</td>
                                </tr>
                                @endif
                            </table>
                        </td>
                        <td class="align-top p-0">
                            {{-- Deductions List --}}
                             <table class="w-full">
                                @if($salarySlip->deduction > 0)
                                <tr>
                                    <td class="px-3 py-1 text-red-700">Potongan Lain</td>
                                    <td class="px-3 py-1 text-right text-red-700">Rp {{ number_format($salarySlip->deduction, 0, ',', '.') }}</td>
                                </tr>
                                @else
                                <tr>
                                    <td class="px-3 py-1 italic text-gray-500">- Tidak ada potongan -</td>
                                </tr>
                                @endif
                            </table>
                        </td>
                    </tr>
                </tbody>
                <tfoot class="border-t border-gray-400 bg-gray-100">
                    <tr>
                        <td class="px-3 py-2 font-bold text-right border-r border-gray-400">TOTAL PENERIMAAN</td>
                        <td class="px-3 py-2 font-bold text-right">TOTAL POTONGAN</td>
                    </tr>
                    <tr>
                        <td class="px-3 py-1 text-right border-r border-gray-400">Rp {{ number_format($salarySlip->salary + $salarySlip->bonus, 0, ',', '.') }}</td>
                        <td class="px-3 py-1 text-right">Rp {{ number_format($salarySlip->deduction, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        {{-- NET SALARY --}}
        <div class="flex justify-end mb-8">
            <div class="border-2 border-black p-2 w-1/2">
                <div class="flex justify-between items-center">
                    <span class="font-bold text-lg uppercase">Take Home Pay</span>
                    <span class="font-bold text-xl">Rp {{ number_format($salarySlip->net_salary, 0, ',', '.') }}</span>
                </div>
                <div class="text-right text-xs italic mt-1 text-gray-600">Terbilang: # {{ strtoupper(\App\Models\SalarySlip::terbilang($salarySlip->net_salary)) }} RUPIAH #</div>
            </div>
        </div>

        {{-- Signatures --}}
        <div class="flex justify-between text-center text-sm px-8">
            <div>
                <p class="mb-16">Penerima,</p>
                <p class="font-bold underline">{{ $salarySlip->employee->full_name }}</p>
                <p class="text-xs">Karyawan</p>
            </div>
            <div>
                <p class="mb-16">Disetujui Oleh,</p>
                <p class="font-bold underline">Finance / HRD</p>
                <p class="text-xs">{{ $company->name ?? 'Perusahaan' }}</p>
            </div>
        </div>
        
        <div class="mt-12 text-[10px] text-gray-400 italic text-center">
            Dokumen ini digenerate secara otomatis oleh sistem pada {{ now()->format('d/m/Y H:i') }}.
        </div>

    </div>

</body>
</html>
