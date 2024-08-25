
# Primeros pasos 🏃‍️ con ArgoCD en Kubernetes 🤘

## Instalación con Helm Chart y gestion desde CLI

---
## Requisitos:

- Tener instalado el binario de Helm https://helm.sh/docs/intro/install/
- Tener instalado Minikube https://minikube.sigs.k8s.io/docs/start/
- Tener instalado el Binario de ArgoCD https://argo-cd.readthedocs.io/en/stable/cli_installation/
---
Iniciamos nuestro Minikube para contar con un Cluster de K8s en local
````
minikube start
````
Añadimos el repo de Helm
```
helm repo add argo https://argoproj.github.io/argo-helm
```
Hacemos pull del Chart para descargarlo, poder ver el contenido del Chart e instalarlo.
```
helm pull argo/argo-cd --version 5.8.2
```
Descomprimimos el paquete TGZ del Chart descargado
````
tar -zxvf argo-cd-5.8.2.tgz
````
Hacemos la instalación pasando parámetros de configuración
````
helm install argo-cd argo-cd/ \
  --namespace argocd \
  --create-namespace --wait \
  --set configs.credentialTemplates.github.url=https://github.com/jisuslz \
  --set configs.credentialTemplates.github.username=$(cat ~/.secrets/github/jisuslz/user) \
  --set configs.credentialTemplates.github.password=$(cat ~/.secrets/github/jisuslz/token)
````


### Solución Alternativa: Uso de Variables de Entorno Directamente en el Comando

Si el problema persiste, puedes intentar definir y usar las variables de entorno directamente en el mismo comando:

```
export GITHUB_USER=$(cat ~/.secrets/github/jisuslz/user)
export GITHUB_TOKEN=$(cat ~/.secrets/github/jisuslz/token)

```

```
GITHUB_USER=$(cat ~/.secrets/github/jisuslz/user) GITHUB_TOKEN=$(cat ~/.secrets/github/jisuslz/token) helm install argo-cd argo-cd/ --namespace argocd --create-namespace --wait --set "configs.credentialTemplates.github.url=https://github.com/jisuslz" --set "configs.credentialTemplates.github.username=$GITHUB_USER" --set "configs.credentialTemplates.github.password=$GITHUB_TOKEN"

```

```
NAME: argo-cd
LAST DEPLOYED: Sat Jun  8 17:28:28 2024
NAMESPACE: argocd
STATUS: deployed
REVISION: 1
TEST SUITE: None
NOTES:
In order to access the server UI you have the following options:

1. kubectl port-forward service/argo-cd-argocd-server -n argocd 8080:443

    and then open the browser on http://localhost:8080 and accept the certificate

2. enable ingress in the values file `server.ingress.enabled` and either
      - Add the annotation for ssl passthrough: https://argo-cd.readthedocs.io/en/stable/operator-manual/ingress/#option-1-ssl-passthrough
      - Set the `configs.params."server.insecure"` in the values file and terminate SSL at your ingress: https://argo-cd.readthedocs.io/en/stable/operator-manual/ingress/#option-2-multiple-ingress-objects-and-hosts


After reaching the UI the first time you can login with username: admin and the random password generated during the installation. You can find the password by running:

kubectl -n argocd get secret argocd-initial-admin-secret -o jsonpath="{.data.password}" | base64 -d

(You should delete the initial secret afterwards as suggested by the Getting Started Guide: https://argo-cd.readthedocs.io/en/stable/getting_started/#4-login-using-the-cli)
adminlab@adminlab:~$ 


```

Imprimimos en pantalla la contraseña del usuario "admin" por defecto que se ha generado automáticamente en la instalación
````
kubectl -n argocd get secret argocd-initial-admin-secret -o jsonpath="{.data.password}" | base64 -d; echo
````


Levantamos un Port-Forward para poder acceder a ArgoCD UI desde localhost:8080
````
kubectl port-forward service/argo-cd-argocd-server -n argocd 8080:443

# desde otro equipo en el mismo segmento de red 
 kubectl port-forward service/argo-cd-argocd-server -n argocd 8080:443 --address="0.0.0.0"
````

Nota: Podemos ingresar desde la web con admin y 3OUCQhwAemrVVJnU la clave en base 64

## Para poder ingresar desde la TTY toca que instalar el cliente
### Solución 3: Descargar con Permisos Elevados

Descarga el archivo con permisos elevados:

```sh
sudo curl -sSL -o /usr/local/bin/argocd https://github.com/argoproj/argo-cd/releases/latest/download/argocd-linux-amd64
```

Haz el archivo ejecutable:

```sh
sudo chmod +x /usr/local/bin/argocd
```

Verifica la instalación:

