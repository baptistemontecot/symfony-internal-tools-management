# 🗄️ Internal Tools Database - Quick Setup

Ready-to-use database environment for API development tests.

## 🚀 Quick Start

### MySQL + phpMyAdmin 
```bash
# Method 1: Script (recommended)
chmod +x start-mysql.sh && ./start-mysql.sh

# Method 2: Direct command
docker-compose --profile mysql up -d
```

**Access in 30 seconds:**
- 🗄️ **MySQL:** `localhost:3306`
- 🌐 **phpMyAdmin:** http://localhost:8080
- 👤 **Credentials:** `dev / dev123`
- 📊 **Database:** `internal_tools`

### Build and start PHP et Nginx containers

```bash
  docker-compose up -d --build 
```

**Access:**
- 🌐 **Nginx (API server):** http://localhost:8000
- 🔧 **Logs containers:**

```bash
  docker-compose logs -f php
  docker-compose logs -f nginx
```

## 🛠️ Quick Commands

```bash
# Test connections
./test-connection.sh

# Stop everything
docker-compose --profile all down

# Reset all data (⚠️ destructive)
./reset-all.sh

# View logs
docker-compose logs -f mysql
```

## 📊 Connection Strings

```bash
# MySQL
mysql://dev:dev123@localhost:3306/internal_tools
"mysql:host=localhost;port=3306;dbname=internal_tools"
```

---

## **⚡ COMMANDES  FINALES**

### **🐬 Pour MySQL **
```bash
docker-compose --profile mysql up -d
# ✅ MySQL + phpMyAdmin prêts !
# 🌐 Interface: http://localhost:8080
```

### **🎯 Pour Tests Comparatifs**
```bash
docker-compose --profile all up -d  
# ✅ Les deux bases + interfaces prêtes !
```