@php
    function angkaKeTulisan($angka)
    {
        if ($angka < 0 || $angka > 100) {
            return 'Angka di luar jangkauan';
        }

        $satuan = ['', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan'];
        $belasan = [
            'sepuluh',
            'sebelas',
            'dua belas',
            'tiga belas',
            'empat belas',
            'lima belas',
            'enam belas',
            'tujuh belas',
            'delapan belas',
            'sembilan belas',
        ];
        $puluhan = [
            '',
            '',
            'dua puluh',
            'tiga puluh',
            'empat puluh',
            'lima puluh',
            'enam puluh',
            'tujuh puluh',
            'delapan puluh',
            'sembilan puluh',
        ];

        if ($angka === 0) {
            return 'nol';
        } elseif ($angka <= 9) {
            return $satuan[$angka];
        } elseif ($angka >= 10 && $angka <= 19) {
            return $belasan[$angka - 10];
        } elseif ($angka >= 20 && $angka <= 99) {
            $puluh = (int) ($angka / 10);
            $sisa = $angka % 10;
            return $puluhan[$puluh] . ($sisa > 0 ? ' ' . $satuan[$sisa] : '');
        } else {
            // angka === 100
            return 'seratus';
        }
    }

@endphp
<!doctype html>
<html lang="en">

<head>
    <style>
        /* General */
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .text-center {
            text-align: center;
        }

        .font-bold {
            font-weight: bold;
        }

        .text-xs {
            font-size: 12px;
        }

        .mt-4 {
            margin-top: 1rem;
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }

        .table-auto {
            width: auto;
            border-collapse: collapse;
        }

        .w-full {
            width: 100%;
        }

        .overflow-x-auto {
            overflow-x: auto;
        }

        .border {
            border: 1px solid #000;
        }

        .border-collapse {
            border-collapse: collapse;
        }

        .border-gray-950 {
            border-color: #1a1a1a;
        }

        .text-center th,
        .text-center td {
            text-align: center;
        }

        th,
        td {
            padding: 2px;
        }

        img {
            display: block;
        }

        p {
            margin: 0;
            line-height: 1.5;
        }

        b {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container mx-auto" id="print-body">
        <table style="width: 100%; text-align: center; margin-bottom: 0.2rem;">
            <tr>
                <td style="width: 20%; text-align: center;">
                    <img width="120px" src="./assets/roja.png" alt="Logo Roja">
                </td>
                <td style="width: 60%; text-align: center; font-weight: bold; font-size: 12px;">
                    <p>HASIL BELAJAR PESERTA DIDIK <br>
                        DI PONDOK TMQ ROOHIATUL JANNAH <br>
                        HIDAYATULLAH SUKOHARJO</p>
                </td>
                <td style="width: 20%; text-align: center;">
                    <img width="70px" src="./assets/smi.png" alt="Logo SMI">
                </td>
            </tr>
        </table>

        <table style="width: 100%; font-size: 12px; margin-bottom: 0.2rem;">
            <tr>
                <td style="width: 60%;">
                    <table style="width: 100%; font-size: 12px;">
                        <tr>
                            <td style="width: 30%;">Nama Pondok</td>
                            <td>: TMQ Rooihatul Jannah Hidayatullah</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>: Brumbung RT 03/II, Dukuh, Sukoharjo, Sukoharjo</td>
                        </tr>
                        <tr>
                            <td>Nama Peserta Didik</td>
                            <td>: {{ ucwords($student->name) }}</td>
                        </tr>
                        <tr>
                            <td>Nomor Induk</td>
                            <td>: {{ $student->nis }}</td>
                        </tr>
                    </table>
                </td>
                <td style="width: 40%;">
                    <table style="width: 100%; font-size: 12px;">
                        <tr>
                            <td>Semester</td>
                            <td>: {{ $semester % 2 == 0 ? 'Genap' : 'Ganjil' }}</td>
                        </tr>
                        <tr>
                            @php
                                $semester = $semester % 2 == 0 ? $semester - 1 : $semester;
                            @endphp
                            <td>Tahun Pelajaran</td>
                            <td>:
                                {{ $student->group()->first()->year + floor($semester / 2) }}/{{ $student->group()->first()->year + (floor($semester / 2) + 1) }}
                            </td>
                        </tr>
                        <tr>
                            <td style="color: white">-</td>
                        </tr>
                        <tr>
                            <td style="color: white">-</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div class="mt-4">
            <div class="overflow-x-auto">
                <table style="font-size: 10px;" class="table-auto w-full border-collapse border border-gray-950">
                    <thead class="text-center">
                        <tr>
                            <th rowspan="2" class="border border-gray-950">No</th>
                            <th rowspan="2" class="border border-gray-950">Komponen</th>
                            <th rowspan="2" class="border border-gray-950">KKM</th>
                            <th colspan="2" class="border border-gray-950">Nilai</th>
                            <th rowspan="2" class="border border-gray-950">Deskripsi</th>
                        </tr>
                        <tr>
                            <th class="border border-gray-950">Angka</th>
                            <th class="border border-gray-950">Huruf</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border border-gray-950 text-center font-bold">A.</td>
                            <td class="border border-gray-950 font-bold" colspan="5">Matapelajaran</td>
                        </tr>
                        <tr>
                            <td rowspan="{{ $courseAgama->count() + 1 }}"
                                class="border border-gray-950 text-center font-bold">1</td>
                            <td class="border border-gray-950 font-bold" colspan="5">PENDIDIKAN AGAMA</td>
                        </tr>
                        @foreach ($courseAgama as $item)
                            <tr>
                                <td class="border border-gray-950">{{ $item->course()->first()->name }}</td>
                                <td class="border border-gray-950 text-center">{{ $item->course()->first()->kkm }}</td>
                                <td class="border border-gray-950 text-center">{{ $item->grade }}</td>
                                <td class="border border-gray-950">{{ angkaKeTulisan($item->grade) }}</td>
                                <td class="border border-gray-950 text-center">
                                    {{ $item->grade >= $item->course()->first()->kkm ? 'terlampaui' : 'tidak terlampaui' }}
                                </td>
                            </tr>
                        @endforeach
                        <!-- Tambahkan baris lain seperti di atas sesuai kebutuhan -->
                        <tr>
                            <td rowspan="{{ $courseUmum->count() + 1 }}"
                                class="border border-gray-950 text-center font-bold">2</td>
                            <td class="border border-gray-950 font-bold" colspan="5">PENDIDIKAN AKADEMIK</td>
                        </tr>
                        @foreach ($courseUmum as $item)
                            <tr>
                                <td class="border border-gray-950">{{ $item->course()->first()->name }}</td>
                                <td class="border border-gray-950 text-center">{{ $item->course()->first()->kkm }}</td>
                                <td class="border border-gray-950 text-center">{{ $item->grade }}</td>
                                <td class="border border-gray-950">{{ angkaKeTulisan($item->grade) }}</td>
                                <td class="border border-gray-950 text-center">
                                    {{ $item->grade >= $item->course()->first()->kkm ? 'terlampaui' : 'tidak terlampaui' }}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2" class="border border-gray-950 text-center font-bold">JUMLAH NILAI</td>
                            <td class="border border-gray-950 text-center" colspan="2">{{ $grades->sum('grade') }}
                            </td>
                            <td class="border border-gray-950"></td>
                            <td class="border border-gray-950"></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="border border-gray-950 text-center font-bold">RATA-RATA</td>
                            <td class="border border-gray-950 text-center" colspan="2">
                                {{ round($grades->avg('grade'), 2) }}</td>
                            <td class="border border-gray-950"></td>
                            <td class="border border-gray-950"></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="border border-gray-950 text-center font-bold">PERINGKAT</td>
                            <td class="border border-gray-950 text-center">{{ $student->rank($semester) }}</td>
                            <td class="border border-gray-950 text-center">dari</td>
                            <td class="border border-gray-950 text-center" colspan="2">
                                {{ $student->room()->first()->students()->count() }} santri</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="border border-gray-950 text-center font-bold">PENGEMBANGAN DIRI
                            </td>
                            <td colspan="2" class="border border-gray-950 text-center font-bold">NILAI</td>
                            <td colspan="2" class="border border-gray-950"></td>
                        </tr>
                        @foreach ($extras as $number => $item)
                            <tr>
                                <td class="border border-gray-950 text-center">{{ $number + 1 }}</td>
                                <td class="border border-gray-950">{{ $item->extraCourse()->first()->name }}</td>
                                <td colspan="2" class="border border-gray-950 text-center">{{ $item->grade }}</td>
                                <td colspan="2" class="border border-gray-950"></td>
                            </tr>
                        @endforeach
                        <tr>
                            <td rowspan="2" colspan="4" class="border border-gray-950 text-center font-bold">
                                Akhlak dan Kepribadian</td>
                            <td colspan="2" class="border border-gray-950 text-center font-bold">Ketidakhadiran
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-950">1. Sakit</td>
                            <td class="border border-gray-950 text-center">{{ $abcents[0]->grade }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="border border-gray-950">Akhlak</td>
                            <td colspan="2" class="border border-gray-950 text-center">
                                {{ $personalities[0]->grade }}</td>
                            <td class="border border-gray-950">2. Izin</td>
                            <td class="border border-gray-950 text-center">{{ $abcents[1]->grade }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="border border-gray-950">Kepribadian</td>
                            <td colspan="2" class="border border-gray-950 text-center">
                                {{ $personalities[1]->grade }}</td>
                            <td class="border border-gray-950">3. Tanpa keterangan</td>
                            <td class="border border-gray-950 text-center">{{ $abcents[2]->grade }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 1rem; font-size: 12px;">
                <table style="width: 100%; margin-bottom: 1rem; border-collapse: collapse;">
                    <tr>
                        <td style="width: 50%; vertical-align: top;">
                            <table style="width: 100%; border-collapse: collapse;">
                                <tr>
                                    <td style="width: 50%; padding: 0.1rem;">Diberikan di</td>
                                    <td style="width: 50%; padding: 0.1rem;">: Sukoharjo</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.1rem;">Tanggal</td>
                                    <td style="padding: 0.1rem;">:
                                        {{ Carbon\Carbon::now()->translatedFormat('d F Y') }}</td>
                                </tr>
                            </table>
                        </td>
                        <td style="width: 50%;"></td>
                    </tr>
                </table>

                <table style="width: 100%; text-align: center; border-collapse: collapse; margin-top: 1rem;">
                    <tr>
                        <td style="width: 33%; padding: 0.5rem;">
                            <p>Mengetahui, <br>(Orang Tua / Wali)</p>
                            <br><br><br>
                            <p>........................................</p>
                        </td>
                        <td style="width: 33%; padding: 0.5rem;">
                            <p>Wali Kelas <br><br></p>
                            <br><br><br>
                            <p><b>{{  ucwords($student->room()->first()->teacher()->first()->name) }}</b></p>
                            {{-- <p>........................................</p> --}}
                        </td>
                        <td style="width: 33%; padding: 0.5rem;">
                            <p>Mudiroh Pondok <br><br></p>
                            <br><br>
                            <p><b>Al Ustadzah Rohimah Zahrotul Jannah</b></p>
                        </td>
                    </tr>
                </table>
            </div>

        </div>
    </div>
</body>

</html>
