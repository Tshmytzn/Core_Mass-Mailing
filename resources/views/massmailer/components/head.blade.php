<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Core Mailer</title>
    <!-- CSS files -->
    <link rel="icon" type="image/x-icon" href="{{asset('logo/core_log.png')}}">
    <link href="{{asset('./dist/css/tabler.min.css?1692870487')}}" rel="stylesheet" />
    <link href="{{asset('./dist/css/tabler-flags.min.css?1692870487')}}" rel="stylesheet" />
    <link href="{{asset('./dist/css/tabler-payments.min.css?1692870487')}}" rel="stylesheet" />
    <link href="{{asset('./dist/css/tabler-vendors.min.css?1692870487')}}" rel="stylesheet" />
    <link href="{{asset('./dist/css/demo.min.css?1692870487')}}" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }
    body {
      font-feature-settings: "cv03", "cv04", "cv11";
    }
  </style>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Alertify CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>

    <!-- Alertify Default Theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>

    <!-- Alertify JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>

    <style>
              .nav-item {
            position: relative;
            margin: 0 10px;
            cursor: pointer;
            transition: transform 0.3s ease, background 0.4s ease;
        }

        .nav-item .nav-link {
            text-decoration: none;
            color: #333;
            padding: 5px 10px;
            display: flex;
            align-items: center;
            transition: color 0.3s ease;
        }

        .nav-item .nav-link-icon svg {
            margin-right: 5px;
            transition: fill 0.3s ease, stroke 0.3s ease;
        }

        .nav-item.active .nav-link {
            color: white;
        }

        .nav-item.active .nav-link-icon svg {
            margin-right: 5px;
            transition: stroke 0.3s ease;
            stroke: #ffffff;
        }

        .nav-item.active {
            background: linear-gradient(135deg, #0099ff, #0a58be);
            border-radius: 5px;
        }

        .nav-item.active:hover {
            background: linear-gradient(135deg, #0a58be, #0099ff);
        }

        .navbar::after {
            content: '';
            position: absolute;
            bottom: 0;
            height: 3px;
            background-color: #0a58be;
            width: 0;
            transition: width 0.4s ease, transform 0.4s ease;
        }

        .nav-item.active~.navbar::after {
            width: 100px;
            transform: translateX(calc(100px * var(--nav-index)));
        }

        .nav-item:nth-child(1) {
            --nav-index: 0;
        }

        .nav-item:nth-child(2) {
            --nav-index: 1;
        }

        .nav-item:nth-child(3) {
            --nav-index: 2;
        }

        .nav-item:nth-child(4) {
            --nav-index: 3;
        }

        .nav-item:nth-child(5) {
            --nav-index: 4;
        }
    </style>
</head>
