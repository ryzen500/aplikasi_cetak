<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<style>
    .ui-dialog .ui-dialog-titlebar-close::after {
        content: "X";
        font-weight: bolder;
        color: #424242 !important;
        text-align: center;
        vertical-align: middle;
        float: top;
    }

    input.span12,
    textarea.span12,
    .uneditable-input.span12 {
        width: 930px;
    }
</style>
<?php

function get_base_url()
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $script = $_SERVER['SCRIPT_NAME'];
    $path = dirname($script); // Get the path without the script name
    $base_url = $protocol . '://' . $host . $path;

    return rtrim($base_url, '/') . '/';
}

$base_url = get_base_url();
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <title>RS William Booth Surabaya - Cetak</title>
    <!-- Including Notiflix via CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-aio-3.2.6.min.css">
    <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.6/dist/notiflix-aio-3.2.6.min.js"></script>


</head>

<body>

    <body class="iframe" style="background:#ffffff;padding:7px;">
        <style>
            /* untuk label yg bisa refresh */
            html,
            body {
                margin: 0;
                height: 100%;
                overflow: hidden
            }

            label.refreshable:hover {
                cursor: pointer;
                color: #0000FF;
                font-weight: bold;
            }

            .main-content {
                margin: -12px;
            }
        </style>

        <!--<div class="container" style="width: 100%;">-->

        <ul class="nav nav-pills"></ul>
        <div class="main-content">
            <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Oswald" />
            <style>
                body {
                    padding: 0;
                    margin: 0;
                    background-color: #8B0000;
                }

                .judul_form {
                    font-size: 20pt;
                    text-align: center;
                    margin-bottom: 50px;
                }

                #logo {
                    float: left;
                    height: 70px;
                    background: url("http://192.168.214.222:8181/ihospital-rswb/data/images/profil_rs/logo_rs_1.png") left center no-repeat;
                    background-size: contain;
                }

                #header {
                    display: flex;
                    align-items: center;
                    height: 120px;
                    background-color: #378d7c;
                    padding-top: -12px;
                }

                .background {
                    position: absolute;
                    left: 0;
                    top: 0;
                    z-index: -100;
                    width: 105vw;
                    height: 105vh;
                    /* background: url("/ihospital-rswb/images/icon_ekios_v2/4.jpg") center center no-repeat; */
                    background-size: cover;
                }

                .notiflix-report p {
                    text-align: center;
                }

                .pesan {
                    font-size: 20px !important;
                }
            </style>

            <body onload="startTime()">
                <div class="background"></div>
                <div id="header" class="row">
                    <div class="col-sm-6">
                        <div class="col-lg-2">
                            <a href="/ihospital-rswb/index.php?r=ekiosV2/Default/Index"><img src="http://192.168.214.222:8181/ihospital-rswb/images/icon_ekios_v2/rswb-min.png" style="padding-left: 45px; max-width: 1000px; width:350px;" class='image_report'></a>
                        </div>
                    </div>
                    <div class="col-sm-6">

                        <div class="" style="padding-right: 30px; color:white;">
                            <p style="margin: 0 15px 0 0; float: right;">

                                <?php echo "<span style='font-family: oswald; font-size:1.5vw;'>" . strtoupper(hari()) . ",</span>"; ?>

                                <?php
                                $tgl = date('d');
                                $tahun = date('Y');
                                echo "<span style='font-family:oswald;font-size:1.5vw;'>" . $tgl . " " . strtoupper(bulan()) . " " . $tahun . " -</span>";
                                ?>
                                <span id="clock" style="display: inline-block; width: 110px;font-family: oswald; font-size: 1.5vw;"></span>
                            </p>
                        </div>

                    </div>
                </div>
                <br>
                <br>
                <br>


                <div class="container mt-4">
                    <div class="text-center">
                        <h1 class="fw-bold">Cetak Nomor Antrian</h1>
                    </div>

                    <form class="form_pendaftaran" id="daftar-mandiri-form" action="" method="post">
                        <div class="form_panel form_utama">
                            <div class="form_main">
                                <div class="mb-3">
                                    <input class="form-control" placeholder="No. Rekam Medis / No. Rujukan BPJS / No. Kartu BPJS / No. KTP / No. Telepon" type="text" style="text-align: center;" name="input_no_kartu" id="input_no_kartu" />
                                </div>

                                <div class="text-center mb-3">
                                    <p>
                                        Masukkan SALAH SATU data yang Anda miliki: No. Rekam Medis, No. Rujukan BPJS, No. Kartu BPJS, No. KTP, No. Telepon
                                        <br>
                                        <hr>
                                        <i>Enter ONE of the data you have: Medical Record Number, BPJS Reference Number, BPJS Card Number, KTP Number, Mobile Number</i>
                                    </p>
                                </div>

                                <div class="text-center">
                                    <button onclick="setPemeriksaanPertama(1);" class="btn btn-success btn-lg w-100" type="button">
                                        Cetak
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>




                <?php
                function hari()
                {
                    $hari = date('l');
                    /* $new = date('l, F d, Y', strtotime($Today)); */
                    if ($hari == "Sunday") {
                        return "Minggu";
                    } elseif ($hari == "Monday") {
                        return "Senin";
                    } elseif ($hari == "Tuesday") {
                        return "Selasa";
                    } elseif ($hari == "Wednesday") {
                        return "Rabu";
                    } elseif ($hari == "Thursday") {
                        return "Kamis";
                    } elseif ($hari == "Friday") {
                        return "Jum'at";
                    } elseif ($hari == "Saturday") {
                        return "Sabtu";
                    }
                }

                function bulan()
                {
                    $bulan = date('F');
                    if ($bulan == "January") {
                        return " Januari ";
                    } elseif ($bulan == "February") {
                        return " Februari ";
                    } elseif ($bulan == "March") {
                        return " Maret ";
                    } elseif ($bulan == "April") {
                        return " April ";
                    } elseif ($bulan == "May") {
                        return " Mei ";
                    } elseif ($bulan == "June") {
                        return " Juni ";
                    } elseif ($bulan == "July") {
                        return " Juli ";
                    } elseif ($bulan == "August") {
                        return " Agustus ";
                    } elseif ($bulan == "September") {
                        return " September ";
                    } elseif ($bulan == "October") {
                        return " Oktober ";
                    } elseif ($bulan == "November") {
                        return " November ";
                    } elseif ($bulan == "December") {
                        return " Desember ";
                    }
                }
                ?>
                <script>
                    function handleKeyPress(e) {
                        var key = e.keyCode || e.which;
                        if (key == 13) {
                            console.log("Enter");
                            setPemeriksaanPertama(1);
                        }
                    }
                    var base_url = "<?php echo $base_url ?>";
                    console.log('Base URL:', base_url);


                    function setPemeriksaanPertama(tipe) {

                        var nomor = $("#input_no_kartu").val();
                        console.log("nomor ", nomor);


                        const inputs = [nomor];

                        const isAnyInputFilled = inputs.some(input => input.trim() !== "");

                        console.log("true or false", isAnyInputFilled)
                        if (!isAnyInputFilled) {
                            event.preventDefault(); // Cegah pengiriman form
                            Notiflix.Report.info('Informasi', 'Harap Masukkan SALAH SATU data yang Anda miliki: No. Rekam Medis, No. Rujukan BPJS, No. Kartu BPJS, No. KTP, No. Telepon.');

                            // Close the report after 3 seconds
                            setTimeout(() => {
                                const button = document.getElementById('NXReportButton');
                                if (button) {
                                    button.click(); // Close the Notiflix report
                                }
                            }, 3000); // 3-second timeout

                            // Memfokuskan pada input pertama yang kosong
                            const firstEmptyInput = inputs.findIndex(input => input.trim() === "");
                            if (firstEmptyInput >= 0) {
                                $('#input_no_kartu').focus(); // Fokus pada input yang sesuai
                            }
                        } else {
                            // $("#input_no_kartu").addClass("animation-loading");
                            Notiflix.Loading.hourglass();
                            $(".form_utama").addClass("animation-loading");


                            // return false;

                            $.post(`${base_url}cetak.php`, {
                                nomor: nomor
                            }, function(data) {

                                if (data.error) {
                                    // alert(" Tidak Ada pendaftaran Anda hari ini");
                                    Notiflix.Loading.remove();

                                    Notiflix.Report.failure('Data Gagal Dicetak', 'Tidak Ada pendaftaran Anda hari ini ');

                                    // Close the report after 3 seconds
                                    setTimeout(() => {
                                        const button = document.getElementById('NXReportButton');

                                        if (button) {
                                            // Simulate a click event on the button
                                            button.click();
                                        }
                                    }, 3000); // 3-second timeout

                                    $("#input_no_kartu").val("");
                                    const inputElement = document.getElementById('input_no_kartu');
                                    // Memfokuskan pada elemen input tersebut
                                    inputElement.focus();
                                }
                                if (data.redirect) {
                                    //  With Time
                                    // Notiflix.Loading.remove(1000);
                                    Notiflix.Loading.remove();

                                    var openTab = window.open(
                                        data.redirect,
                                        '_blank', // Jendela baru
                                        'width=800,height=600,menubar=no,toolbar=no,scrollbars=yes' // Mengatur ukuran dan opsi lainnya
                                    );

                                    setTimeout(function() {
                                        openTab.close();
                                    }, 3000); // Tutup setelah 3 detik

                                    $("#input_no_kartu").val("");
                                    const inputElement = document.getElementById('input_no_kartu');
                                    // Memfokuskan pada elemen input tersebut
                                    inputElement.focus();
                                }

                                // alert("Anda berhasil Checkin ")

                                // autoPrint();


                            }, 'json');

                        }

                    }

                    $(document).ready(function() {
                        // $("#input_no_kartu").val("");
                        const inputElement = document.getElementById('input_no_kartu');
                        // Memfokuskan pada elemen input tersebut
                        inputElement.focus();
                        $('#daftar-mandiri-form').on('submit', function(event) {
                            const no_kartu = $("#input_no_kartu").val();

                            const inputs = [no_kartu];

                            const isAnyInputFilled = inputs.some(input => input.trim() !== "");

                            console.log("true or false", isAnyInputFilled)
                            if (!isAnyInputFilled) {
                                event.preventDefault(); // Cegah pengiriman form
                                Notiflix.Report.info('Informasi', 'Harap Masukkan SALAH SATU data yang Anda miliki: No. Rekam Medis, No. Rujukan BPJS, No. Kartu BPJS, No. KTP, No. Telepon.');

                                // Close the report after 3 seconds
                                setTimeout(() => {
                                    const button = document.getElementById('NXReportButton');
                                    if (button) {
                                        button.click(); // Close the Notiflix report
                                    }
                                }, 3000); // 3-second timeout

                                // Memfokuskan pada input pertama yang kosong
                                const firstEmptyInput = inputs.findIndex(input => input.trim() === "");
                                if (firstEmptyInput >= 0) {
                                    $('#input_no_kartu').focus(); // Fokus pada input yang sesuai
                                }
                            } else {
                                // Jika salah satu input terisi, formulir bisa dikirim
                                // Anda dapat melakukan tindakan tambahan di sini jika diperlukan
                                event.preventDefault(); // Cegah pengiriman form

                                setPemeriksaanPertama(1); // Lakukan aksi yang diinginkan
                            }
                        });

                        // // Tambahkan event listener untuk menangani enter di input
                        // $('#input_no_kartu').on('keypress', function(event) {
                        //     if (event.keyCode === 13) { // Jika tombol Enter ditekan
                        //         event.preventDefault(); // Cegah pengiriman form
                        //         setPemeriksaanPertama(1); // Lakukan aksi yang diinginkan
                        //     }
                        // });
                        // Notiflix.Report.init({
                        //     className: 'notiflix-report',
                        //     width: '500px',
                        //     height: '300px',
                        //     backgroundColor: '#f8f8f8',
                        //     borderRadius: '25px',
                        //     rtl: false,
                        //     zindex: 4002,
                        //     backOverlay: true,
                        //     backOverlayColor: 'rgba(0,0,0,0.5)',
                        //     backOverlayClickToClose: false,
                        //     fontFamily: 'Quicksand',
                        //     svgSize: '110px',
                        //     plainText: true,
                        //     titleFontSize: '30px',
                        //     titleMaxLength: 34,
                        //     messageFontSize: '24px',
                        //     messageMaxLength: 400,
                        //     buttonFontSize: '14px',
                        //     buttonMaxLength: 34,
                        //     cssAnimation: true,
                        //     cssAnimationDuration: 360,
                        //     cssAnimationStyle: 'fade',
                        //     success: {
                        //         svgColor: '#32c682',
                        //         titleColor: '#1e1e1e',
                        //         messageColor: '#242424',
                        //         buttonBackground: '#32c682',
                        //         buttonColor: '#fff',
                        //         backOverlayColor: 'rgba(50,198,130,0.2)',
                        //     },
                        //     failure: {
                        //         svgColor: '#ff5549',
                        //         titleColor: '#1e1e1e',
                        //         messageColor: '#242424',
                        //         buttonBackground: '#ff5549',
                        //         buttonColor: '#fff',
                        //         backOverlayColor: 'rgba(255,85,73,0.2)',
                        //     },
                        //     warning: {
                        //         svgColor: '#eebf31',
                        //         titleColor: '#1e1e1e',
                        //         messageColor: '#242424',
                        //         buttonBackground: '#eebf31',
                        //         buttonColor: '#fff',
                        //         backOverlayColor: 'rgba(238,191,49,0.2)',
                        //     },
                        //     info: {
                        //         svgColor: '#26c0d3',
                        //         titleColor: '#1e1e1e',
                        //         messageColor: '#242424',
                        //         buttonBackground: '#26c0d3',
                        //         buttonColor: '#fff',
                        //         backOverlayColor: 'rgba(38,192,211,0.2)',
                        //     },
                        // });
                        // Notiflix.Report.Success(
                        //     'Harap Menunggu',
                        //     'SEP Sedang dicetak',
                        //     'Okay',
                        // );

                        // setTimeout(function() {
                        //     $(".notiflix-report").fadeOut();
                        // }, 15000);
                    });

                    function startTime() {
                        var today = new Date();
                        var h = today.getHours();
                        var m = today.getMinutes();
                        var s = today.getSeconds();
                        m = checkTime(m);
                        s = checkTime(s);
                        document.getElementById('clock').innerHTML =
                            h + ":" + m + ":" + s;
                        var t = setTimeout(startTime, 500);
                    }

                    function tampilkanwaktu() { //fungsi ini akan dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik 
                        var waktu = new Date(); //membuat object date berdasarkan waktu saat 
                        var sh = waktu.getHours() +
                            ""; //memunculkan nilai jam, //tambahan script + "" supaya variable sh bertipe string sehingga bisa dihitung panjangnya : sh.length //ambil nilai menit
                        var sm = waktu.getMinutes() + ""; //memunculkan nilai detik 
                        var ss = waktu.getSeconds() +
                            ""; //memunculkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
                        document.getElementById("clock").innerHTML = (sh.length == 1 ? "0" + sh : sh) + ":" + (sm.length == 1 ?
                            "0" + sm : sm) + ":" + (ss.length == 1 ? "0" + ss : ss);
                    }



                    function checkTime(i) {
                        if (i < 10) {
                            i = "0" + i
                        }; // add zero in front of numbers < 10
                        return i;
                    }
                </script>


            </body>
        </div>



        <script type="text/javascript">
            // Deteksi label yang memiliki checkbox


            var app_timezone = 'Asia/Jakarta';

            $("input").parents('label.control-label').css("cursor", "pointer");

            function insert_notifikasi(params) {
                $.post("index.php?r=site/insertNotifikasi", {
                        NofitikasiR: params
                    },
                    function(data) {
                        if (data.pesan === 'ok') {
                            var chatServer = '192.168.214.222';
                            if (chatServer == '') {
                                chatServer = 'http://localhost';
                            }
                            var chatPort = '3333';
                            socket = io.connect(chatServer + ':' + chatPort);
                            socket.emit('send', {
                                conversationID: 'notification',
                                status: 1,
                                modul_id: data.modul_id
                            });
                            socket.disconnect();

                            $('#pesan_notifikasi').html(data.template);
                            if (data.count_notif == 0) {
                                $('#count_notif').text("");
                                //                    $('#count_notif').removeClass("mws-dropdown-notif");
                            } else {
                                if (data.count_notif > 10) {
                                    count_notif = '10+';
                                } else if (data.count_notif > 0) {
                                    count_notif = data.count_notif;
                                }
                                $('#count_notif').text(count_notif);
                                //                    $('#count_notif').addClass("mws-dropdown-notif");
                            }
                        }
                        return false;
                    }, "json"
                );
            }


            var matched, browser;

            jQuery.uaMatch = function(ua) {
                ua = ua.toLowerCase();

                var match = /(chrome)[ \/]([\w.]+)/.exec(ua) ||
                    /(webkit)[ \/]([\w.]+)/.exec(ua) ||
                    /(opera)(?:.*version|)[ \/]([\w.]+)/.exec(ua) ||
                    /(msie) ([\w.]+)/.exec(ua) ||
                    ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(ua) || [];

                return {
                    browser: match[1] || "",
                    version: match[2] || "0"
                };
            };

            matched = jQuery.uaMatch(navigator.userAgent);
            browser = {};

            if (matched.browser) {
                browser[matched.browser] = true;
                browser.version = matched.version;
            }

            // Chrome is Webkit, but Webkit is also Safari.
            if (browser.chrome) {
                browser.webkit = true;
            } else if (browser.webkit) {
                browser.safari = true;
            }

            jQuery.browser = browser;
        </script>

    </body>

</html>