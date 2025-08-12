<p align="center">
  <img src="https://labschool.gr/retro-axd/storage/retro-guardians-axd-250px.png" alt="Retro-AXD Logo" width="250">
</p>

<h1 align="center">Retro-AXD</h1>
<p align="center">
  <em>Σύστημα καταγραφής εκθεμάτων υπολογιστών, λογισμικού και τεχνολογίας προηγούμενων δεκαετιών</em>
</p>

<p align="center">
  <a href="https://labschool.gr/retro-axd/" target="_blank">
    <img src="https://img.shields.io/badge/Δες_την_εφαρμογή-Online-success?style=for-the-badge&logo=laravel" alt="Live Demo">
  </a>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-^8.2-blue?style=for-the-badge&logo=php" alt="PHP Version">
  <img src="https://img.shields.io/badge/Laravel-12.x-red?style=for-the-badge&logo=laravel" alt="Laravel Version">
  <img src="https://img.shields.io/github/license/LabSchool-GR/retro-axd?style=for-the-badge" alt="License">
  <img src="https://img.shields.io/badge/Status-Active-brightgreen?style=for-the-badge" alt="Project Status">
</p>

---

## 📑 Πίνακας Περιεχομένων
- [🔗 Live Demo](#live-demo)
- [📖 Περιγραφή](#περιγραφή)
- [✨ Χαρακτηριστικά](#χαρακτηριστικά)
- [⚙ Απαιτήσεις Συστήματος](#απαιτήσεις-συστήματος)
- [💻 Εγκατάσταση (Τοπικά, XAMPP)](#εγκατάσταση-τοπικά-xampp)
- [🚀 Εγκατάσταση σε Server (Production)](#εγκατάσταση-σε-server-production)
- [📜 Άδεια Χρήσης](#άδεια-χρήσης)
- [🤝 Credits](#credits)

---

## Live Demo
Δες την εφαρμογή σε πλήρη λειτουργία: **[https://labschool.gr/retro-axd/](https://labschool.gr/retro-axd/)**

---

## Περιγραφή
Το **Retro-AXD** είναι ένα σύστημα καταγραφής και παρουσίασης εκθεμάτων που διαθέτει η ομάδα **Retro Guardians AXD** του Συλλόγου Τεχνολογίας Θράκης.  
Μπορεί να προσαρμοστεί και για άλλες συλλογές, επιτρέποντας πλήρη διαχείριση, αναζήτηση και παρουσίαση.

---

## Χαρακτηριστικά
- 📋 Φόρμα καταγραφής με εικόνες και προσαρμοσμένα πεδία  
- 🖼 Προβολή εγγραφών σε λίστα ή πλέγμα  
- 📤 Εξαγωγή σε **Excel** & **PDF**  
- 🏷 Δημιουργία καρτέλας και **QR Code** για κάθε εγγραφή  
- 👥 Ρόλοι χρηστών: Διαχειριστής, Καταχωριστής, Μέλος  
- 🗂 Διαχείριση κατηγοριών  
- 🔑 Εγγραφή, σύνδεση & προφίλ χρηστών  
- 📬 Σελίδα επικοινωνίας

---

## Απαιτήσεις Συστήματος
- PHP **^8.2**
- MySQL/MariaDB
- Composer
- Node.js & npm
- Ελάχιστος διαθέσιμος χώρος: ~200MB

> **Packages (composer)**: barryvdh/laravel-dompdf, intervention/image, maatwebsite/excel, simplesoftwareio/simple-qrcode, spatie/laravel-permission  
> **Dev**: laravel/breeze, pestphp/pest, κ.ά.

💡 **Σημείωση για Storage σε XAMPP**:  
Αντί για συμβολικό σύνδεσμο (`php artisan storage:link`), μπορείς να ορίσεις Apache Alias ώστε το `storage/app/public` να σερβίρεται ως `/retro-axd/storage`.

---

## Εγκατάσταση (Τοπικά, XAMPP)

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
Δες αναλυτικά τους όρους στο αρχείο **LICENSE**.

---

## Credits
Αναπτύχθηκε από την ομάδα **LabSchool-GR**  
σε συνεργασία με τον **Σύλλογο Τεχνολογίας Θράκης** και την ομάδα **Retro Guardians AXD**.
