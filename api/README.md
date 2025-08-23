## 🔧 Configuration Environnement

### Création du fichier de configuration local

1. **Dupliquer le fichier d'environnement :**

```bash
  cd api
  cp .env .env.local
```

2. **Générer une clé secrète d'application :**

Ouvrir le container php et générer la clé secrète pour votre variable d'environnement `APP_SECRET`

```bash
  php bin/console secrets:generate-keys
```

---

**Génération du fichier swagger.json**

```
./vendor/bin/openapi --format json --output ./public/swagger-ui/swagger.json ./swagger/swagger.php src
```

Redémarrer les containers pour actualiser les changements :

```bash
  docker restart $(docker ps -q)
```
