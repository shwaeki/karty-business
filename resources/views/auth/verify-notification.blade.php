<!doctype html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
</head>

<style>
    :root {
        --primary: #5a5aaa;
    }

    body, input {
        margin: 0;
        padding: 0;
        font-family: Cairo, serif;
    }

    header {
        background-color: var(--primary);
        height: 250px;
        color: white;
        text-align: center;
        line-height: 210px;
        margin-bottom: 50px;
    }

    header h1 {
        margin: 0;
        font-size: 45px;
    }

    main {
        text-align: center;
        width: 50%;
        margin: auto;
    }

    main #button {
        background-color: var(--primary);
        padding: 10px 30px;
        text-decoration: none;
        color: #fff;
        display: inline-block;
        margin: 10px;
    }

    main #link {
        text-align: end;
        display: block;
    }

    footer {
        background-color: var(--primary);
        text-align: center;
        color: white;
        margin-top: 50px;
    }

    footer p {
        margin: 0;
        padding: 15px;
    }

    @media (max-width: 767.98px) {
        header {
            height: 170px;
            line-height: 150px;
        }

        header h1 {
            font-size: 25px;
        }

        main {
            width: 90%;
        }
    }

</style>

<body>


<header>
    <h1>اهلاً وسهلاً بك في موقع كرتي</h1>
</header>

<main>
    <h3>نشكرك على إنضمامك لعائلة كرتي</h3>
    <p>نشكرك على تسجيلك في موقع كرتي، ونعدك بالحصول على تجربة مميزة، لتأكيد حسابك بإمكانك الضغط على زر التأكيد في
        الأسفل.</p>
    <a href="{{ $actionUrl }}" id="button">تأكيد الحساب</a>
    <p>إذا لم تكن انت من ارسل الطلب الحساب، لا داعي لإتخاذ اي اجراء<br>مع تحيات<strong> كرتي </strong></p>
    <p>إذا واجهت مشكلة في الضغط على زر "تأكيد الحساب"، رجاءً قم بنسخ الرابط المدرج بالأسفل وقم بلصقه في المتصفح:</p>
    <a href="{{$actionUrl}}" id="link"> <em>{{$actionUrl}}</em></a>
</main>

<footer class="text-center">
    <p>جميع الحقوق محفوظة لموقع كرتي © 2020</p>
</footer>

</body>

</html>
