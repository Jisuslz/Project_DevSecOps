Si tu sitio no tiene HTTPS y estás trabajando en un entorno local con Apache, puedes configurar HTTPS fácilmente utilizando un certificado autofirmado. Aquí hay una guía rápida sobre cómo hacerlo:

1. **Generar un certificado autofirmado**:
   Puedes generar un certificado autofirmado utilizando OpenSSL. Abre una terminal y ejecuta el siguiente comando:
   ```
   openssl req -x509 -newkey rsa:4096 -keyout key.pem -out cert.pem -days 365
   ```
   Esto generará un certificado (`cert.pem`) y una clave privada (`key.pem`) que serán válidos por 365 días.

2. **Configurar Apache para utilizar HTTPS**:
   Abre el archivo de configuración de Apache (`httpd.conf` o `apache2.conf`) y asegúrate de tener las siguientes directivas:
   ```
   Listen 443
   LoadModule ssl_module modules/mod_ssl.so
   ```

   Luego, agrega una configuración para el sitio que incluya la ubicación de tu certificado y clave privada:
   ```
   <VirtualHost *:443>
       ServerName ejemplo.com
       DocumentRoot /var/www/html

       SSLEngine on
       SSLCertificateFile /ruta/a/cert.pem
       SSLCertificateKeyFile /ruta/a/key.pem
   </VirtualHost>
   ```

3. **Habilitar el módulo SSL**:
   Ejecuta el siguiente comando para habilitar el módulo SSL en Apache:
   ```
   sudo a2enmod ssl
   ```

4. **Reiniciar Apache**:
   Reinicia Apache para que los cambios surtan efecto:
   ```
   sudo systemctl restart apache2
   ```

Una vez que hayas configurado HTTPS en tu entorno local, puedes ajustar la configuración de la cookie de sesión en PHP como se mencionó anteriormente, estableciendo `'secure' => false` en lugar de `true`. Esto permitirá que la cookie de sesión se transmita sobre HTTP en lugar de HTTPS. Sin embargo, ten en cuenta que esto no proporcionará la misma seguridad que HTTPS y es menos seguro en términos de protección contra ataques de session hijacking.



a tener en cuenta:

Si estás utilizando XAMPP para desarrollar en un entorno local y deseas configurar HTTPS con un certificado autofirmado, aquí tienes los pasos detallados:

1. **Generar un certificado SSL autofirmado:**

   Abre una terminal y navega hasta el directorio donde está instalado XAMPP. Luego, accede al subdirectorio `apache` y, dentro de este, al subdirectorio `bin`. Por ejemplo:

   ```bash
   cd /opt/lampp/apache/bin
   ```

   Ejecuta el siguiente comando para generar una clave privada:

   ```bash
   ./openssl genrsa -out key.pem 2048
   ```

   Después, genera un certificado autofirmado utilizando la clave privada:

   ```bash
   ./openssl req -new -x509 -key key.pem -out cert.pem -days 365
   ```

   Esto te guiará a través de un proceso interactivo para completar la información del certificado. Puedes proporcionar la información solicitada o dejar los campos en blanco.

2. **Configurar Apache para utilizar HTTPS:**

   Abre el archivo de configuración de Apache `httpd.conf`. Puedes encontrarlo en el directorio de configuración de XAMPP. Por ejemplo:

   ```
   /opt/lampp/etc/httpd.conf
   ```

   Añade las siguientes líneas al final del archivo para configurar un VirtualHost para el puerto 443:

   ```apache
   <VirtualHost *:443>
       ServerName localhost
       DocumentRoot "/opt/lampp/htdocs"
       SSLEngine on
       SSLCertificateFile "/ruta/a/cert.pem"
       SSLCertificateKeyFile "/ruta/a/key.pem"
   </VirtualHost>
   ```

   Asegúrate de reemplazar `/ruta/a/cert.pem` y `/ruta/a/key.pem` con las rutas reales donde se encuentran tus archivos `cert.pem` y `key.pem`.

3. **Reiniciar Apache:**

   Guarda los cambios en el archivo `httpd.conf` y reinicia el servidor Apache desde el panel de control de XAMPP o utilizando el siguiente comando en la terminal:

   ```bash
   sudo /opt/lampp/lampp restart
   ```

Una vez que hayas seguido estos pasos, Apache estará configurado para utilizar HTTPS con el certificado autofirmado. Puedes acceder a tu sitio web local utilizando `https://localhost`. Es posible que tu navegador muestre una advertencia de seguridad debido al certificado autofirmado, pero puedes ignorarla para fines de desarrollo local.