```sh
argocd version
```


## Cambiar desde la tty la contraseña
Hacemos login en ArgoCD con la contraseña que hemos obtenido
````
kubectl port-forward service/argo-cd-argocd-server -n argocd 8080:443
argocd login localhost:8080

#otro equipo 
https://192.168.1.13:8080
````

![[Pasted image 20240608134445.png]]


Una vez que hemos hecho login satisfactoriamente cambiamos la contraseña generada por una que nos venga mejor, como por ejemplo "argocdpass"
````
argocd account update-password
````

![[Pasted image 20240608134906.png]]

Ahora que estamos logados con el binario de argocd podemos crear el repositorio de código.
````
argocd repo add https://github.com/Jisuslz/argoCD.git
````

ahora miramos desde la tty

![[Pasted image 20240608142910.png]]

Creamos un proyecto de pruebas en el que solo se puedan crear aplicaciones en el namespace "testing" y con determinado repositorio de código
````
argocd proj create testing -d https://kubernetes.default.svc,testing -s https://github.com/Jisuslz/argoCD.git
````
Si quisieramos crear un proyecto en el que esté permitido cualquier namespace y cualquier repositorio
````
argocd proj create system-admin -d https://kubernetes.default.svc,* -s '*'
````
Creamos el Namespace "testing" que sera el que usaremos para desplegar las aplicaciones
````
kubectl create ns testing
````
Ahora creamos nuestra primera aplicación de pruebas en el proyecto que hemos creado anteriormente
````
argocd app create guestbook \
  --repo https://github.com/Jisuslz/argocd.git \
  --revision main --path ./official/examples/guestbook \
  --dest-server https://kubernetes.default.svc \
  --dest-namespace testing \
  --project testing
````

si no da desde CLI
Sí, puedes realizar esta configuración desde la interfaz web de ArgoCD (UI). A continuación te explico cómo hacerlo paso a paso:

### Paso 1: Acceder a la Interfaz de ArgoCD

1. Abre tu navegador y accede a la UI de ArgoCD. Si has configurado un port-forwarding, la URL será:

    ```sh
    http://localhost:8080
    ```

2. Inicia sesión con tus credenciales de administrador.

### Paso 2: Crear un Nuevo Proyecto (si es necesario)

1. En la interfaz de ArgoCD, ve a la pestaña "Settings" y selecciona "Projects".
2. Haz clic en "NEW PROJECT" para crear un nuevo proyecto.
3. Rellena el formulario con los siguientes detalles:

    - **Project Name**: `testing`
    - **Description**: `Testing Project`
    - **Destinations**:
        - Server: `https://kubernetes.default.svc`
        - Namespace: `testing`
    - **Source Repositories**:
        - URL: `https://github.com/Jisuslz/argocd.git`

4. Haz clic en "Create" para crear el proyecto.

### Paso 3: Crear una Nueva Aplicación

1. En la interfaz de ArgoCD, ve a la pestaña "Applications".
2. Haz clic en "NEW APP" para crear una nueva aplicación.
3. Rellena el formulario con los siguientes detalles:

    - **Application Name**: `guestbook`
    - **Project**: `testing`
    - **Sync Policy**: Puedes dejarlo en blanco o seleccionar "Automatic" si deseas sincronización automática.
    - **Repository URL**: `https://github.com/Jisuslz/argocd.git`
    - **Revision**: `main`
    - **Path**: `official/examples/guestbook`
    - **Cluster URL**: `https://kubernetes.default.svc`
    - **Namespace**: `testing`

4. Haz clic en "Create" para crear la aplicación.

### Paso 4: Verificar y Sincronizar la Aplicación

1. Una vez creada la aplicación, deberías verla listada en la pestaña "Applications".
2. Haz clic en la aplicación `guestbook` para ver los detalles.
3. Si es necesario, haz clic en "Sync" para sincronizar la aplicación y desplegar los recursos en el clúster.

### Ejemplo Completo en la UI de ArgoCD

1. **Acceder a la Interfaz**: `http://localhost:8080` e iniciar sesión.
2. **Crear el Proyecto**:
    - Ir a "Settings" > "Projects" > "NEW PROJECT".
    - Rellenar el formulario:
        - **Project Name**: `testing`
        - **Description**: `Testing Project`
        - **Destinations**:
            - Server: `https://kubernetes.default.svc`
            - Namespace: `testing`
        - **Source Repositories**:
            - URL: `https://github.com/Jisuslz/argocd.git`
    - Hacer clic en "Create".
