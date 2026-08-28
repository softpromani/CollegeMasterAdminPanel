# 🚀 cPanel CI/CD GitHub Actions Deployment Guide

This repository includes a ready-to-use GitHub Actions workflow (`.github/workflows/deploy.yml`) and `.cpanel.yml` for automated deployments.

---

## 🔐 Step 1: Add GitHub Repository Secrets

In your GitHub repository, go to:
**Settings** &rarr; **Secrets and variables** &rarr; **Actions** &rarr; Click **"New repository secret"**

Add the following secrets:

| Secret Name | Description | Example Value |
|---|---|---|
| `FTP_SERVER` | Your cPanel domain or FTP server hostname | `ftp.yourdomain.com` or `yourdomain.com` |
| `FTP_USERNAME` | Your cPanel FTP username | `cpaneluser` or `deployer@yourdomain.com` |
| `FTP_PASSWORD` | Your cPanel FTP password | `your_secure_password` |
| `FTP_TARGET_DIR` | (Optional) Remote target directory in cPanel | `public_html/` or `subdomain.yourdomain.com/` |

---

## 🛠️ Step 2: One-time cPanel Setup for Laravel

1. **Upload or create `.env` in cPanel**:
   Ensure your `.env` file exists in the cPanel project directory with your production `APP_KEY`, `APP_URL`, and DB credentials.
2. **Storage Symlink**:
   In cPanel Terminal (or via cron job), run:
   ```bash
   php artisan storage:link
   ```
3. **Set Permissions**:
   ```bash
   chmod -R 775 storage bootstrap/cache
   ```

---

## 🔄 Step 3: Triggering Automated Deployment

Whenever you push code to `main` or `master`:
```bash
git add .
git commit -m "Deploy latest changes"
git push origin master
```
GitHub Actions will automatically:
1. Spin up a clean PHP 8.2 environment.
2. Install production composer dependencies (`composer install --no-dev --optimize-autoloader`).
3. Deploy all optimized files to your cPanel `public_html` directory via FTPS.