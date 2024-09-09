# HemoHearth - Aplicación Web para Centro Médico

## Descripción

HemoHearth es una aplicación web diseñada para la gestión de pacientes en un centro médico especializado en el tratamiento de patologías como la anemia y la diabetes. La plataforma permite el registro de usuarios (pacientes), inicio de sesión, y genera alertas personalizadas basadas en los resultados médicos ingresados para cada paciente según sus patologías. Los usuarios reciben notificaciones al iniciar sesión en función de su estado de salud.

## Características

- **Registro de usuarios**: Los usuarios pueden registrarse proporcionando sus datos personales.
- **Inicio de sesión**: Los pacientes pueden iniciar sesión en la plataforma para acceder a su información médica.
- **Gestión de pacientes**: El personal médico puede ver todos los pacientes que esta en la aplicación web.
- **Gestión de resultados médicos**: El personal médico puede ingresar y actualizar los resultados de las pruebas de los pacientes.
- **Alertas de salud**: Se envían notificaciones automáticas a los usuarios si sus valores médicos indican algún riesgo.
- **Sistema de roles**: Panel de administración para médicos y usuarios del centro para registrar resultados y mirar los datos personales.

## Tecnologías Utilizadas

- **PHP**: Para la lógica del servidor y la interacción con la base de datos.
- **MySQL**: Base de datos relacional para almacenar la información de usuarios y resultados médicos.
- **XAMPP**: Paquete de software que incluye Apache y MySQL para ejecutar la aplicación localmente.
- **HTML/CSS/Bootstrap**: Para el diseño y la estructura del frontend.
- **JavaScript**: Validaciones y manejo de alertas en el frontend.

## Instalación

### Requisitos Previos

- **XAMPP** instalado con Apache y MySQL activos.

### Pasos de Instalación

1. **Clona el repositorio**:
   ```bash
   git clone https://github.com/tu-usuario/hemohearth.git
   cd hemohearth
