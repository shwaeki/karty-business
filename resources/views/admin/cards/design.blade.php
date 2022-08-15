<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8"/>
    <title> كرتي بزنز - المصمم</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Mohamad Shwaeki, shwaeki@gmail.com">
    <link rel="icon" type="image/x-icon" href="{{asset('images/logo.png')}}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="{{asset('css/site/bootstrap-rtl.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/designer/style.css')}}">

    <style>
        @foreach($fonts as $font)
            @font-face {
            font-family: {{'new_font_'.$font->id}};
            src: url({{asset('/fonts/'.$font->path)}});
        }
        @endforeach
    </style>

</head>
<body>


<div class="container-fluid">

    <div id="side-bar-overlay" onclick="toggleSideBar()"></div>
    <div id="side-bar">
        <div class="accordion mt-3" id="accordionOptions">
            <div class="card bg-white mx-1 mb-1">
                <div class="card-header" id="headingTwo">
                    <a class="text-decoration-none d-block" role="button" data-bs-toggle="collapse"
                       data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <i class="fas fa-grip-horizontal"></i> اضافة ايقونة جديدة
                    </a>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                     data-parent="#accordionOptions">
                    <div class="card-body">
                        <div class="row">
                            @foreach($icons as $icon)
                                <div class="col-6 p-1">
                                    <div class="icon-container img-thumbnail mb-2">
                                        <img src="{{$icon->icon_path }}" alt="icon" class="icon"
                                             onclick="newIcon(this)">
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>

                </div>
            </div>


        </div>
        <span id="side-bar-close-button" onclick="toggleSideBarDesktop()"></span>

    </div>

    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow">
            <ul class="navbar-nav  me-md-auto">
                <li class="nav-item">
                    <select name="font-type" onchange="changeFontType(this)" id="font-type"
                            class="btn btn-default btn-no-shadow d-none"
                            data-toggle="tooltip" title="نوع الخط">
                        <option disabled selected value="none">نوع الخط</option>
                        <option value="arial, serif" style="font-family: arial, serif ">Arial</option>
                        @foreach($fonts as $font)
                            <option value="{{'new_font_'.$font->id}}"
                                    style="font-family: {{'new_font_'.$font->id}},serif ">
                                {{$font->name}}
                            </option>
                        @endforeach
                    </select>
                </li>

                <li class="nav-item ">
                    <button type="button" class="btn btn-default btn-no-shadow position-relative"
                            data-toggle="tooltip" title="Font Color">
                        <i id="color-icon" class="fas fa-paint-brush"></i>
                        <input type="color" id="color" onchange="changeTextColor(this)" value="#000000"
                               aria-label="">
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-default btn-no-shadow" onclick="textAlign('right')"
                            data-toggle="tooltip" title="Right Align Text" id="textRight">
                        <i class="fas fa-align-right"></i>
                    </button>
                </li>

                <li class="nav-item">
                    <button type="button" class="btn btn-default btn-no-shadow" onclick="textAlign('center')"
                            data-toggle="tooltip" title="Center Align Text" id="textCenter">
                        <i class="fas fa-align-justify"></i>
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-default btn-no-shadow" onclick="textAlign('left')"
                            data-toggle="tooltip" title="Left Align Text" id="textLeft">
                        <i class="fas fa-align-left"></i>
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-default btn-no-shadow" onclick="bold()"
                            data-toggle="tooltip" title="Bold" id="bold">
                        <i class="fas fa-bold"></i>
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-default btn-no-shadow" onclick="italic()"
                            data-toggle="tooltip" title="Italic" id="italic">
                        <i class="fas fa-italic"></i>
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-default btn-no-shadow" onclick="do_save()"
                            data-toggle="tooltip" title="Flip">
                        <i class="fas fa-retweet"></i>
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-default btn-no-shadow" onclick="toggleGroup()"
                            data-toggle="tooltip" title="Group/UnGroup" id="group">
                        <i class="far fa-object-ungroup"></i>
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-default btn-no-shadow" onclick="toFront()"
                            data-toggle="tooltip" title="Bring To Front">
                        <svg width="20" height="20" viewBox="0 0 50 50">
                            <path
                                style="line-height:normal;text-indent:0;text-align:start;text-decoration-line:none;text-decoration-style:solid;text-decoration-color:#000;text-transform:none;block-progression:tb;isolation:auto;mix-blend-mode:normal"
                                d="M 10.400391 3 C 8.5253906 3 7 4.5253906 7 6.4003906 L 7 24.599609 C 7 26.474609 8.5253906 28 10.400391 28 L 28.599609 28 C 30.474609 28 32 26.474609 32 24.599609 L 32 6.4003906 C 32 4.5253906 30.474609 3 28.599609 3 L 10.400391 3 z M 34 18 L 34 20 L 43.599609 20 C 44.38564 20 45 20.61436 45 21.400391 L 45 39.599609 C 45 40.38564 44.38564 41 43.599609 41 L 25.400391 41 C 24.61436 41 24 40.38564 24 39.599609 L 24 30 L 22 30 L 22 39.599609 C 22 41.465579 23.534421 43 25.400391 43 L 43.599609 43 C 45.465579 43 47 41.465579 47 39.599609 L 47 21.400391 C 47 19.534421 45.465579 18 43.599609 18 L 34 18 z M 3.984375 29.986328 A 1.0001 1.0001 0 0 0 3 31 L 3 40 C 3 41.64497 4.3550302 43 6 43 L 15.585938 43 L 13.292969 45.292969 A 1.0001 1.0001 0 1 0 14.707031 46.707031 L 18.619141 42.794922 A 1.0001 1.0001 0 0 0 18.617188 41.203125 L 14.707031 37.292969 A 1.0001 1.0001 0 0 0 13.990234 36.990234 A 1.0001 1.0001 0 0 0 13.292969 38.707031 L 15.585938 41 L 6 41 C 5.4349698 41 5 40.56503 5 40 L 5 31 A 1.0001 1.0001 0 0 0 3.984375 29.986328 z"
                            />
                        </svg>

                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-default btn-no-shadow" onclick="toBack()"
                            data-toggle="tooltip" title="Send To Back">
                        <svg width="20" height="20" viewBox="0 0 50 50">
                            <path
                                style="line-height:normal;text-indent:0;text-align:start;text-decoration-line:none;text-decoration-style:solid;text-decoration-color:#000;text-transform:none;block-progression:tb;isolation:auto;mix-blend-mode:normal"
                                d="M 35.980469 2.9902344 A 1.0001 1.0001 0 0 0 35.292969 3.2929688 L 31.380859 7.2050781 A 1.0001 1.0001 0 0 0 31.382812 8.796875 L 35.292969 12.707031 A 1.0001 1.0001 0 1 0 36.707031 11.292969 L 34.414062 9 L 44 9 C 44.56503 9 45 9.4349698 45 10 L 45 19 A 1.0001 1.0001 0 1 0 47 19 L 47 10 C 47 8.3550302 45.64497 7 44 7 L 34.414062 7 L 36.707031 4.7070312 A 1.0001 1.0001 0 0 0 35.980469 2.9902344 z M 6.4003906 7 C 4.5253906 7 3 8.5253906 3 10.400391 L 3 28.599609 C 3 30.474609 4.5253906 32 6.4003906 32 L 24.599609 32 C 26.474609 32 28 30.474609 28 28.599609 L 28 10.400391 C 28 8.5253906 26.474609 7 24.599609 7 L 6.4003906 7 z M 30 22 L 30 24 L 39.599609 24 C 40.38564 24 41 24.61436 41 25.400391 L 41 43.599609 C 41 44.38564 40.38564 45 39.599609 45 L 21.400391 45 C 20.61436 45 20 44.38564 20 43.599609 L 20 34 L 18 34 L 18 43.599609 C 18 45.465579 19.534421 47 21.400391 47 L 39.599609 47 C 41.465579 47 43 45.465579 43 43.599609 L 43 25.400391 C 43 23.534421 41.465579 22 39.599609 22 L 30 22 z"
                            />
                        </svg>

                    </button>
                </li>

                <li class="nav-item">
                    <input type="number" class="form-control" min="0" max="180" oninput="changeRotation(this)"
                           value="0" data-toggle="tooltip" title="Rotation" id="rotation"
                           style="min-width: 40px;    width: 70px;">
                </li>
            </ul>
            <ul class="navbar-nav ms-md-auto">

                <li class="nav-item">
                    <button type="button" class="btn btn-default btn-no-shadow" onclick="toggleLockObject()"
                            data-toggle="tooltip" title="Lock Object" id="lock">
                        <i class="fas fa-lock"></i>
                    </button>
                </li>

                <li class="nav-item">
                    <button type="button" class="btn btn-default btn-no-shadow" onclick="undo()"
                            data-toggle="tooltip" title="undo">
                        <i class="fas fa-undo"></i>
                    </button>
                </li>

                <li class="nav-item">
                    <button type="button" class="btn btn-default btn-no-shadow" onclick="redo()"
                            data-toggle="tooltip" title="redo">
                        <i class="fas fa-redo"></i>
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-default btn-no-shadow" onclick="exportToPNG()"
                            data-toggle="tooltip" title="Export To PNG">
                        <i class="fas fa-download"></i>
                    </button>
                </li>

                <li class="nav-item">
                    <button type="button" class="btn btn-default btn-no-shadow" onclick="newText()"
                            data-toggle="tooltip" title="New Text">
                        <i class="fas fa-plus"></i>
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-default btn-no-shadow" onclick="cloneElement()"
                            data-toggle="tooltip" title="Clone">
                        <i class="far fa-clone"></i>
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-default btn-no-shadow" onclick="deleteElement()"
                            data-toggle="tooltip" title="Delete">
                        <i class="far fa-trash-alt"></i>
                    </button>


                </li>
            </ul>
        </nav>


        <div id="design-responsive">
            <div id="design-area" style="transform: translate(50%, -50%); display: none;">
                <canvas id="canvas"></canvas>
            </div>
            <div id="loader">
                <div></div>
            </div>
        </div>
    </div>

    <button id="side-bar-open-button" type="button" onclick="toggleSideBar()" class="d-block d-md-none ">
        <i class="fas fa-plus"></i>
    </button>
