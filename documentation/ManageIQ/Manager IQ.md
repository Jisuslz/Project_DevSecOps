# Easy Install With Docker

REFERENCIA: [documentacion](https://www.manageiq.org/docs/get-started/basic-configuration)

You can test ManageIQ running in a Docker container using the images that the ManageIQ project makes available on the [Docker Hub](https://hub.docker.com/r/manageiq). This is a great option if you have a Linux PC (but it works everywhere Docker is available).

If you are on Linux, make sure the Docker service is running:

```
$ sudo systemctl start docker
```

### Step 1: Download and deploy the appliance

Pull the ManageIQ docker image:

```
$ docker pull manageiq/manageiq:quinteros-1
```

### Step 2: Run the container

```
$ docker run -d -p 8443:443 manageiq/manageiq:quinteros-1
```

ManageIQ is now up and running.

Next step is to perform some [basic configuration](https://www.manageiq.org/docs/get-started/basic-configuration).

# Configuración básica

### 1. Introducción

El dispositivo ManageIQ es una imagen de máquina virtual que se ejecuta en un sistema operativo basado en Red Hat Enterprise Linux. Es recomendable realizar algunas tareas en el dispositivo (por ejemplo, cambiar la contraseña raíz y configurar claves ssh).

1. La base de datos del dispositivo ya se ha configurado en las instalaciones de Docker y Vagrant. Si utiliza otros tipos de dispositivos (como OpenStack o VMware), siga la documentación de su proveedor para realizar la configuración.
2. Apunte su navegador a su dirección IP
    
    1. **Docker:** host local (https://127.0.0.1:8443)

![[Pasted image 20240818190058.png]]

### 2. Inicie sesión con las credenciales predeterminadas

1. **Iniciar sesión:** admin
2. **Contraseña:** smartvm

### 3. Navegación vertical de ManageIQ.

Los menús principales están disponibles en la parte izquierda de la pantalla y los menús secundarios y terciarios se expanden cuando es necesario. Puedes anclar un menú secundario o terciario para navegar fácilmente por sus elementos.

![alt text](/LaboratorioFinalVuln/Anexos/20240818190111.png)
Anexos/![[Pasted image 20240818190111.png]]

### 4. Cambiar opciones

En el siguiente ejemplo, haga clic en la esquina superior derecha: EVM → Configuración para cambiar el comportamiento del dispositivo:

#### 1. Seleccione el dispositivo que desea configurar

- **_Región CFME: Región 0 → Zonas → Zona: Zona predeterminada (actual) → Servidor: EVM[1](actual)_** debe seleccionarse de forma predeterminada.
- Aquí se mostrarán el nombre de host y la dirección IP del dispositivo; tenga cuidado ya que en algunos casos será la dirección IP interna y no aquella a la que se conectó.
- Puedes cambiar el _nombre de la empresa_ por el que desees, el cambio se reflejará en la interfaz. **_Cámbialo a ManageIQ_**
- Seleccione su zona horaria y, si lo desea, puede cambiar la configuración regional predeterminada.
- El control del servidor define qué funciones ejecuta cada dispositivo en una implementación de varios dispositivos. Por ahora, como solo tenemos un dispositivo, selecciona todas las opciones de C&U y Notificación. No selecciones Sincronización de base de datos, Propietario de repositorios Git, Espejo de RHN o Proxy inteligente a menos que los necesites.

![[Pasted image 20240818190123.png]]

#### 2. Seleccione Preferencias visuales y Vistas predeterminadas

En el siguiente ejemplo, haga clic en la parte superior derecha: EVM → Mi configuración para cambiar las funciones de este dispositivo.

- Aquí puede seleccionar sus preferencias personales sobre cómo se le mostrará la interfaz de usuario. Cambie los elementos predeterminados por página, así como la página de inicio predeterminada que se muestra al iniciar sesión.

![[Pasted image 20240818190135.png]]

#### 3. Configure su servidor de correo electrónico para que ManageIQ pueda enviarle correos electrónicos


![[Pasted image 20240818190146.png]]

#### 4. Guarde los cambios

**_Presione Guardar_** para guardar sus cambios


