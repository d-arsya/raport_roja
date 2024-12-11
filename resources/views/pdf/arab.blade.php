@php
    function toArabic($number)
    {
        $westernNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $arabicNumbers = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];

        return str_replace($westernNumbers, $arabicNumbers, $number);
    }
    function gradeToArabic($grade)
    {
        $grades = [
            'A' => 'ممتازة (أ)',
            'B' => 'جيدة (ب)',
            'C' => 'مقبولة (ج)',
            'D' => 'ضعيفة (د)', // Jika D
        ];

        return $grades[$grade]; // Jika nilai tidak dikenali
    }
    function gradeToArab($grade)
    {
        $grades = [
            'Sangat Baik' => 'ممتازة (أ)',
            'Baik' => 'جيدة (ب)',
            'Kurang Baik' => 'مقبولة (ج)'
        ];

        return $grades[$grade]; // Jika nilai tidak dikenali
    }
    function toArabicWords($number)
    {
        $ones = ['', 'واحد', 'اثنان', 'ثلاثة', 'أربعة', 'خمسة', 'ستة', 'سبعة', 'ثمانية', 'تسعة'];
        $tens = ['', 'عشرة', 'عشرون', 'ثلاثون', 'أربعون', 'خمسون', 'ستون', 'سبعون', 'ثمانون', 'تسعون'];
        $specials = [
            11 => 'أحد عشر',
            12 => 'اثنا عشر',
        ];

        if ($number < 0 || $number > 100) {
            return 'العدد خارج النطاق'; // Angka di luar jangkauan
        }

        if ($number === 100) {
            return 'مائة';
        }

        if (isset($specials[$number])) {
            return $specials[$number];
        }

        $tenPart = intval($number / 10); // Puluhan
        $onePart = $number % 10; // Satuan

        if ($tenPart === 0) {
            return $ones[$onePart]; // Hanya satuan
        }

        if ($onePart === 0) {
            return $tens[$tenPart]; // Hanya puluhan
        }

        // Format untuk kombinasi puluhan dan satuan
        return $ones[$onePart] . ' و ' . $tens[$tenPart];
    }
@endphp
<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <meta charset="UTF-8">
    <title>{{ $judul }}</title>
<head>
    <style>
        /* General */
        
        body {
            visibility: hidden;
            direction: rtl; /* Mengatur teks dari kanan ke kiri */
            font-family: 'Amiri', sans-serif; /* Gunakan font Arab */
        }
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
        @media print{
            body{
                visibility: visible;
            }
        }
    </style>
</head>