</div>


<script src=" {{ asset('js/designer/jquery.js') }}"></script>
<script src=" {{ asset('js/site/bootstrap.bundle.js')}}"></script>
<script src=" {{ asset('js/designer/sweetalert2@11.js') }}"></script>
<script src=" {{ asset('js/designer/fabric.min.js') }}"></script>
<script src=" {{ asset('js/designer/fabric-history.js') }}"></script>
<script src=" {{ asset('js/designer/guidelines.js') }}"></script>
<script src=" {{ asset('js/designer/script.js') }}" defer></script>


<script>

    var canvas = new fabric.Canvas('canvas', {
        preserveObjectStacking: true
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip({placement: 'bottom', trigger: 'hover'})


        let image = new Image();
        image.src = '{{ $card->main_path  }}';
        image.onload = function () {
            canvas.setDimensions({width: image.width, height: image.height});
            canvas.setBackgroundImage(image.src, canvas.renderAll.bind(canvas));
            initAligningGuidelines(canvas);
            initCenteringGuidelines(canvas);
            doResize();

            $('#loader').fadeOut(1000, function () {
                $('#design-area').fadeIn(1000)
            });
        };

        fabric.Object.prototype.transparentCorners = false;
        fabric.Object.prototype.cornerColor = 'blue';
        fabric.Object.prototype.cornerStyle = 'circle';


    })
</script>


</body>
</html>
