# Pertemuan 32 - Pendalaman CSS

## Pendahuluan

Pada pertemuan 20 kita membahas beberapa CSS, tetapi kita melewati beberapa konsep, nah untuk pertemuan kali ini kita akan mendalami CSS dan membahas apa saja yang belum dibahas seperti css selector in-depth, pseudo class, animation, flexbox in-depth, untuk keyword/perintah CSS bisa di cek di link dibawah.

## CSS Selector In-Depth

Kemarin kita mempelajari selector css yang tidak bisa men-select anak element, nah ini beberapa selector css yang saya tau yang berguna untuk men-select anak element, kenapa kita harus belajar ini, agar kita bisa memperbagus halaman website kita dan mengurangi duplikasi kode juga.

Untuk contoh kita akan menggunakan struktur HTML jadi kalau dipraktek-kan tolong diperhatikan hasilnya di browser

```html
<body>
    <div class="container">
        <p>Hi!</p>

        <div class="card">
            <h2>MyCard</h2>
            <p>Hello, World</p>
        </div>

        <h1>List of fruit?</h1>
        <ul>
            <li>Banana</li>
            <li>Pineapple</li>
            <li>Durian</li>
            <li>Mango</li>
        </ul>
    </div>
</body>
```

Hasilnya :

![](photo/default.png)

### Grouping Selector

Yang pertama ialah `Grouping Selector` apa sih itu, css ini digunakan untuk men-select element HTML lebih dari satu semisal :

```css
p, h2, h1 {
    color: orange;
}
```

Note : Selector ini dapat digabung dengan class selector atau yang lainnya.

Hasilnya :

![](photo/grouping.png)

### Descendant Combinator

Selanjutnya ialah Descendant Combinator, ini digunakan men-select anak element dengan menggunakan spasi setelah selector kita, selector ini dapat digabung dengan class selector atau yang lainnya, contoh :

```css
// Ini akan menselect semua tag p didalam div
div p {
    color: red;
}
```

![](photo/descendant-combinator.png)

### Direct Child Combinator

Selanjutnya ialah Direct Child Combinator, css selector ini bisa digunakan untuk men-select yang hanya anaknya langsung, jadi kalau anak element terus anaknya lagi tidak bisa, contoh :

```css
.container > p {
    color: green;
}
```

Kita juga bisa menggunakannya sepert ini juga

```css
.container > div > h2 {
    color: green;
}
```

Hasilnya :

![](photo/direct-child-combinator.png)

## Pseudo-Class

Pseudo Class merupakan merupakan suatu cara untuk mendefinisikan style ketika element HTML mengalami suatu event tertentu seperti di tunjuk, ter-highlight, atau sudah dikunjungi.

Penulisannya sangat sederhana

```css
selector:pseudo-class {
    //
}
```

Macam macam Pseudo Class yang sering dipakai :

- hover : ini akan men-trigger kode css ketika element yang di select di hover
- focus : ini akan men-trigger kode css ketika element yang baru fokus seperti `<input>` di klik
- visited : ini akan men-trigger kode css ketika link sudah dikunjungi
- root : pseudo class ini tidak perlu selector karena ini akan men-select tag `<html>`, ini sering dipakai untuk menyimpan variabel css
- nth-child : ini akan men-trigger kode css kalau element posisinya sesuai dengan parameter yang dikasih (misalnya 2 jadi setelah elemen pertama nanti element selanjutnya akan di style pakai css tersebut dan selanjutnya tidak)
- nth-last-child : sama dengan `nth-child` tetapi kebalikannya (mulai dari element terakhir)
- first-child : akan mentrigger css pada element pertama
- last-child : kebalikannya `first-child`

## Animation

Di CSS kita juga dapat membuat animasi dengan menggunakan transition dan keyframe, fitur ini dapat membuat animasi tanpa ada bantuan Javascript tetapi fitur ini terbatas jadi kalau ingin yang kompleks harus menggunakan Javascript.

Hal yang paling sederhana ialah menggunakan keyword `transition` ini tidak terlalu banyak effectnya tetapi bisa digunakan untuk men-setting berapa lama animasi yang berlangsung ketika ada pergantian effect css seperti ganti warna, contoh :

```css
* {
    transition: 1s;
}

*:hover {
    color: red;
    translate: 20px;
}
```

### Keyframe

Keyword ini digunakan untuk membuat animasi yang kompleks, untuk menggunakan ini di selector HTML kita harus menulis keyword animation dan juga mendefinisikan keyframenya.

Contoh paling sederhana

```css
div.container {
    animation: slidein 1s;
}

@keyframes slidein {
    from {
        transform: translateX(-100px);
    }

    to {
        transform: translateX(10px);
    }
}
```

Kita juga bisa lebih spesifikan lagi dengan memberikan persen daripada kalimat `from` dan `to`.

Contoh :

```css
div.container {
    animation: slidein 1s;
}

@keyframes slidein {
    0% {
        transform: translateX(-100px);
    }

    70% {
        transform: translateX(20px);
    }

    100% {
        transform: translateX(0px);
    }
}
```

Di keyword animation ini kita juga bisa membuat animasi lebih halus, dengan menggunakan `ease-in-out`, karena ini sangat banyak keyword dan kreatifitas jadi susah untuk men-cover semuanya jadi saya taruh referensi dibawah ini.

Source :

<https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Animations/Using_CSS_animations>

<https://developer.mozilla.org/en-US/docs/Web/CSS/Reference>

<https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Selectors>
