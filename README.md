# Project_DevSecOps
---

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

4. **Despliegue Canary (Argo Rollouts)**:
   - Implementación de una nueva versión de la aplicación usando un despliegue Canary.
   - Monitorización del tráfico de usuarios y promoción de la nueva versión si es estable.

5. **Infraestructura como Código (IaC)**:
   - Terraform gestiona la provisión de la infraestructura en Huawei Cloud.
   - La infraestructura y la configuración de la aplicación se gestionan mediante un enfoque GitOps.

## Requisitos

- **GitHub Actions**: Para automatizar el pipeline de CI/CD.
- **Argo CD**: Para la gestión de los despliegues y la sincronización de entornos.
- **Argo Rollouts**: Para gestionar los despliegues Canary.
- **Huawei Cloud**: Para la infraestructura en la nube.
- **Terraform**: Para la gestión de la infraestructura como código (IaC).

## Instalación

1. Clonar el repositorio:

    ```bash
    git clone https://github.com/Jisuslz/Project_DevSecOps.git
    ```

2. Configurar las variables de entorno necesarias para Terraform y Huawei Cloud.
3. Configurar GitHub Actions en el repositorio.
4. Configurar Argo CD y Argo Rollouts para la gestión de despliegues.

## Uso

- Hacer un commit en el repositorio para activar el pipeline de CI/CD.
- Argo CD se encargará de sincronizar los entornos con los cambios realizados.
- Monitorear el despliegue Canary y promover la nueva versión si es estable.

## Contribuciones

Las contribuciones son bienvenidas. Por favor, sigue las normas de contribución descritas en `CONTRIBUTING.md`.

## Licencia

Este proyecto está bajo la licencia [MIT](LICENSE).

---

Para más detalles sobre la configuración y uso, consulta la [documentación oficial](https://argoproj.github.io/argo-cd/).



## Herramientas Utilizadas

- **GitOps**: Enfoque para la entrega continua que utiliza un repositorio Git como fuente única de verdad.
- **Github Actions**
- **Huawei cloud**
- **Kubernetes Cluster**: Plataforma de orquestación de contenedores utilizada para gestionar los servicios en el clúster.
- **Docker**: Tecnología para la construcción y distribución de contenedores de aplicaciones.
- **Load Balancer**: Componente que distribuye el tráfico entre las diferentes instancias de la aplicación durante el despliegue.
- Opcional **Terraform**
  
## Contribuciones

Se sigue un flujo de trabajo basado en Git para todas las contribuciones. Los cambios deben ser propuestos mediante Pull Requests, los cuales deben pasar por todos los controles automáticos antes de ser fusionados en la rama principal.

## Licencia

Este proyecto está bajo la Licencia MIT. Consulta el archivo `LICENSE` para obtener más detalles.

---