3. **Crear la Aplicación**:
    - Ir a "Applications" > "NEW APP".
    - Rellenar el formulario:
        - **Application Name**: `guestbook`
        - **Project**: `testing`
        - **Repository URL**: `https://github.com/Jisuslz/argocd.git`
        - **Revision**: `main`
        - **Path**: `official/examples/guestbook`
        - **Cluster URL**: `https://kubernetes.default.svc`
        - **Namespace**: `testing`
    - Hacer clic en "Create".
4. **Verificar y Sincronizar**:
    - Seleccionar la aplicación `guestbook` en la lista.
    - Hacer clic en "Sync" si es necesario.

Siguiendo estos pasos en la interfaz de ArgoCD, podrás configurar y desplegar la aplicación `guestbook` desde el repositorio `https://github.com/Jisuslz/argocd.git` en el namespace `testing`.




Ahora creamos otra app, pero esta vez con sincronización automática
````
argocd app create helm-guestbook \
  --repo https://github.com/Jisuslz/argocd.git \
  --revision main --path ./official/examples/helm-guestbook \
  --dest-server https://kubernetes.default.svc \
  --dest-namespace testing \
  --sync-policy automated \
  --project testing
````
Ahora podemos relanzar la primera App y sincronizar desde la CLI
````
argocd app sync guestbook
````
Si queremos saber el estatus de la App
````
argocd app get guestbook
````
Ahora para eliminar las Apps
````
argocd app delete guestbook
````
Podemos listar los Charts que tenemos instalados
````
helm list -n argocd
````
Desinstalamos todo!
````
helm uninstall argo-cd -n argocd
````
Ahora podemos eliminar los Namespaces que hemos creado
````
kubectl delete ns argocd testing
````
Ahora ya podemos detener nuestro Minikube
```
minikube stop
```



---
# Primeros pasos con ArgoCD en Kubernetes

Este video explica cómo utilizar ArgoCD para gestionar despliegues continuos en un clúster de Kubernetes usando GitOps. Se muestra el proceso de instalación y configuración de MiniKube y ArgoCD, la creación de proyectos y aplicaciones, y la automatización de despliegues desde un repositorio de Git.

---

## Conclusión

El video concluye con la instalación exitosa de ArgoCD en un clúster de Kubernetes, la creación de un proyecto y una aplicación, y la automatización del despliegue. Se muestran ejemplos prácticos y se ofrecen enlaces a recursos adicionales para seguir los pasos detalladamente. La interfaz de usuario de ArgoCD facilita la gestión de despliegues, aunque también se pueden realizar operaciones a través de la línea de comandos.

---

## Puntos clave

🛠️ **Herramienta**: ArgoCD es una herramienta gratuita para despliegues continuos en Kubernetes.

📦 **MiniKube**: Utiliza MiniKube para crear un clúster local de Kubernetes.

🔧 **Instalación**: Proceso de instalación detallado de MiniKube y ArgoCD.

💻 **CLI y UI**: ArgoCD se puede gestionar tanto desde la interfaz de usuario como desde la línea de comandos.

📂 **Proyectos**: Creación de proyectos en ArgoCD para organizar aplicaciones.

🚀 **Despliegues**: Automatización de despliegues desde un repositorio de Git.

🔒 **Seguridad**: Configuración de roles y permisos para proyectos y aplicaciones.

📝 **Configuración**: Uso de archivos de configuración y valores por defecto en ArgoCD.

🌐 **Sincronización**: Sincronización manual y automática de aplicaciones.

🔍 **Monitoreo**: Monitoreo de aplicaciones y eventos de despliegue.

---

## Resumen

1. **Introducción a ArgoCD**: Herramienta gratuita para despliegues continuos en Kubernetes mediante GitOps.
2. **Uso de MiniKube**: Configuración de un clúster local con MiniKube para pruebas y desarrollo.
3. **Instalación de MiniKube**: Guía paso a paso para instalar MiniKube en el sistema operativo local.
4. **Iniciación del clúster**: Inicio del clúster de Kubernetes con MiniKube y verificación de su estado.
5. **Instalación de ArgoCD**: Uso de Helm para instalar ArgoCD en el clúster de Kubernetes.
6. **Configuración de ArgoCD**: Configuración inicial de ArgoCD, incluyendo la creación de un namespace y credenciales.
7. **Uso de la CLI de ArgoCD**: Acciones básicas como iniciar sesión, cambiar contraseñas y sincronizar aplicaciones desde la línea de comandos.
8. **Creación de proyectos**: Creación de proyectos en ArgoCD para organizar y gestionar aplicaciones.
9. **Despliegue de aplicaciones**: Ejemplo práctico de despliegue de una aplicación utilizando ArgoCD.
10. **Automatización y monitoreo**: Configuración de la sincronización automática y monitoreo de aplicaciones desplegadas.