<body>
    <div class="container mx-auto">

        <table style="width: 100%; text-align: center; margin-bottom: 0.2rem;">
            <tr>
                <td style="width: 20%; text-align: center;">
                    <img width="120px" src="{{ asset('assets/roja.png') }}" alt="Logo Roja">
                    {{-- <img width="120px" src="./assets/roja.png" alt="Logo Roja"> --}}
                </td>
                <td style="width: 60%; text-align: center; font-weight: bold; font-size: 12px;">
                    <p>
                        كشف النتيجة
                        <br>
                        بمعهد رائحة الجنة تربية محفظات القرآن
                        <br>
                        هداية الله سوكوهارجو
                    </p>
                </td>
                <td style="width: 20%; text-align: center;">
                    <img width="120px" src="{{ asset('assets/smi.png') }}" alt="Logo SMI">
                    {{-- <img width="70px" src="./assets/smi.png" alt="Logo SMI"> --}}
                </td>
            </tr>
        </table>

        <table style="width: 100%; font-size: 12px; margin-bottom: 0.2rem;">
            <tr>
                <td style="width: 60%;">
                    <table style="width: 100%; font-size: 12px;">
                        <tr>
                            <td style="width: 30%;">

                                اسم المعهد
                            </td>
                            <td>

                                : رائحة الجنة
                            </td>
                        </tr>
                        <tr>
                            <td>

                                العنوان
                            </td>
                            <td>

                                : برومبونج ، ٢/٣ دوكوه ، سوكوهارجو
                            </td>
                        </tr>
                        <tr>
                            <td>

                                اسم الطالبة
                            </td>
                            <td>: {{ $student->name_arabic }}</td>
                        </tr>
                        <tr>
                            <td>

                                رقم القيد
                            </td>
                            <td>: {{ toArabic($student->nis) }}</td>
                        </tr>
                    </table>
                </td>
                <td style="width: 40%;">
                    <table style="width: 100%; font-size: 12px;">
                        <tr>
                            <td>

                                المستوى
                            </td>
                            <td>: {{ $semester % 2 == 0 ? 'Genap' : 'الوتر' }}</td>

                        </tr>
                        <tr>
                            @php
                                $semester = $semester % 2 == 0 ? $semester - 1 : $semester;
                            @endphp
                            <td>

                                العام الدراسي
                            </td>
                            <td>:
                                {{ toArabic($student->group()->first()->year + floor($semester / 2)) }}/{{ toArabic($student->group()->first()->year + (floor($semester / 2) + 1)) }}
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
                <table style="font-size: 10px" class="table-auto w-full border-collapse border border-gray-950">
                    <thead class="text-center">
                        <tr>
                            <th rowspan="2" class="border border-gray-950">الرقم</th>
                            <th rowspan="2" class="border border-gray-950">
                                المواد الدراسية
                            </th>
                            <th rowspan="2" class="border border-gray-950">نتيجة الادنى</th>
                            <th colspan="2" class="border border-gray-950">النتيجة</th>
                            <th rowspan="2" class="border border-gray-950">وصف الكمال</th>
                        </tr>
                        <tr>
                            <th class="border border-gray-950">بالعدد</th>
                            <th class="border border-gray-950">بالحروف</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td rowspan="{{ $courseAgama->count() + 1 }}"
                                class="border border-gray-950 text-center font-bold">
                                ١
                            </td>
                            <td class="border border-gray-950 font-bold" colspan="5">
                                المواد الشرعية
                            </td>
                        </tr>
                        @foreach ($courseAgama as $item)
                            <tr>
                                <td class="border border-gray-950">{{ $item->course()->first()->name_arabic }}</td>
                                <td class="border border-gray-950 text-center">
                                    {{ toArabic($item->course()->first()->kkm) }}</td>
                                <td class="border border-gray-950 text-center">{{ toArabic($item->grade) }}</td>
                                <td class="border border-gray-950">{{ toArabicWords($item->grade) }}</td>
                                <td class="border border-gray-950 text-center">
                                    {{ $item->grade >= $item->course()->first()->kkm ? 'كاملة' : 'لم يكمل' }}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td rowspan="{{ $courseUmum->count() + 1 }}"
                                class="border border-gray-950 text-center font-bold">
                                ٢
                            </td>
                            <td class="border border-gray-950 font-bold" colspan="5">
                                المواد الحيوية
                            </td>
                        </tr>
                        @foreach ($courseUmum as $item)
                            <tr>
                                <td class="border border-gray-950">{{ $item->course()->first()->name_arabic }}</td>
                                <td class="border border-gray-950 text-center">
                                    {{ toArabic($item->course()->first()->kkm) }}</td>
                                <td class="border border-gray-950 text-center">{{ toArabic($item->grade) }}</td>
                                <td class="border border-gray-950">{{ toArabicWords($item->grade) }}</td>
                                <td class="border border-gray-950 text-center">
                                    {{ $item->grade >= $item->course()->first()->kkm ? 'كاملة' : 'لم يكمل' }}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2" class="border border-gray-950 text-center font-bold">
                                المجموع
                            </td>
                            <td class="border border-gray-950 text-center" colspan="2">
                                {{ toArabic($grades->sum('grade')) }}
                            </td>
                            <td class="border border-gray-950"></td>
                            <td class="border border-gray-950"></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="border border-gray-950 text-center font-bold">
                                التعديل
                            </td>
                            <td class="border border-gray-950 text-center" colspan="2">
                                {{ toArabic(round($grades->avg('grade'), 2)) }}</td>
                            <td class="border border-gray-950"></td>
                            <td class="border border-gray-950"></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="border border-gray-950 text-center font-bold">
                                رتبة الطالبة
                            </td>
                            <td class="border border-gray-950 text-center">{{ toArabic($student->rank($semester)) }}
                            </td>
                            <td class="border border-gray-950 text-center">من</td>
                            <td class="border border-gray-950 text-center">
                                {{ toArabic($student->room()->first()->students()->count()) }} طالبة</td>
                            <td class="border border-gray-950"></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="border border-gray-950 text-center font-bold">
                                الإضافية المنهجية
                            </td>
                            <td colspan="2" class="border border-gray-950 text-center font-bold">
                                النتيجة
                            </td>
                            <td colspan="2" class="border border-gray-950"></td>
                        </tr>
                        @foreach ($extras as $number => $item)
                            <tr>
                                <td class="border border-gray-950 text-center">{{ toArabic($number + 1) }}</td>
                                <td class="border border-gray-950">{{ $item->extraCourse()->first()->name_arabic }}
                                </td>
                                <td colspan="2" class="border border-gray-950 text-center">
                                    {{ gradeToArabic($item->grade) }}</td>
                                <td colspan="2" class="border border-gray-950"></td>
                            </tr>
                        @endforeach
                        <tr>
                            <td rowspan="2" colspan="4" class="border border-gray-950 text-center font-bold">
                                هُويّة الطالبة
                            </td>
                            <td colspan="2" class="border border-gray-950 text-center font-bold">
                                كشف الغيبة
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-950">بسبب المرض</td>
                            <td class="border border-gray-950 text-center">{{ toArabic($abcents[0]->grade) }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="border border-gray-950">الأدب</td>
                            <td colspan="2" class="border border-gray-950 text-center">
                                {{ gradeToArab($personalities[0]->grade) }}
                            </td>
                            <td class="border border-gray-950">بالإستئذان</td>
                            <td class="border border-gray-950 text-center">{{ toArabic($abcents[1]->grade) }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="border border-gray-950">الشخصية</td>
                            <td colspan="2" class="border border-gray-950 text-center">
                                {{ gradeToArab($personalities[1]->grade) }}
                            </td>
                            <td class="border border-gray-950">بدون بيانات</td>
                            <td class="border border-gray-950 text-center">{{ toArabic($abcents[2]->grade) }}</td>
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
                                    <td style="width: 50%; padding: 0.1rem;">

                                        ُدِّم في
                                    </td>
                                    <td style="width: 50%; padding: 0.1rem;">

                                        : سوكوهارجو
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.1rem;">

                                        التاريخ
                                    </td>
                                    <td style="padding: 0.1rem;">:
                                        @php
                                            \Carbon\Carbon::setLocale('ar');
                                        @endphp
                                        {{ toArabic(Carbon\Carbon::now()->translatedFormat('d F Y')) }}</td>
                                </tr>
                            </table>
                        </td>
                        <td style="width: 50%;"></td>
                    </tr>
                </table>

                <table style="width: 100%; text-align: center; border-collapse: collapse; margin-top: 1rem;">
                    <tr>
                        <td style="width: 33%; padding: 0.5rem;">
                            <p> الموقع التالي,<br>ولي الامر</p>
                            <br><br><br>
                            <p>........................................</p>
                        </td>
                        <td style="width: 33%; padding: 0.5rem;">
                            <p>ولي الفصل <br><br></p>
                            <br><br><br>
                            {{-- <p>........................................</p> --}}
                            <p><b>{{ $student->room()->first()->teacher()->first()->name_arabic }}</b></p>
                        </td>
                        <td style="width: 33%; padding: 0.5rem;">
                            <p>مديرة المعهد <br><br></p>
                            <br><br>
                            <p><b>رحيمة زهرة الجنة</b></p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script>
        window.print()
        window.addEventListener("afterprint",()=>window.history.back())
    </script>
</body>

</html>
