
# Loan API (Laravel 11 + PHP 8.2)

A simple **Loan Management API** built with Laravel.  
It supports creating loans, adding repayments, and retrieving loan summaries.  
This project is fully tested with **Feature tests** and **Unit tests**.

---

## 🚀 Features
- Create a loan with borrower name and principal amount.  
- Add repayments to an existing loan.  
- Get a loan summary (total repaid + outstanding balance).  
- Input validation (422 on invalid data).  
- Unit & Feature tests included.

---

## 🛠️ Requirements
- PHP 8.2+
- Composer
- MySQL (or SQLite for testing)
- Node.js 20.19+ or 22.12+ (for Vite, optional)
- Laravel 11

---

## ⚙️ Setup Instructions

Clone the repo:
```bash
git clone https://github.com/qistina30/loan-api.git
cd loan-api
````

Install dependencies:

```bash
composer install
```

Copy `.env`:

```bash
cp .env.example .env
```

Generate key:

```bash
php artisan key:generate
```

Configure database in `.env` (MySQL or SQLite).

Run migrations:

```bash
php artisan migrate
```

Start dev server:

```bash
php artisan serve
```

---

## 📌 API Endpoints

### 1. Create Loan

**PowerShell (Windows):**

```powershell
Invoke-WebRequest "http://127.0.0.1:8000/api/loans" `
  -Method POST `
  -ContentType "application/json" `
  -Body '{"borrower_name":"Alice","principal_cents":"1000000"}'
```

**curl (macOS or Windows with curl.exe):**

```bash
curl -X POST http://127.0.0.1:8000/api/loans \
  -H "Content-Type: application/json" \
  -d '{"borrower_name":"Alice","principal_cents":"1000000"}'
```

**Response:**

```json
{
  "id": 1,
  "borrower_name": "Alice",
  "principal_cents": "1000000",
  "summary": {
    "total_paid_cents": "0",
    "outstanding_principal_cents": "1000000"
  }
}
```

---

### 2. Add Repayment

**PowerShell (Windows):**

```powershell
Invoke-WebRequest "http://127.0.0.1:8000/api/loans/1/repayments" `
  -Method POST `
  -ContentType "application/json" `
  -Body '{"amount_cents":"500000","paid_at":"2024-09-01"}'
```

**curl (macOS or Windows with curl.exe):**

```bash
curl -X POST http://127.0.0.1:8000/api/loans/1/repayments \
  -H "Content-Type: application/json" \
  -d '{"amount_cents":"500000","paid_at":"2024-09-01"}'
```

**Response:**

```json
{
  "id": 1,
  "loan_id": 1,
  "amount_cents": "500000",
  "paid_at": "2024-09-01"
}
```

---

### 3. Get Loan Summary

**PowerShell (Windows):**

```powershell
Invoke-WebRequest "http://127.0.0.1:8000/api/loans/1" `
  -Method GET
```

**curl (macOS or Windows with curl.exe):**

```bash
curl http://127.0.0.1:8000/api/loans/1
```

**Response:**

```json
{
  "id": 1,
  "borrower_name": "Alice",
  "principal_cents": "1000000",
  "summary": {
    "total_paid_cents": "500000",
    "outstanding_principal_cents": "500000"
  }
}
```

---

💡 **Tip (PowerShell only):** To see **just the JSON response**:

```powershell
(Invoke-WebRequest "http://127.0.0.1:8000/api/loans/1" -Method GET).Content
```

---

## ✅ Tests

Run all tests:

```bash
php artisan test
```

Run feature test only:

```bash
php artisan test --filter=LoanFlowTest
```

Run unit test only:

```bash
php artisan test --filter=LoanSummaryServiceTest
```

---

## 📂 Project Structure

```
app/
 ├── Http/Controllers/LoanController.php
 ├── Models/Loan.php
 ├── Models/Repayment.php
 ├── Services/LoanSummaryService.php
database/
 ├── migrations/
 ├── factories/
routes/
 ├── api.php
tests/
 ├── Feature/LoanFlowTest.php
 ├── Unit/LoanSummaryServiceTest.php
```

---

⚠️ Remark: This mini project are prepared for Capsphere interview purposes only.




