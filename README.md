# Project_DevSecOps
- Ingeniería en Seguridad de la Información 
- © 2025
- 
# Microservicios y DevSecOps superando las limitaciones de las Arquitecturas Monolíticas 
---

# Diagrama 
![alt text](/robustness/RobustnessFull.png)


# Diagrama de red

<div align="center">
  <img src="https://github.com/user-attachments/assets/38e9968c-3869-438d-ba1f-2b37794e9919" alt="Diagrama de red">
</div>



Métodos para realizar modelamiento de amenazas durante todo el ciclo de vida del desarrollo de software (SDLC). Una excelente media de defensa contra las superficies de ataques, como lo son a nivel web como aplicativos mobiles etc.

#STRIDE

#PASTA

#Trike

#VAST

# GitOps/Deployment Pipeline

Este repositorio contiene la configuración y scripts necesarios para implementar un pipeline de CI/CD utilizando GitHub Actions, Huawei Cloud, Argo CD, y Terraform para la gestión de infraestructura como código (IaC).

## Descripción General

Este pipeline automatiza el proceso de construcción, pruebas, despliegue y monitoreo de una aplicación utilizando los principios de GitOps. A continuación se describe el flujo de trabajo en detalle.

### Flujo de Trabajo

1. **Commit del Código**:
   - El desarrollador realiza un commit en el repositorio de la aplicación.
   - Se ejecutan precommit checks para asegurar la calidad del código.

2. **Pipeline de CI/CD (GitHub Actions)**:
   - **Linting**: Análisis estático del código.
   - **Test**: Ejecución de pruebas unitarias e integrales.
   - **Build**: Construcción de la imagen del contenedor.
   - **Push Image**: Publicación de la imagen en el registro de contenedores de Huawei Cloud.

3. **Gestión de Configuración (Argo CD)**:
   - Un repositorio de configuración (`Config Repo`) almacena los manifiestos de Kubernetes.
   - Argo CD sincroniza los entornos (QA, Staging, Producción) con los cambios realizados en este repositorio.

4. **Infraestructura como Código (IaC)**:
   - Terraform gestiona la provisión de la infraestructura en Huawei Cloud.
   - La infraestructura y la configuración de la aplicación se gestionan mediante un enfoque GitOps.



<figcaption style="text-transform: uppercase; font-weight: bold;">
    REPOSITORIO: CODIGO FUENTE DEL PROYECTO
</figcaption>

