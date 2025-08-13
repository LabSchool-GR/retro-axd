<p align="center">
  <img src="https://labschool.gr/retro-axd/storage/retro-guardians-axd-250px.png" alt="Retro-AXD Logo" width="250">
</p>

<h1 align="center">Retro-AXD</h1>
<p align="center">
  <em>Σύστημα καταγραφής εκθεμάτων υπολογιστών, λογισμικού και τεχνολογίας προηγούμενων δεκαετιών</em>
</p>

<p align="center">
  <a href="https://labschool.gr/retro-axd/" target="_blank">
    <img src="https://img.shields.io/badge/Δοκιμάστε-Online-success?style=for-the-badge&logo=laravel" alt="Live Demo">
  </a>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-^8.2-blue?style=for-the-badge&logo=php" alt="PHP Version">
  <img src="https://img.shields.io/badge/Laravel-12.x-red?style=for-the-badge&logo=laravel" alt="Laravel Version">
  <img src="https://img.shields.io/github/license/LabSchool-GR/retro-axd?style=for-the-badge" alt="License">
  <img src="https://img.shields.io/badge/Status-Active-brightgreen?style=for-the-badge" alt="Project Status">
</p>

---

## Πίνακας Περιεχομένων
- 🔗 [Retro Guardians AXD](#Retro-Guardians-AXD)
- 📖 [Περιγραφή](#περιγραφή)
- ✨ [Χαρακτηριστικά](#χαρακτηριστικά)
- ⚙ [Απαιτήσεις Συστήματος](#απαιτήσεις-συστήματος)
- 💻 [Εγκατάσταση (Τοπικά, XAMPP)](#εγκατάσταση-τοπικά-xampp)
- 🚀 [Εγκατάσταση σε Server (Production)](#εγκατάσταση-σε-server-production)
- 📜 [Άδεια Χρήσης](#άδεια-χρήσης)
- 🤝 [Credits](#credits)

---

## Retro Guardians AXD
-  Δοκιμάστε την εφαρμογή σε πλήρη λειτουργία από την ομάδα μας:
**[https://labschool.gr/retro-axd/](https://labschool.gr/retro-axd/)**
- Ελάτε στην ομάδα μας και γραφτείτε ως μέλη ή φίλοι του συλλόγου μας:
**[https://steth.gr/registration/](https://steth.gr/registration/)**

---

## Περιγραφή
Το **Retro-AXD** είναι ένα σύστημα καταγραφής και παρουσίασης εκθεμάτων που διαθέτει η ομάδα **Retro Guardians AXD** του Συλλόγου Τεχνολογίας Θράκης.  
Μπορεί να προσαρμοστεί και για άλλες συλλογές, επιτρέποντας πλήρη διαχείριση, αναζήτηση και παρουσίαση εκθεμάτων και υλικών.

---

## Χαρακτηριστικά
- 🔑 Σύστημα Εγγραφής με δυνατότητα επιβεβαίωσης e-mail, σύνδεση & διαχείριση προφίλ χρηστών.
- 📋 Φόρμα καταγραφής εγγραφών με προσαρμοσμένα πεδία και ανάρτηση εικόνων.
- 🖼 Προβολή εγγραφών σε λίστα ή σε πλέγμα με προβολή μικρογραφιών εικόνων.
- 📤 Εξαγωγή λίστας εγγραφών σε MS Excel.
- 🏷 Δημιουργία καρτέλας και **QR Code** για κάθε εγγραφή. 
- 👥 Ρόλοι χρηστών: Διαχειριστής, Καταχωριστής, Μέλος. 
- 🗂 Διαχείριση κατηγοριών.
- 📬 Σελίδα επικοινωνίας με αποστολή e-mail στους διαχειριστές.

---

## Απαιτήσεις Συστήματος
- PHP **^8.2**
- MySQL/MariaDB
- Composer
- Node.js & npm
- Ελάχιστος διαθέσιμος χώρος: ~200MB

> **Packages (composer)**: barryvdh/laravel-dompdf, intervention/image, maatwebsite/excel, simplesoftwareio/simple-qrcode, spatie/laravel-permission  
> **Dev**: laravel/breeze, pestphp/pest, κ.ά.

💡 **1η Σημείωση για Storage σε XAMPP**:  
Αντί για συμβολικό σύνδεσμο (`php artisan storage:link`), μπορείς να ορίσεις Apache Alias ώστε το `storage/app/public` να σερβίρεται ως `/retro-axd/storage`.

💡 **2η Σημείωση για Στοιχεία εισόδου Admin**:  
demo@retro-axd.gr | password123

---

## Εγκατάσταση σε Υπολογιστή (Τοπικά, XAMPP)

```bash
# 1) Κλωνοποίηση αποθετηρίου
git clone https://github.com/LabSchool-GR/retro-axd.git
cd retro-axd

# 2) Εγκατάσταση PHP dependencies
composer install

# 3) Εγκατάσταση JS dependencies
npm install

# 4) Δημιουργία αρχείου περιβάλλοντος
cp .env.example .env
php artisan key:generate

# 5) Ρύθμιση .env (DB, MAIL, APP_URL)

# 6) Εκτέλεση migrations
php artisan migrate

# 7) Εκκίνηση development servers
php artisan serve
npm run dev
```

---

## Εγκατάσταση σε Server (Production)

```bash
composer install --optimize-autoloader --no-dev
npm install && npm run build
php artisan key:generate
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Δικαιώματα φακέλων

```bash
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

---

## Άδεια Χρήσης
Μη εμπορική χρήση, με υποχρεωτική αναφορά δημιουργού (**Non-Commercial, Attribution Required**).  
Δείτε αναλυτικά τους όρους στο αρχείο **LICENSE**.

---

## Credits
Αναπτύχθηκε με τη βοήθεια του **Συλλόγου Τεχνολογίας Θράκης** και την ομάδα **Retro Guardians AXD** του συλλόγου.

<p align="center">
  <img src="https://steth.gr/wp-content/uploads/2017/12/cropped-final_logo_web_250.png" alt="STETH Logo" height="115">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <img src="https://labschool.gr/retro-axd/storage/retro-guardians-axd-250px.png" alt="Retro-AXD Logo" height="115">
</p>

<p align="center">
  <a href="https://steth.gr" target="_blank">Σύλλογος Τεχνολογίας Θράκης</a> |
  <a href="https://www.facebook.com/profile.php?id=61556225845165" target="_blank">Retro Guardians AXD</a>
</p>


