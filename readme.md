# Veselica Docker Nastavitev

Ta projekt ponuja Docker okolje za poganjanje PHP aplikacije **Veselica**, ki uporablja MariaDB za bazo podatkov, Nginx kot reverse proxy in Certbot za SSL certifikate.

## Datoteke

### Dockerfile
- **Osnova**: `alpine:latest`
- **Instalacija**: Namesti PHP in potrebne razširitve:
  - `mysqli`, `curl`, `json`, `session`
- **Delovna mapa**: `/opt/veselica`
- **Kopiranje vsebine** aplikacije v container.
- **Zagon strežnika**: PHP vgrajeni strežnik posluša na `0.0.0.0:80`.

### docker-compose.yml
#### Verzija: `3.8`

#### Servisi:
1. **app**:
   - Gradi se iz `Dockerfile`.
   - **Environment spremenljivke za povezavo z bazo**:
     - `DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`.
   - Odvisen od servisa `db`.
   - Priključen na omrežje `proxy_network`.

2. **db** (MariaDB 12):
   - Inicializira podatkovno bazo in uporabnika.
   - Shranjevanje podatkov v **persistenten volumen** `db_data`.
   - **Healthcheck** je aktiviran.

3. **proxy** (Nginx):
   - Posluša na portih `80/443`.
   - Reverse proxy do `app`.
   - SSL certifikati so nameščeni in obnavljani prek `Certbot`.
   - Priključen na omrežje `proxy_network`.

4. **certbot**:
   - Periodično obnavlja SSL certifikate.

#### Volumni:
- **db_data**: Volumen za shranjevanje podatkov MariaDB.

#### Omrežja:
- **proxy_network**: Skupno omrežje za vse servise.

## Uporaba
1. Postavite okolje z ukazom:
   ```bash
   docker-compose up -d
   ```

2. Aplikacija bo dostopna na:
   - `https://devops-sk-01.lrk.si` 
   - Prek domene, konfigurirane v Nginxu.

3. **SSL certifikati**:
   - Samodejno obnavljanje prek Certbota.

---