[Github](https://github.com/Jisuslz/Project_DevSecOps)↗
```
[Github](https://github.com/Jisuslz/Project_DevSecOps)
```


**- Área problemática**

Los microservicios son la vanguardia en la arquitectura de software moderno. Orquestados a través de Kubernetes, con herramientas de análisis de código estático y dinámico, y buenas prácticas de seguridad, todo esto hace que dichos sistemas sean, por definición, más seguros y resilientes. La investigación demostrará que la integración adecuada de estas tecnologías un proceso de desarrollo lo hace óptimo y, por lo tanto, reduce los costos de manejar incidentes de seguridad. 

se puede enfocar en metodologías agiles como devops o devsecops y mejores prácticas para la prueba y validación de las medidas de seguridad mencionadas, de manera que se implementen de forma más segura. 

**- Antecedentes**
Google Cloud. (2016, 15 de julio). Bringing Pokemon Go to life on Google Cloud. Google Cloud. [](https://cloud.google.com/blog/products/containers-kubernetes/bringing-pokemon-go-to-life-on-google-cloud) 

[Enlace web](https://cloud.google.com/blog/products/containers-kubernetes/bringing-pokemon-go-to-life-on-google-cloud)↗



![[Pasted image 20240904194819.png]]
<figcaption style="text-transform: uppercase; font-weight: bold;">
    _Figura 1. Diagrama de red en alto nivel _
</figcaption>
A continuación, se desglosa el flujo adecuado que tiene el diagrama (_Figura 1_), y de esa manera entender mejor su composición.



**Desarrollador y Aplicación (Inicio del Flujo)**

- **Desarrollador realiza cambios**: El proceso comienza cuando el desarrollador trabaja en la aplicación y hace cambios en el código.

- **Commit de los cambios**: El desarrollador realiza un **commit** de esos cambios en el **repositorio de la aplicación** (Git).

- **Precommit checks**: Antes de que los cambios puedan ser aceptados, se ejecutan **precommit checks** (verificación automática del código) para asegurar que no haya errores evidentes y que el código cumpla con los estándares establecidos.



![[Pasted image 20241117164309.png]]
<figcaption style="text-transform: uppercase; font-weight: bold;">
    _Figura 2. Inicio del flujo _
</figcaption>

**3. Integración Continua (CI)**

- **Inicio de la Pipeline CI/CD**: Una vez que los precommit checks son exitosos, el código entra en el flujo de **Integración Continua (CI)**, que automatiza una serie de pasos:
    
    - **Build**: El código es compilado y la aplicación es **empaquetada en una imagen Docker**.
    
    - **Pruebas Unitarias**: Se ejecutan pruebas unitarias para verificar el correcto funcionamiento de las funcionalidades individuales de la aplicación.
    
    - **Pruebas de Integración**: Se verifican las interacciones entre diferentes módulos de la aplicación para asegurar que funcionan correctamente juntos.
    
    - **Publicación en un Registro de Imágenes**: La imagen Docker resultante se publica en un **registro de imágenes Docker** para que esté disponible para el despliegue.
    
    - **Pruebas Finales**: Se ejecutan pruebas finales antes del despliegue, que incluyen pruebas adicionales de funcionalidad, seguridad, etc.
    
    - **Análisis de Calidad de Código (SonarQube)**: La calidad del código es analizada utilizando SonarQube, lo que asegura que el código cumple con ciertos estándares de calidad y seguridad.

![[Pasted image 20241117164413.png]]
<figcaption style="text-transform: uppercase; font-weight: bold;">
    _Figura 3. CI/CD _
</figcaption>

**4. Repositorio de Configuración (GitOps)**

- **Repositorio de Configuración (Config Repo)**: Aquí se guarda la configuración de la infraestructura que define cómo y dónde se va a desplegar la aplicación en los diferentes entornos (testing, staging, producción).
    
- **Despliegue Automatizado**: El flujo está configurado para que **ARGO CD**, una herramienta de despliegue automatizado basada en GitOps, tome la configuración desde este repositorio y se asegure de que el estado de la infraestructura y la aplicación esté sincronizado con el código en el repositorio.
    

**5. Despliegue Continuo (CD) con ARGO CD**

- **Integración con ARGO CD**: Una vez que las pruebas de CI finalizan y se realiza la publicación de la imagen, ARGO CD entra en acción.
    
- **Despliegue a entornos**: ARGO CD utiliza la configuración en el **config repo** para realizar el despliegue en los diferentes entornos:
    
    - **Test/QA Env**: Se despliega primero en un entorno de prueba donde se ejecutan pruebas de calidad (QA).
        
    - **Staging Env**: Luego, se despliega en el entorno de staging, el último paso antes de producción.
        
    - **Producción**: Finalmente, después de las validaciones en los entornos anteriores, la aplicación se despliega en producción.

![[Pasted image 20241117164509.png]]
<figcaption style="text-transform: uppercase; font-weight: bold;">
    _Figura 4. Despliegue continuo _
</figcaption>

**6. Monitoreo y Validación**

- **Check de Sincronización**: ARGO CD verifica que la versión de la aplicación desplegada coincida con la configuración del repositorio. Si encuentra alguna diferencia, puede realizar un despliegue automático o solicitar que se realice manualmente.
    
- **Monitoreo y Métricas**: Herramientas como **Prometheus** y **Grafana** están conectadas para monitorear la salud y el rendimiento de la aplicación en los entornos de despliegue.
    

**7. Despliegue en Kubernetes**

- **Despliegue en Clúster Kubernetes**: ARGO CD gestiona el despliegue de los contenedores Docker dentro de un clúster Kubernetes. Los pods de la aplicación se despliegan en varios nodos para asegurar la **alta disponibilidad** y la **escalabilidad**.
    
- **Balanceo de Carga (Load Balancer)**: Un balanceador de carga distribuye el tráfico de los usuarios entre las diferentes versiones de la aplicación (por ejemplo, versión 1.0 y versión 1.1), lo que es ideal para estrategias como **blue/green deployments** (despliegue alternado de versiones) o **canary releases** (despliegue progresivo de una nueva versión).

![[Pasted image 20241117164545.png]]
<figcaption style="text-transform: uppercase; font-weight: bold;">
    _Figura 5. Monitoreo y validación _
</figcaption>

**8. Usuarios Acceden a la Aplicación**

- **Acceso del Usuario**: Los usuarios acceden a la aplicación en producción a través de un **balanceador de carga** en los puertos 8081 y 8082 del servidor, mientras que los contenedores Docker en Kubernetes escuchan en el puerto 80.
    
- **Versiones Controladas**: Dependiendo de la configuración del balanceador, los usuarios pueden ser dirigidos a diferentes versiones de la aplicación, permitiendo probar nuevas versiones con una porción del tráfico antes de hacer un despliegue completo.

![[Pasted image 20241117164624.png]]
<figcaption style="text-transform: uppercase; font-weight: bold;">
    _Figura 6. Flujo de acceso a la aplicación_
</figcaption>

**9. Cierre del Ciclo y Actualizaciones**

- **Actualización de la Aplicación**: Cuando el desarrollador realiza nuevos cambios, el ciclo vuelve a comenzar. Los cambios son comiteados, el proceso de CI/CD se ejecuta, y ARGO CD asegura que la nueva versión se despliegue en los entornos correspondientes.
    
- **Control de Versiones y GitOps**: Toda la configuración y los despliegues están versionados en el repositorio Git, permitiendo un control total sobre los cambios que se realizan en la infraestructura y la aplicación.


![[Poster.jpg]]
# Guía de implementación

## Install minikube en docker

```
curl -LO https://storage.googleapis.com/minikube/releases/latest/minikube_latest_amd64.deb
sudo dpkg -i minikube_latest_amd64.deb

```

```
minikube start --driver=docker
```

![[Pasted image 20250406205429.png]]
![[Pasted image 20250406205357.png]]


# Install ArgoCD

Creamos el namespace para el argo

```
# Creamos namespace donde instalaremos argocd  
kubectl create namespace argocd  
  
# Aplicamos el manifiesto  
kubectl apply -n argocd -f https://raw.githubusercontent.com/argoproj/argo-cd/stable/manifests/install.yaml
```

Por defecto, ArgoCD se instala con todos sus servicios como ClusterIP, lo que implica que no podremos tener acceso desde fuera del cluster. Para ello hemos optado por parchear el servicio que da acceso al ArgoCD vía web(Al usar minikube, también hemos tenido que abrir los puertos del servicio):

```
# Consultamos todos los servicios y comprobamos que todos los servicios son del tipo ClusterIP  
kubectl get svc -n argocd  
  
# Parcheamos el servicio  
kubectl patch svc argocd-server -n argocd -p '{"spec": {"type": "LoadBalancer"}}'  
  
# Consultamos todos los servicios y comprobamos que los cambios han tenido efecto  
kubectl get svc -n argocd  
  
# Abrimos el servicio en el minikube  
minikube service argocd-server --url -n argocd
```

![[Pasted image 20241001210434.png]]
## Obtención del password de admin de ArgoCD

Para obtener el password del usuario admin por defecto tenemos dos opciones:

```
reemplaza el id de pod 
kubectl get pods -n argocd


# Ejecutando un comando en el pod argocd-server-xxx  
kubectl exec -n argocd argocd-server-579f659dd5-s5cp6 -- argocd admin initial-password -n argocd  
  
# Leyendo el secreto de Kubernetes  
kubectl -n argocd get secret argocd-initial-admin-secret -o jsonpath="{.data.password}" | base64 -d; echo
```

Primera Opcion para saber la clave
![[Pasted image 20241001210911.png]]

Segunda opcion para saber la clave
![[Pasted image 20241001211032.png]]

Con este password ya podemos loguearnos:

---

## Interactuando con ArgoCD vía cliente CLI

Además de usando la web, ArgoCD nos ofrece dos opciones para interactuar con él(En realidad son tres si cuentas la API, que no vamos a ver en este vídeo). Una de ellas es usando la herramienta CLI que podemos descargar o ejecutar desde dentro del pod "argocd-server-xxxx"(Donde la tenemos disponible out-of-the-box):

```
# Descargar y dar permisos de ejecución al cliente  
wget "https://github.com/argoproj/argo-cd/releases/latest/download/argocd-linux-amd64" -O argocd && chmod +x argocd  
  
# O nos podemos conectar al Pod de "argocd-server-xxxx"  
kubectl exec -it -n argocd argocd-repo-server-75f6bdd495-jvbv5 -- bash  
  
# Hacer login en un servidor de ArgoCD con el cliente  
argocd login 127.0.0.1:8080 --username admin --password xxxxxx--grpc-web  
  
# Listar todas las aplicaciones de ArgoCD  
argocd app list

```

## Interactuar con ArgoCD usando objetos de Kubernetes

### RBAC
ArgoCD es una aplicación "Kubernetes native" o "Cloud native", que básicamente quiere decir, que guarda su estado(configuración) como objetos de Kubernetes. Esto quiere decir que podemos leer su configuración(Antes lo hemos hecho para leer el password de admin) o actualizarla. Vamos a ver unos ejemplos:

```
# Creación de usuarios  
apiVersion: v1  
data:  
  accounts.dev1: apiKey, login  
  accounts.dev1.enabled: "true"  
  accounts.dev2: apiKey, login  
  accounts.dev2.enabled: "true"  
  admin.enabled: "true"  
  policy.default: role:readonly  
kind: ConfigMap  
metadata:  
  name: argocd-cm  
  namespace: argocd  
---  
# Passwords de usuarios  
apiVersion: v1  
kind: Secret  
type: Opaque  
metadata:  
  name: argocd-secret  
  namespace: argocd  
immutable: false  
data:  
  accounts.dev1.password: base64***  
  accounts.dev1.passwordMtime: base64***  
  accounts.dev1.tokens: bnVsbA==  
  accounts.dev2.password: base64***  
  accounts.dev2.passwordMtime: base64***  
  accounts.dev2.tokens: bnVsbA==  
  admin.password: base64***  
  admin.passwordMtime: base64***  
---  
# Creación de proyectos  
apiVersion: argoproj.io/v1alpha1  
kind: AppProject  
metadata:  
  name: my-project  
  namespace: argocd  
spec:  
  description: My projects  
  clusterResourceWhitelist:  
  - group: '*'  
    kind: '*'  
  destinations:  
  - name: '*'  
    namespace: '*'  
    server: https://kubernetes.default.svc  
  sourceRepos:  
  - https://gitlab.mycompany.com/dev-environment-main.git  
  - https://gitlab.mycompany.com/stg-environment-main.git  
---  
# Configuración de permisos de usuarios  
apiVersion: v1  
kind: ConfigMap  
metadata:  
  name: argocd-rbac-cm  
  namespace: argocd  
data:  
  policy.csv: |  
    p, role:devrole1, applications, get, my-project/*, allow  
    p, role:devrole1, applications, sync, */*, allow  
    p, role:devrole1, projects, get, my-project, allow  
    p, role:devrole1, repositories, get, *, allow  
    g, dev1, role:devrole1  
    g, dev2, role:devrole1  
  
  policy.default: ""  
  scopes: '[groups]'  
---

```

---

## Aumentar recursus al nodo

```
minikube stop
minikube config set memory 8192
minikube config set disk-size 30000
minikube config set cpus 3
minikube start

minikube config view

```

---

![[Pasted image 20241002204411.png]]

![[Pasted image 20241002204418.png]]


![[Pasted image 20241002204425.png]]

---

Para analizar el código de un repositorio con SonarQube en tu pod de Minikube, necesitarás usar **SonarQube Scanner** (comúnmente llamado `sonar-scanner`). Aquí te explico cómo hacerlo:

### 1. **Configuración del SonarQube Scanner**

#### a. Instalar el SonarQube Scanner

El `sonar-scanner` es la herramienta que envía los resultados del análisis del código desde tu máquina o pipeline de CI/CD hacia tu servidor SonarQube (en tu caso, el pod en Minikube).

- Para instalarlo en tu máquina local, puedes seguir los pasos dependiendo de tu sistema operativo. Aquí te dejo los comandos más comunes:

##### Para Linux:

```bash
# Descargar el SonarQube Scanner
wget https://binaries.sonarsource.com/Distribution/sonar-scanner-cli/sonar-scanner-cli-4.8.0.2856-linux.zip

# Descomprimir
unzip sonar-scanner-cli-4.8.0.2856-linux.zip

# Mover a un directorio accesible globalmente (opcional)
mv sonar-scanner-4.8.0.2856-linux /opt/sonar-scanner

# Configurar el PATH
export PATH=$PATH:/opt/sonar-scanner/bin
```

##### Para Mac:

Si estás en MacOS y usas **Homebrew**, puedes instalarlo con el siguiente comando:

```bash
brew install sonar-scanner
```

#### b. Configurar el archivo `sonar-project.properties`

Este archivo define los parámetros del proyecto que se va a analizar. Debes crear este archivo en el directorio raíz de tu repositorio. Aquí te dejo un ejemplo básico de configuración:

```properties
# sonar-project.properties
sonar.projectKey=nombre-del-proyecto
sonar.projectName=Nombre de tu aplicación
sonar.projectVersion=1.0
sonar.sources=./src
sonar.host.url=http://<minikube_ip>:<puerto>/sonarqube
sonar.login=sqa_67f0e1ca526c4f6e820b274c113aae1a5ffcb043
```

- **sonar.projectKey**: Un identificador único para tu proyecto.
- **sonar.projectName**: El nombre visible del proyecto en la interfaz de SonarQube.
- **sonar.projectVersion**: La versión de tu aplicación.
- **sonar.sources**: El directorio de tu código fuente.
- **sonar.host.url**: La URL de tu servidor SonarQube. Si estás en Minikube, utiliza el IP del cluster de Minikube.
- **sonar.login**: Un token de autenticación generado en la interfaz de SonarQube.

#### c. Obtener la IP del pod de SonarQube en Minikube

Si tu SonarQube está en Minikube, necesitarás obtener la IP y el puerto expuesto para que el `sonar-scanner` pueda enviar los datos.

- Verifica los servicios en Minikube con:
    
    ```bash
    minikube service list
    ```
    
- Obtén la IP con:
    
    ```bash
    minikube ip
    ```
    
- Usa la IP y el puerto expuesto para acceder a SonarQube desde el archivo `sonar-project.properties`.
    

### 2. **Ejecutar el SonarQube Scanner**

Una vez que tengas el `sonar-scanner` instalado y configurado, ejecuta el análisis en tu código con el siguiente comando dentro del directorio del proyecto:

```bash
sonar-scanner
```

Esto ejecutará el análisis de tu código y enviará los resultados a tu instancia de SonarQube. Podrás visualizar los resultados en el panel web de SonarQube.

### 3. **Integración con GitHub**

Si tu código está en un repositorio de GitHub, puedes integrar la decoración de Pull Requests o análisis automáticos al realizar `push` o `merge` en ramas específicas, usando un pipeline CI/CD (como Jenkins o GitHub Actions). Deberás asegurarte de que el `sonar-scanner` esté configurado correctamente en tus pipelines.

### 4. **Ver los resultados en SonarQube**

Una vez que el análisis se complete, podrás ver los resultados del escaneo en la interfaz de SonarQube:

- Defectos de código.
- Métricas de calidad.
- Problemas de seguridad.
- Código duplicado.

# **screenshot**

![[Pasted image 20241117151712.png]]

![[Pasted image 20241117151937.png]]

![[Pasted image 20241117152202.png]]
![[Pasted image 20241117153327.png]]
![[Pasted image 20241117152625.png]]

![[Pasted image 20241117153133.png]]
![[Pasted image 20241117153432.png]]

![[Pasted image 20241117154158.png]]

![[Pasted image 20241117154213.png]]

![[Pasted image 20241117154231.png]]

El **análisis estático** y el **análisis dinámico** son dos enfoques complementarios para evaluar la calidad y seguridad del código de una aplicación.

### 1. **Análisis Estático**
Consiste en analizar el código fuente sin ejecutarlo. Se busca identificar posibles problemas, como errores de sintaxis, vulnerabilidades de seguridad o violaciones de las mejores prácticas.

#### Con SonarQube:
- **Automatizado:**  
  - **Funcionalidad:** SonarQube examina el código fuente estático y proporciona un informe detallado de errores, deuda técnica y vulnerabilidades.
  - **Ventajas:**  
    - Rápido, ya que no requiere ejecución.
    - Detecta problemas temprano en el ciclo de desarrollo.
    - Verifica el cumplimiento de estándares de calidad.
  - **Ejemplos de detección:**  
    - Variables no utilizadas.
    - Complejidad ciclomática alta.
    - Código duplicado.
    - Vulnerabilidades de inyección.

#### Manual:
- **Revisión de código manual:** Un desarrollador o analista revisa el código línea por línea.
  - **Ventajas:** Puede captar errores lógicos o de diseño que las herramientas automáticas no detectan.
  - **Desventajas:** Requiere más tiempo y es propenso a omisiones humanas.

---

### 2. **Análisis Dinámico**
Se realiza mientras la aplicación está en ejecución. Evalúa cómo se comporta el sistema bajo diferentes condiciones, incluyendo pruebas de rendimiento, seguridad y comportamiento.

#### Con SonarQube:
SonarQube, por sí solo, no realiza análisis dinámico directamente, pero puede integrarse con otras herramientas que complementen este análisis. Sin embargo, analiza las pruebas unitarias y de integración si se configuran correctamente.

#### Manual:
- **Pruebas manuales en un entorno controlado:**  
  - **Qué se evalúa:** 
    - Comportamiento bajo carga.
    - Manejo de errores.
    - Vulnerabilidades runtime (e.g., inyecciones que solo se manifiestan en ejecución).
  - **Ejemplo:**  
    Un analista podría probar manualmente una API para ver cómo responde a entradas maliciosas en tiempo real.

---

### Diferencias clave:

| Aspecto               | Análisis Estático                         | Análisis Dinámico                       |
|-----------------------|-------------------------------------------|-----------------------------------------|
| **Ejecución**          | No requiere ejecutar el código.           | Requiere que la aplicación esté en funcionamiento. |
| **Objetivo**           | Detectar problemas en el código fuente.   | Evaluar el comportamiento de la aplicación en tiempo de ejecución. |
| **Velocidad**          | Más rápido, se ejecuta en cualquier momento. | Más lento, ya que depende de la ejecución. |
| **Ejemplos de errores**| Errores de sintaxis, deuda técnica, vulnerabilidades estáticas. | Problemas de rendimiento, seguridad runtime, manejo de errores. |

# Analisis Manual

## Proyecto final implementado tecnicas defensivas a nivel de codigo

## Descripción del proyecto

### Vectores de ataque potenciales para la generación de código arbitrario

[](https://github.com/Jisuslz/Laboratorios#vectores-de-ataque-potenciales-para-la-generaci%C3%B3n-de-c%C3%B3digo-arbitrario)

1. **Falta de validación de complejidad de contraseñas:** El sistema carece de mecanismos para evaluar y asegurar la complejidad de las contraseñas utilizadas, lo que puede facilitar ataques de fuerza bruta o de diccionario.
    
2. **Transmisión no cifrada de contraseñas a la base de datos:** Las contraseñas no se están transmitiendo de forma segura a la base de datos, lo que las expone a posibles interceptaciones maliciosas durante su tránsito.
    
3. **Carencia de validaciones y uso de sentencias preparadas en inputs:** Los datos ingresados por los usuarios no están siendo adecuadamente validados ni procesados mediante sentencias preparadas, lo que deja al sistema vulnerable a ataques de inyección de código.
    
4. **Hardcodeo de credenciales y datos sensibles en el código:** La inclusión directa de credenciales y datos sensibles en el código fuente expone dicha información a posibles compromisos de seguridad, ya que puede ser fácilmente accesible para actores malintencionados.
    
5. **No eliminación de variables en memoria:** La falta de eliminación de variables en memoria puede dar lugar a fugas de información sensible, lo que aumenta el riesgo de exposición de datos confidenciales.
    
6. **Falta de verificación de autenticación en el inicio de sesión:** La ausencia de comprobación de autenticación en la sesión inicial deja al sistema expuesto a ataques de fuzzing y otros intentos de acceso no autorizado.
    
7. **No verificación en la base de datos del estado del usuario y gestión de intentos de sesión:** El sistema no verifica en la base de datos si un usuario está bloqueado por exceder el límite de intentos de sesión, ni realiza el adecuado seguimiento y restablecimiento de dichos intentos.
    
8. **Consultas vulnerables a inyección de SQL:** La concatenación directa de variables en las consultas a la base de datos abre la puerta a ataques de inyección de SQL, permitiendo a un atacante manipular las consultas para obtener información no autorizada o realizar acciones maliciosas.
    
9. **Sesiones sin expiración:** Las sesiones no tienen un tiempo de expiración definido, lo que aumenta el riesgo de acceso no autorizado a la cuenta del usuario.
    
10. **Transmisión no cifrada de datos con HTTP en lugar de HTTPS:** La falta de cifrado en la transmisión de datos expone la información a posibles interceptaciones y manipulaciones por parte de terceros malintencionados.
    
11. **Revelación de información crítica del servidor:** El sistema muestra información crítica del servidor directamente al usuario, lo que podría ser utilizado por un atacante para identificar y explotar vulnerabilidades.
    
12. **Uso de usuarios predefinidos para conexiones a la base de datos:** El uso de usuarios predefinidos para conexiones a la base de datos aumenta el riesgo de compromiso de la integridad y confidencialidad de los datos almacenados.
    
13. **Falta de cierre seguro de conexiones a la base de datos:** La falta de cierre adecuado de las conexiones a la base de datos puede dejar al sistema vulnerable a ataques de denegación de servicio y otros vectores de ataque.
    
14. **Falta de sanitización de datos recibidos de formularios:** La omisión de la sanitización de los datos recibidos de los formularios expone al sistema a posibles ataques de inyección de código y otros exploits.
    
15. **No validación de contraseñas y uso de salting:** La falta de validación de contraseñas y el uso de salting aumenta el riesgo de ataques de fuerza bruta y de diccionario, así como de compromisos de seguridad de las contraseñas almacenadas.
    
16. **Falta de uso de algoritmos seguros de cifrado, como SHA-2:** La ausencia de algoritmos de cifrado seguros expone las contraseñas y otros datos sensibles a posibles compromisos de seguridad y violaciones de la privacidad.
    
17. **Falta de manejo seguro de errores:** La carencia de un manejo adecuado de errores puede exponer información sensible y facilitar la identificación de posibles vulnerabilidades en el sistema.
    
18. **Validaciones de JavaScript inseguras con innerHTML:** Las validaciones inseguras de JavaScript utilizando innerHTML pueden dejar al sistema vulnerable a ataques de scripting entre sitios (XSS) y otros exploits.
    
19. **Cookies de sesión inseguras:** La falta de seguridad en las cookies de sesión puede exponer al sistema a ataques de secuestro de sesión y otros vectores de ataque relacionados con la gestión de sesiones.
    
20. Filtrando listas blancas en lo inputs
    
21. Recolectando metricas y metadatos de los usuarios que se estan conectando
    
22. imprimiendo ip de conexion y ultimo ingreso al sistema web
    
23. prevenir ataques de fuerza bruta basados en el agente de usuario
    

# Clasificacion de lo vectores encontrados con el OWASP TOP 10

[](https://github.com/Jisuslz/Laboratorios#clasificacion-de-lo-vectores-encontrados-con-el-owasp-top-10)

### Vectores de ataque potenciales para generar código arbitrario

[](https://github.com/Jisuslz/Laboratorios#vectores-de-ataque-potenciales-para-generar-c%C3%B3digo-arbitrario)

1. **Falta de validación de complejidad de contraseñas**
2. **Transmisión de contraseñas en texto plano sin cifrar** (OWASP Top 10: A2 - Riesgo de Autenticación Insuficiente)
3. **Falta de validación y uso de sentencias preparadas en inputs** (OWASP Top 10: A1 - Inyección de SQL)
4. **Hardcodeo de credenciales y datos sensibles en el código** (OWASP Top 10: A3 - Exposición de Datos Sensibles)
5. **Falta de eliminación de variables en memoria** (OWASP Top 10: A8 - Exposición de Recursos Críticos)
6. **Falta de autenticación en el index de sesión, susceptible a ataques de fuzzing** (OWASP Top 10: A2 - Riesgo de Autenticación Insuficiente)
7. **No verifica si el usuario está bloqueado por intentos de sesión en la base de datos** (OWASP Top 10: A2 - Riesgo de Autenticación Insuficiente)
8. **Consultas de base de datos vulnerables a SQL Injection** (OWASP Top 10: A1 - Inyección de SQL)
9. **Sesiones sin expiración** (OWASP Top 10: A3 - Exposición de Datos Sensibles)
10. **Transmisión de datos sin cifrar con HTTP en lugar de HTTPS** (OWASP Top 10: A6 - Falta de Protección de Datos Sensibles)
11. **Revelación de información crítica del servidor** (OWASP Top 10: A6 - Falta de Protección de Datos Sensibles)
12. **Uso de usuarios predeterminados para conexiones a la base de datos** (OWASP Top 10: A5 - Utilización de Componentes con Vulnerabilidades Conocidas)
13. **Falta de cierre seguro de conexiones a la base de datos** (OWASP Top 10: A1 - Inyección de SQL)
14. **Falta de sanitización de datos recibidos de formularios** (OWASP Top 10: A1 - Inyección de SQL)
15. **Falta de validación de contraseñas y uso de salting** (OWASP Top 10: A2 - Riesgo de Autenticación Insuficiente)
16. **Falta de uso de algoritmos seguros de cifrado (por ejemplo, SHA-2)** (OWASP Top 10: A6 - Falta de Protección de Datos Sensibles)
17. **Falta de manejo seguro de errores** (OWASP Top 10: A5 - Utilización de Componentes con Vulnerabilidades Conocidas)
18. **Uso inseguro de innerHTML en validaciones de JavaScript** (OWASP Top 10: A7 - Exposición de Funcionalidades Peligrosas)
19. **Cookies de sesión inseguras** (OWASP Top 10: A2 - Riesgo de Autenticación Insuficiente)

# versus codigo seguro & codigo inseguro

[](https://github.com/Jisuslz/Laboratorios#versus-codigo-seguro--codigo-inseguro)

1. Falta de validación de complejidad de contraseñas. [![alt text](https://github.com/Jisuslz/Laboratorios/raw/master/LaboratorioFinalVuln/Anexos/1.png)](https://github.com/Jisuslz/Laboratorios/blob/master/LaboratorioFinalVuln/Anexos/1.png)
    
2. Transmisión no cifrada de contraseñas a la base de datos. [![alt text](https://github.com/Jisuslz/Laboratorios/raw/master/LaboratorioFinalVuln/Anexos/2.png)](https://github.com/Jisuslz/Laboratorios/blob/master/LaboratorioFinalVuln/Anexos/2.png)
    
3. Carencia de validaciones y uso de sentencias preparadas en inputs. [![alt text](https://github.com/Jisuslz/Laboratorios/raw/master/LaboratorioFinalVuln/Anexos/3.png)](https://github.com/Jisuslz/Laboratorios/blob/master/LaboratorioFinalVuln/Anexos/3.png)
    
4. Hardcodeo de credenciales y datos sensibles en el código. [![alt text](https://github.com/Jisuslz/Laboratorios/raw/master/LaboratorioFinalVuln/Anexos/4.png)](https://github.com/Jisuslz/Laboratorios/blob/master/LaboratorioFinalVuln/Anexos/4.png)
    
5. No eliminación de variables en memoria. [![alt text](https://github.com/Jisuslz/Laboratorios/raw/master/LaboratorioFinalVuln/Anexos/5.png)](https://github.com/Jisuslz/Laboratorios/blob/master/LaboratorioFinalVuln/Anexos/5.png)
    
6. Falta de verificación de autenticación en el inicio de sesión. [![alt text](https://github.com/Jisuslz/Laboratorios/raw/master/LaboratorioFinalVuln/Anexos/6.png)](https://github.com/Jisuslz/Laboratorios/blob/master/LaboratorioFinalVuln/Anexos/6.png)
    
7. No verificación en la base de datos del estado del usuario y gestión de intentos de sesión. [![alt text](https://github.com/Jisuslz/Laboratorios/raw/master/LaboratorioFinalVuln/Anexos/7.png)](https://github.com/Jisuslz/Laboratorios/blob/master/LaboratorioFinalVuln/Anexos/7.png)
    
8. Consultas vulnerables a inyección de SQL concatenando la variable directamente. [![alt text](https://github.com/Jisuslz/Laboratorios/raw/master/LaboratorioFinalVuln/Anexos/8.png)](https://github.com/Jisuslz/Laboratorios/blob/master/LaboratorioFinalVuln/Anexos/8.png)
    

```
1Q2w3e4r5t'; DROP TABLE usuario;-- //Ejemplo en input de password podemos colocar esto para probar

```

![[Pasted image 20250507222440.png]]

```
En este ajuste, he cambiado los marcadores de posición de la consulta preparada de ? a :nombre, :documento, :usuario, :contraseñaCifrada, y :salt. Luego, he utilizado el método bindParam para vincular las variables correspondientes a estos marcadores de posición. Esto hace que el código sea más seguro y menos susceptible a ataques de inyección SQL.


```

9. Sesiones sin expiración toker de session cookies. [![alt text](https://github.com/Jisuslz/Laboratorios/raw/master/LaboratorioFinalVuln/Anexos/9.png)](https://github.com/Jisuslz/Laboratorios/blob/master/LaboratorioFinalVuln/Anexos/9.png)
    
10. Transmisión no cifrada de datos con HTTP en lugar de HTTPS. **Certificado autofirmado HTTPS** [![alt text](https://github.com/Jisuslz/Laboratorios/raw/master/LaboratorioFinalVuln/Anexos/10.png)](https://github.com/Jisuslz/Laboratorios/blob/master/LaboratorioFinalVuln/Anexos/10.png) [![alt text](https://github.com/Jisuslz/Laboratorios/raw/master/LaboratorioFinalVuln/Anexos/18.png)](https://github.com/Jisuslz/Laboratorios/blob/master/LaboratorioFinalVuln/Anexos/18.png)
    
11. Revelación de información crítica del servidor. [![alt text](https://github.com/Jisuslz/Laboratorios/raw/master/LaboratorioFinalVuln/Anexos/11.png)](https://github.com/Jisuslz/Laboratorios/blob/master/LaboratorioFinalVuln/Anexos/11.png)
    
12. Uso de usuarios predefinidos para conexiones a la base de datos. [![alt text](https://github.com/Jisuslz/Laboratorios/raw/master/LaboratorioFinalVuln/Anexos/12.png)](https://github.com/Jisuslz/Laboratorios/blob/master/LaboratorioFinalVuln/Anexos/12.png)
    
13. Falta de cierre seguro de conexiones a la base de datos. [![alt text](https://github.com/Jisuslz/Laboratorios/raw/master/LaboratorioFinalVuln/Anexos/13.png)](https://github.com/Jisuslz/Laboratorios/blob/master/LaboratorioFinalVuln/Anexos/13.png)
    

```
 la opción más segura y recomendada es `$conn = null;`. Aquí te explico por qué:

1. `$conn = null;`: Esta opción asigna `null` a la variable `$conn`, lo que significa que la conexión se cierra y se elimina de la memoria. Es una práctica común y segura para cerrar las conexiones a la base de datos en PHP.

2. `mysqli_close($conn);`: Esta función también cierra la conexión a la base de datos, pero requiere pasar la variable de conexión como argumento. Es una forma más explícita de cerrar la conexión, pero no necesariamente más segura que la asignación de `null`.

La diferencia principal entre las dos opciones radica en el nivel de control y claridad en el código. Usar `$conn = null;` es más claro y directo, mientras que `mysqli_close($conn);` requiere llamar a una función adicional. Además, `$conn = null;` es compatible con otros tipos de conexiones a la base de datos, no solo con MySQLi, lo que lo hace más versátil.


```

14. Falta de sanitización de datos recibidos de formularios. Validaciones de JavaScript inseguras con innerHTML.

```

1. **Validación del lado del cliente solamente**: Un atacante puede fácilmente evitar las validaciones del lado del cliente manipulando el código fuente en el navegador o utilizando herramientas como el Inspector de elementos para modificar los valores de los campos del formulario. Por ejemplo, un atacante podría enviar datos maliciosos o vacíos directamente al servidor sin ser validados por el cliente.

2. **Falta de validación del lado del servidor**: Si el servidor no valida adecuadamente los datos recibidos del formulario, un atacante podría explotar esto enviando datos maliciosos diseñados para explotar vulnerabilidades en la lógica de la aplicación o en la base de datos. Por ejemplo, un atacante podría enviar scripts maliciosos o consultas SQL diseñadas para comprometer la seguridad de la aplicación.

3. **Manejo de errores insuficiente**: Si el código no maneja adecuadamente los errores de red o del servidor, un atacante podría aprovechar esto para realizar ataques de denegación de servicio (DoS) o para recopilar información sobre la infraestructura del servidor. Por ejemplo, un atacante podría realizar múltiples solicitudes simultáneas para sobrecargar el servidor o para obtener información sensible sobre las respuestas de error.

4. **Exposición de mensajes de alerta**: Los mensajes de alerta utilizados en el código pueden revelar información sensible sobre la estructura o el funcionamiento interno de la aplicación. Un atacante podría aprovechar esto para obtener información sobre posibles vulnerabilidades o puntos de entrada en la aplicación. Por ejemplo, un mensaje de alerta que indica que un campo específico es obligatorio podría revelar a un atacante información sobre cómo manipular el formulario para evadir las validaciones del lado del cliente.

5. **Posible inseguridad en la transmisión de datos**: Si los datos del formulario se envían al servidor sin cifrar ni proteger adecuadamente la transmisión de datos, un atacante podría interceptar y leer los datos enviados utilizando técnicas de ataque de intermediarios, como el secuestro de sesiones o el análisis de tráfico de red. Esto podría permitir al atacante robar información confidencial, como contraseñas o datos de tarjetas de crédito, transmitidos entre el cliente y el servidor.


```

```
<!-- Campo de nombre -->
<script>
    document.getElementById('nombre').value = ''; // Campo vacío
</script>

<!-- Campo de email -->
<script>
    document.getElementById('email').value = 'correo_malicioso@atacante.com'; // Email malicioso
</script>

<!-- Campo de fecha de nacimiento -->
<script>
    document.getElementById('fechaNacimiento').value = '01/01/1970'; // Fecha de nacimiento maliciosa
</script>

<!-- Campo de género -->
<script>
    document.getElementById('genero').checked = false; // Género no seleccionado
</script>

<!-- Campo de carrera -->
<script>
    document.getElementById('carrera').value = ''; // Carrera no seleccionada
</script>

<!-- Campo de semestre -->
<script>
    document.getElementById('semestre').value = '0'; // Semestre malicioso
</script>

<!-- Campo de contraseña -->
<script>
    document.getElementById('password').value = 'mypassword\'; DROP TABLE usuario;--'; // Contraseña maliciosa
</script>

<!-- Campo de confirmación de contraseña -->
<script>
    document.getElementById('passwordConfirmation').value = 'mypassword\'; DROP TABLE usuario;--'; // Confirmación de contraseña maliciosa
</script>

<!-- Campo de aceptación de términos y condiciones -->
<script>
    document.getElementById('aceptoTerminosYCondiciones').checked = false; // Términos y condiciones no aceptados
</script>

```

Para mejorar la seguridad del código, se recomienda implementar las siguientes prácticas:

- Validar y sanitizar todos los datos del formulario en el lado del servidor antes de procesarlos.
    
- Implementar medidas de protección contra XSS, como la codificación de salida de datos y el uso de encabezados de seguridad HTTP como Content Security Policy (CSP).
    
- Utilizar tokens CSRF para protegerse contra ataques de CSRF.
    
- Encriptar la comunicación entre el cliente y el servidor utilizando HTTPS.
    
- Implementar un manejo adecuado de errores y mensajes de usuario para proporcionar retroalimentación clara y útil al usuario.
    

Cambios realizados pra mejorar la seguirdad del codigo Cambios realizados:

- Se agregaron etiquetas asociadas a los campos del formulario para mejorar la accesibilidad.
- Se implementó la validación de campos tanto en el lado del cliente como en el lado del servidor para mayor seguridad.
- Se utilizó una expresión regular para validar el formato del correo electrónico.
- Se agregaron mensajes de error dinámicos para cada campo del formulario.
- Se estableció el tipo de contenido de la solicitud XMLHttpRequest como application/x-www-form-urlencoded.
- Se agregó una función para limpiar el formulario después de un registro exitoso.
- Se realizaron ajustes en la lógica para asegurar que los datos se envíen correctamente al servidor y se procesen de manera segura

[![alt text](https://github.com/Jisuslz/Laboratorios/raw/master/LaboratorioFinalVuln/Anexos/14.png)](https://github.com/Jisuslz/Laboratorios/blob/master/LaboratorioFinalVuln/Anexos/14.png)

[![alt text](https://github.com/Jisuslz/Laboratorios/raw/master/LaboratorioFinalVuln/Anexos/14.1.png)](https://github.com/Jisuslz/Laboratorios/blob/master/LaboratorioFinalVuln/Anexos/14.1.png)

15. No validación de contraseñas y uso de salting. [![alt text](https://github.com/Jisuslz/Laboratorios/raw/master/LaboratorioFinalVuln/Anexos/7.png)](https://github.com/Jisuslz/Laboratorios/blob/master/LaboratorioFinalVuln/Anexos/7.png)
    
16. Falta de uso de algoritmos seguros de cifrado, como SHA-2. [![alt text](https://github.com/Jisuslz/Laboratorios/raw/master/LaboratorioFinalVuln/Anexos/16.png)](https://github.com/Jisuslz/Laboratorios/blob/master/LaboratorioFinalVuln/Anexos/16.png)
    
17. Falta de manejo seguro de errores. [![alt text](https://github.com/Jisuslz/Laboratorios/raw/master/LaboratorioFinalVuln/Anexos/17.png)](https://github.com/Jisuslz/Laboratorios/blob/master/LaboratorioFinalVuln/Anexos/17.png)
    
18. Cookies de sesión inseguras. **Time token sessión** [![alt text](https://github.com/Jisuslz/Laboratorios/raw/master/LaboratorioFinalVuln/Anexos/18.png)](https://github.com/Jisuslz/Laboratorios/blob/master/LaboratorioFinalVuln/Anexos/18.png) [![alt text](https://github.com/Jisuslz/Laboratorios/raw/master/LaboratorioFinalVuln/Anexos/18.1.png)](https://github.com/Jisuslz/Laboratorios/blob/master/LaboratorioFinalVuln/Anexos/18.1.png)
    
19. Filtrando listas blancas en lo inputs [![alt text](https://github.com/Jisuslz/Laboratorios/raw/master/LaboratorioFinalVuln/Anexos/19.png)](https://github.com/Jisuslz/Laboratorios/blob/master/LaboratorioFinalVuln/Anexos/19.png) [![alt text](https://github.com/Jisuslz/Laboratorios/raw/master/LaboratorioFinalVuln/Anexos/19.1.png)](https://github.com/Jisuslz/Laboratorios/blob/master/LaboratorioFinalVuln/Anexos/19.1.png)
    
20. Recolectando metricas y metadatos de los usuarios que se estan conectando [![alt text](https://github.com/Jisuslz/Laboratorios/raw/master/LaboratorioFinalVuln/Anexos/20.png)](https://github.com/Jisuslz/Laboratorios/blob/master/LaboratorioFinalVuln/Anexos/20.png)
    
21. imprimiendo ip de conexion y ultimo ingreso al sistema web [![alt text](https://github.com/Jisuslz/Laboratorios/raw/master/LaboratorioFinalVuln/Anexos/21.png)](https://github.com/Jisuslz/Laboratorios/blob/master/LaboratorioFinalVuln/Anexos/21.png)
    
22. prevenir ataques de fuerza bruta basados en el agente de usuario
    

```
// Verificar si hay múltiples solicitudes con el mismo agente de usuario pero desde diferentes direcciones IP
function detectarFuerzaBruta($user_agent, $ip_usuario) {
    // Consultar la base de datos u otro sistema de registro para buscar patrones sospechosos
    // Aquí solo se muestra un ejemplo simple
    $num_solicitudes = 5; // Número máximo de solicitudes permitidas con el mismo agente de usuario
    $intervalo_tiempo = 60; // Intervalo de tiempo en segundos para considerar las solicitudes como sospechosas
    
    // Consultar la base de datos para contar las solicitudes recientes con el mismo agente de usuario
    $num_solicitudes_recientes = 0; // Aquí asumimos que no hay ninguna solicitud reciente con el mismo agente de usuario
    
    // Si se detectan más solicitudes de las permitidas en el intervalo de tiempo especificado
    if ($num_solicitudes_recientes > $num_solicitudes) {
        // Puedes registrar esta actividad en un archivo de registro o en la base de datos para futuras investigaciones
        // Puedes tomar medidas adicionales, como bloquear la dirección IP del usuario en tu firewall
        // Por ahora, simplemente retornamos true para indicar que se detectó un posible ataque de fuerza bruta
        return true;
    }
    
    // Si no se detectan patrones sospechosos, retornar false
    return false;
}

// Verificar si hay actividad reciente del usuario
if (isset($_SESSION['ultima_actividad']) && (time() - $_SESSION['ultima_actividad'] > 900)) { // 900 segundos = 15 minutos
    logout();
}

// Actualizar la última actividad del usuario
$_SESSION['ultima_actividad'] = time();

// Obtener el agente de usuario del cliente y la dirección IP del usuario
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$ip_usuario = $_SERVER['REMOTE_ADDR'];

// Verificar si se está produciendo un ataque de fuerza bruta
if (detectarFuerzaBruta($user_agent, $ip_usuario)) {
    // Si se detecta un ataque de fuerza bruta, mostrar una notificación al usuario y bloquear las solicitudes adicionales
    echo "¡Atención! Detectamos un posible ataque de fuerza bruta. Por razones de seguridad, tu acceso ha sido bloqueado temporalmente.";
    exit;
}

// ...
```

## Sniffing de traza de protocolos de comunicación de datos en transito

[](https://github.com/Jisuslz/Laboratorios#sniffing-de-traza-de-protocolos-de-comunicaci%C3%B3n-de-datos-en-transito)

24. Protocolo HTTPs con certificados autofirmados con openSSl

**Datos en transito cifrado**

[![alt text](https://github.com/Jisuslz/Laboratorios/raw/master/LaboratorioFinalVuln/Anexos/24.png)](https://github.com/Jisuslz/Laboratorios/blob/master/LaboratorioFinalVuln/Anexos/24.png)

Protocolo HTTP

25. **Datos en transito en texto plano** [![alt text](https://github.com/Jisuslz/Laboratorios/raw/master/LaboratorioFinalVuln/Anexos/25.png)](https://github.com/Jisuslz/Laboratorios/blob/master/LaboratorioFinalVuln/Anexos/25.png)


---

# TRIVY

**Trivy** es una herramienta de código abierto para realizar análisis de vulnerabilidades en imágenes de contenedores, archivos y repositorios. A continuación, te explico cómo usar Trivy en Linux para analizar imágenes de Docker.

### 1. **Instalación de Trivy en Linux**
Puedes instalar Trivy siguiendo estos pasos:

#### a) Usando un script de instalación
```bash
curl -sfL https://raw.githubusercontent.com/aquasecurity/trivy/main/contrib/install.sh | sudo sh -s -- -b /usr/local/bin
```

#### b) Usando un paquete deb/rpm (opcional)
- **Para sistemas basados en Debian/Ubuntu:**
  ```bash
  sudo apt install wget -y
  wget https://github.com/aquasecurity/trivy/releases/latest/download/trivy_0.46.0_Linux-64bit.deb
  sudo dpkg -i trivy_0.46.0_Linux-64bit.deb
  ```

- **Para sistemas basados en RHEL/Fedora:**
  ```bash
  sudo yum install wget -y
  wget https://github.com/aquasecurity/trivy/releases/latest/download/trivy_0.46.0_Linux-64bit.rpm
  sudo rpm -ivh trivy_0.46.0_Linux-64bit.rpm
  ```

### 2. **Verificar la instalación**
Para asegurarte de que Trivy se instaló correctamente, ejecuta:
```bash
trivy --version
```

### 3. **Analizar una imagen de Docker**
Trivy permite escanear imágenes de Docker de manera sencilla. Asegúrate de que Docker esté instalado y configurado en tu sistema.

#### a) Escaneo básico
Ejecuta el siguiente comando para analizar una imagen de Docker:
```bash
trivy image <nombre_imagen>:<tag>
```
Ejemplo:
```bash
trivy image ubuntu:latest
```

#### b) Escaneo detallado
Si quieres un informe más detallado, incluye las vulnerabilidades que no tengan solución o solo de alto impacto:
```bash
trivy image --severity HIGH,CRITICAL <nombre_imagen>:<tag>
```

#### c) Escaneo de imágenes locales
Si tienes imágenes locales, primero enuméralas:
```bash
docker images
```
Luego, escanea una imagen local:
```bash
trivy image <id_imagen>
```

### 4. **Otros modos de análisis**
- **Escaneo de archivos de configuración (Infrastructure as Code):**
  ```bash
  trivy config <ruta_del_directorio>
  ```
- **Escaneo de archivos o directorios específicos:**
  ```bash
  trivy fs <ruta_del_directorio>
  ```

### 5. **Actualizar la base de datos de vulnerabilidades**
Trivy utiliza una base de datos actualizada para identificar vulnerabilidades. Para actualizarla manualmente:
```bash
trivy --refresh
```

### 6. **Exportar resultados**
Puedes exportar el informe a un archivo JSON para revisarlo más tarde:
```bash
trivy image -f json -o reporte.json <nombre_imagen>:<tag>
```

### 7. **Integración con CI/CD**
Trivy puede integrarse en pipelines de CI/CD para realizar análisis automáticos de vulnerabilidades en imágenes de Docker antes del despliegue.


![[Pasted image 20241117160611.png]]
![[Pasted image 20241117160653.png]]

# Firewall - Opsense

Para administrar vlan desde fw se asignaron varias interfaces de red en el vcenter.


![[Pasted image 20241103181922.png]]


![[Pasted image 20241103180502.png]]

![[Pasted image 20241103180600.png]]

![[Pasted image 20241103180629.png]]

La segmentación y subneting se configura desde el fw e igual que las políticas de entrada y salida de los laboratorios, con sus respectivos rangos por cada segmentación.

![[Pasted image 20241103180934.png]]

**Referencias bibliográficas**

  - Ilimit. (2020). Arquitecturas monolíticas o arquitectura de microservicios: Ventajas e inconvenientes. Ilimit. [https://ilimit.com/blog/arquitecturas-monoliticas-o-arquitectura-de-microservicios-ventajas-e-inconvenientes/](https://ilimit.com/blog/arquitecturas-monoliticas-o-arquitectura-de-microservicios-ventajas-e-inconvenientes/)

- AppMaster. (2023). Migrar de una arquitectura monolítica a una de microservicios. AppMaster. [https://appmaster.io/es/blog/migrar-de-una-arquitectura-monolitica-a-una-de-microservicios](https://appmaster.io/es/blog/migrar-de-una-arquitectura-monolitica-a-una-de-microservicios)

- Desconocido. (s.f.). GitOps Pipeline [Imagen]. Medium. [https://miro.medium.com/v2/resize:fit:2000/1*JXEVSiR7kCzP2vwXVXFQ9w.png](https://miro.medium.com/v2/resize:fit:2000/1*JXEVSiR7kCzP2vwXVXFQ9w.png)

- OpenAI. (2023). ChatGPT (Marzo 14 versión) [Modelo de lenguaje grande]. [https://chat.openai.com/](https://chat.openai.com/)

  
  

## Contribuciones

Las contribuciones son bienvenidas. Por favor, sigue las normas de contribución descritas en `CONTRIBUTING.md`.

## Licencia

Este proyecto está bajo la licencia [MIT](LICENSE).

---

Para más detalles sobre la configuración y uso, consulta la [documentación oficial](https://argoproj.github.io/argo-cd/).



- Arquitectura [Enlace_Diagrama](https://app.eraser.io/workspace/h7S3xinu0Bn6rcJWrJCO?origin=share)
  
## Contribuciones

Se sigue un flujo de trabajo basado en Git para todas las contribuciones. Los cambios deben ser propuestos mediante Pull Requests, los cuales deben pasar por todos los controles automáticos antes de ser fusionados en la rama principal.

## Licencia

Este proyecto está bajo la Licencia MIT. Consulta el archivo `LICENSE` para obtener más detalles.

---
