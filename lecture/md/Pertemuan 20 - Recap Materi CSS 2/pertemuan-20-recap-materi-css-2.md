# Pertemuan 20 - Recap Materi CSS 2

## Pendahuluan

Kita akan membahas CSS yang belum dibahas di pertemuan 19, CSS ini akan sedikit ke-dalam jadi kalau belum baca yang ke-19 tolong dibaca terlebih dahulu agar dapat memahami konteksnya.

Materi yang akan kita bahas masih di definisi CSS dan ditambah dengan Media Query.

## Macam-Macam perintah CSS

### Opacity

CSS ini digunakan untuk memberikan tranparansi kepada elemen HTML, CSS ini hanya menerima `%` dan hanya 0-100%.

```html
<p style='opacity: 40%'>Hello, World!</p>
```

Dari contoh di-atas akan menghasilkan.

![`<p>` transparent](image/p-transparent.png)

### Box Shadow

CSS ini digunakan untuk memberi effect bayangan di elemen HTML, CSS ini menerima banyak input, yang `offset`, `blur-radius`, sama `spread-radius` di-isi `px`, `rem`, `%`, dan color hanya dapat di-isi dengan warna dan biasanya berbentuk `#FFFF` atau `rgb(255,255,255)`.

- box-shadow: none;
- box-shadow: offset-x offset-y color;
- box-shadow: offset-x offset-y blur-radius color;
- box-shadow: t-x offset-y blur-radius spread-radius color;

Contoh :

```html
<p style='box-shadow: 4px 8px 0.25rem 2px gray; padding: 1rem'>Hello, World!</p>
```

Hasil dari contoh di-atas :

![`<p>` with Box Shadow](image/p-box-shadow.png)
