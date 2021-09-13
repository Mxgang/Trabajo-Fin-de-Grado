<?php

//https://api.telegram.org/bot1894214893:AAFqDTTlTWz18B3zWhyPgJpqM7eaLf_wZPI/setWebhook?url=https://compunctious-zip.000webhostapp.com/index.php SET WEBHOOK


//Funciones para conectar el bot con el script.

$path = "https://api.telegram.org/bot1894214893:AAFqDTTlTWz18B3zWhyPgJpqM7eaLf_wZPI";

$update = file_get_contents('php://input');
$update = json_decode($update,TRUE);

$chatId = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];
$frase = explode(' ', $message); //para extraer palabras de una frase
$contestacion = FALSE;
$reply = $update["message"]["reply_to_message"]["text"];

// Emoticonos que usaremos para la dificultad

$azul = "\xF0\x9F\x94\xB5";
$verde = "\xE2\x9C\x85";
$amarillo = "\xF0\x9F\x8C\x95";
$naranja = "\xF0\x9F\x94\xB6";
$rojo = "\xF0\x9F\x94\xB4";
$desconocido = "\xE2\x9A\xAA";
$profesoresT = "\xF0\x9F\x93\x8FProfesores Teoría\xF0\x9F\x93\x8F";
$profesoresP = "\xF0\x9F\x92\xBBProfesores Prácticas\xF0\x9F\x92\xBB";
$descripcion = "\xF0\x9F\x93\x96Descripción de la asignatura\xF0\x9F\x93\x96";
$asignatura = "No te he entendido bien. Es posible hayas escrito mal la asignatura";


// Se activa el teclado
keyboard($chatId);

// Conversación con el bot

$comando = $frase[0]; //la variable comando tendrá de contenido la primera palabra de lo que escribamos al chatbot

//si de repente no funciona, activar este codigo y desactivar el resto, para que no se acumulen las ordenes
/*if($comando == "hola"){
    $respuesta = "funcionaa";
    file_get_contents($path."/sendmessage?chat_id=".$chatId."&parse_mode=HTML&text=".urlencode($respuesta));
}*/
    
if(empty($reply)){ // Si el mensaje no es de una respuesta
	switch ($comando){

		case 'Hola':
		case 'hola':
		    $respuesta= "Hola, ¿Qué tal?";
			break;

		case 'Holi':
		case 'holi':
		    $respuesta= "Holi tere :3, el cumple de Javi es el 9 de Abril, el de Tere el 18 de Mayo, el de zkorpiux el 9 de Junio y el resto no me acuerdo :(";
			break;
			
		case ':(':
		case ':((':
		    $respuesta= ":(";
			break;

		case 'adios':
		case 'Adios':
		    $respuesta= "Nos vemos pronto!!";
			break;
			
		case '¿Como':
		case '¿Cómo':
		case 'cómo':
		case 'como':
			if($frase[1]=="te"){
				$respuesta = "Mi nombre es KernelBot, en honor al gatito que estuvo en la ETSIIT hace unos años.";
			}
			else{
				$respuesta = "No te he entendido bien";
			}
			break;

		case '¿Quien':
		case '¿Quién':
		case 'quien':
		case 'quién':
			if($frase[3]=="creador" | $frase[2] == 'creó' | $frase[2] == 'creo'){
				$respuesta = "Mi creador es @Maxigang. Estudiante de Ingeniería Informática de 2014 a 2021.";
			}
			else{
				$respuesta = "No te he entendido bien";
			}
			break;

		case 'Ayuda':
		case 'ayuda':
		case '/ayuda':
		case '/Ayuda':
			$respuesta = "Estos son los comandos que puedes usar conmigo: \n
			/Leyenda: Informa sobre  los emoticonos y su significado que se usan para indicar la dificultad de asignaturas y profesores
			/Asignaturas: Todo lo que quieras saber sobre una asignatura está en este comando. Simplemente sigue los pasos que se te indican
			/FAQ: Preguntas frecuentes sobre distintos temas relacionados con el Grado de Informática y la Universidad
			/General: Información general sobre la ETSIIT, horarios, aulas, etc.";
			break;

        case 'Asignaturas':
        case 'asignaturas':
		case '/asignaturas':
		case '/Asignaturas':
			$respuesta = "Dime la asignatura que quieras comprobar (puedes poner sus siglas o nombre completo)";
			$contestacion = TRUE;
			break;
		
		case 'Leyenda':
		case 'leyenda':
		case '/leyenda':
		case '/Leyenda':
			$respuesta = "Usaré colores para indicar la dificultad de las asignaturas y profesores. La leyenda de colores es la siguiente:\n"
			.$azul."Muy fácil\n"
			.$verde."Fácil\n"
			.$amarillo."Normal\n"
			.$naranja."Difícil\n"
			.$rojo."Muy difícil\n"
			.$desconocido."No se tiene información acerca de esa asignatura y/o profesor.";
			break;

		case 'FAQ':
		case 'faq':
		case '/faq':
		case '/FAQ':
			$respuesta = "¿Sobre qué cuestión quieres informarte?\n
			/Cursillos: Créditos optativos con cursillos
			/Especialidad: ¿Puedo elegir una asignatura de otra especialidad en la automatrícula?
			/Gracia: Convocatoria de gracia
			/Compensacion: Créditos de compensación
			/Empresa: Prácticas de empresa
			/Tribunal: Revisión por tribunal
			/TFG: Información sobre el Trabajo Fin de Grado";

			break;

		case '/General':
		case '/general':
		case 'General':
		case 'general':
			$respuesta = "¿Sobre qué cuestión quieres informarte?\n
			/Horarios: Información sobre los horarios del curso actual
			/Calendario: Calendario académico del curso 2020-2021 y 2021-2022
			/Examenes: Calendario de exámenes y asignación de aulas
			/Mencion: Toda la información acerca de la elección de mención
			/Profesorado: Información de contacto de los profesores de la ETSIIT
			/Instalaciones: Todo acerca de las instalaciones de la ETSIIT";

			break;

/*------------------------GENERAL--------------------*/

		case '/Horarios':

			$respuesta = "Los horarios los puedes consultar en los siguientes enlaces: \n
			Curso 2021-2022: https://etsiit.ugr.es/sites/centros/etsiit/public/inline-files/Horarios%20GII%20%2821-22%29.pdf
			Curso 2020-2021: https://etsiit.ugr.es/sites/centros/etsiit/public/inline-files/Horarios%20GII%20%2820-21%29.pdf
			Más información sobre horarios de otros grados de la ETSIIT: https://etsiit.ugr.es/docencia/grados/horarios";
			break;

		case '/Calendario':
		
			$respuesta = "El calendario académico lo puedes consultar en los siguientes enlaces: \n
			Curso 2021-2022: https://etsiit.ugr.es/sites/centros/etsiit/public/inline-files/ETSIIT_Calendario_2021_2022.pdf
			Curso 2020-2021: https://etsiit.ugr.es/sites/centros/etsiit/public/inline-files/ETSIIT_Calendario_2020_2021.pdf";
			break;

		case '/Examenes':
		
			$respuesta = "El calendario de exámenes y asignación de aulas se puede consultar en los siguientes enlaces: \n
			Curso 2020-2021: https://etsiit.ugr.es/sites/centros/etsiit/public/inline-files/CalendarioExamenes2021GII_0.pdf
			Curso 2021-2022: https://etsiit.ugr.es/sites/centros/etsiit/public/inline-files/Calendario-Examenes-21-22-GII.pdf
			Asignación de aulas convocatoria ordinaria Enero 2021: https://etsiit.ugr.es/sites/centros/etsiit/public/inline-files/Asignaci%C3%B3n%20Aulas%20Junio%202021%20%28GII%29.pdf
			Asignación de aulas convocatoria extraordinaria Febrero 2021: https://etsiit.ugr.es/sites/centros/etsiit/public/inline-files/Asignaci%C3%B3n%20Aulas%20Julio%202021%20%28GII%29.pdf
			Asignación de aulas convocatoria ordinaria Junio 2021: https://etsiit.ugr.es/sites/centros/etsiit/public/inline-files/Asignaci%C3%B3n%20Aulas%20Junio%202021%20%28GII%29.pdf
			Asignación de aulas convocatoria extraordinaria Julio 2021: https://etsiit.ugr.es/sites/centros/etsiit/public/inline-files/Asignaci%C3%B3n%20Aulas%20Julio%202021%20%28GII%29.pdf
			Asignación de aulas convocatoria extraordinaria Noviembre 2020: https://etsiit.ugr.es/sites/centros/etsiit/public/inline-files/Asignaci%C3%B3nAulasGIINov2020.pdf
			Asignación de aulas convocatoria extraordinaria Julio 2021: https://etsiit.ugr.es/sites/centros/etsiit/public/inline-files/Asignaci%C3%B3n%20Aulas%20Julio%202021%20%28GII%29.pdf
			Más información sobre el calendario de exámenes y asignación de aulas de otros grados de la ETSIIT: https://etsiit.ugr.es/docencia/grados/calendario-examenes";
			break;

		case '/Mencion':
		
			$respuesta = "La información sobre la elección de mención se puede consultar en el siguiente enlace: \n
			Elección de mención: https://etsiit.ugr.es/docencia/grados/eleccion-mencion";
			break;

		case '/Profesorado':
		
			$respuesta = "Información de contacto del profesorado como su teléfono y email de cada uno: \n
			Profesorado: https://etsiit.ugr.es/docencia/profesorado";
			break;

		case '/Instalaciones':
		
			$respuesta = "Información sobre las instalaciones de la ETSIIT: \n
			/Aulas: Instalaciones destinadas al desarrollo de la docencia teórica y práctica
			/Biblioteca: Horario de la biblioteca de la ETSIIT
			/Secretaria: Horario y cita previa de secretaría
			/Conserjeria: Horarios y contacto de conserjería
			/Copisteria: Servicio de reprografía y fotocopia de la ETSIIT
			/Cafeteria: Información sobre el servicio de cafetería
			/Comedor: Información sobre el servicio de comedor";
			break;

/*------------------------INSTALACIONES--------------------*/

		case '/Aulas':
		
			$respuesta = "Instalaciones destinadas al desarrollo de la docencia teórica y práctica y otras actividades académicas: \n
			Aulas para clases de teoría: https://etsiit.ugr.es/sites/centros/etsiit/public/inline-files/ETSIIT_Aulas_Teor%C3%ADa.pdf
			Aulas para clases de Prácticas: https://turing.ugr.es/aulas/pdf/inventario.pdf
			Salas de conferencias, presentación de trabajos y reuniones: https://etsiit.ugr.es/sites/centros/etsiit/public/inline-files/ETSIIT_Salas.pdf
			Espacios de trabajo para estudiantes de la ETSIIT: https://etsiit.ugr.es/sites/centros/etsiit/public/inline-files/Espacios%20de%20trabajo%20para%20estudiantes%20de%20la%20ETSIIT.pdf
			Más información: https://etsiit.ugr.es/la-escuela/presentacion/instalaciones-servicios ";
			break;

		case '/Biblioteca':
		
			$respuesta = "Información sobre el servicio de cafetería: \n
			Horario: de Lunes a Viernes de 08:30 a 20:30\n
			Más información: https://etsiit.ugr.es/la-escuela/presentacion/instalaciones-servicios/biblioteca";
			break;

		case '/Secretaria':
		
			$respuesta = "Horario y cita previa de secretaría: \n
			Horario: de Lunes a Viernes de 09:00 a 14:00\n
			Cita previa: se realiza con la aplicación CIGES: https://ciges.ugr.es/
			Más información: https://etsiit.ugr.es/la-escuela/secretaria";
			break;

		case '/Conserjeria':
		
			$respuesta = "Horarios y contacto de conserjería: \n
			De lunes a viernes de 8:00 a 22:00\n
			Números de teléfono: \n
			- Edificio de administraciones/departamentos: 958 242800\n
			- Edificio aulario: 958 240819 (planta baja), 958 242817 (tercera planta)\n
			- Edificio Auxiliar: 958 242821";
			break;

		case '/Copisteria':
		
			$respuesta = "Servicio de reprografía y fotocopia de la ETSIIT \n
			La ETSIIT dispone de un servicio de reprografía situado en la planta sótano, junto a la cafetería.\n
			Horario: de Lunes a Viernes de 9:00 a 14:00 y de 16:00 a 20:00\n
			Actualmente, este servicio ofrece IMPRESIONES ALSA SL, con el siguiente correo electrónico de contacto: alsainfortel@gmail.com";
			break;

		case '/Cafeteria':
		
			$respuesta = "Información sobre el servicio de cafetería: \n
			Horario: de Lunes a Viernes de 08:00 a 20:00";
			break;

		case '/Comedor':
		
			$respuesta = "Información sobre el servicio de comedor: \n
			Horario: de Lunes a Viernes de 13:00 a 15:30\n
			Precio: 3.5€\n
			Menú del comedor: https://scu.ugr.es/pages/menu/llevar/menus";
			break;



/*------------------------FAQ--------------------*/

		case '/Cursillos':
			$respuesta = "Créditos optativos con cursillos\n
			Es posible convalidar 12 créditos optativos con cursillos, esto implicaría ahorrarte cursar 2 asignaturas optativas.
			Hay múltiples cursos que dan créditos a los informáticos, aunque algunos son inútiles, ejemplos:
			- Curso de Sierra Nevada
			- Curso de Federico García Lorca
			- Currículum 2.0
			- Biblioteca
			- Etc
			La mayoría puedes encontrarlos en abierta.ugr.es, buscas los plazos de inscripción y te apuntas.
			Al finalizar el curso, para obtener los créditos debes:
			- Pagar el título del curso desde abierta.ugr.es, suele ser 36€.
			- Vas a secretaría y con el título reconoces los créditos, debes pagar una parte de los créditos.";
			break;

		case '/Especialidad':
			$respuesta = "¿Puedo elegir una asignatura de otra especialidad en la automatrícula?\n
			No se puede. Si tienes una especialidad elegida, solo podrás matricularte de las asignaturas de tu especialidad.
			En la alteración de la matrícula sí puedes hacerlo en aquellas asignaturas que queden plazas libres.
			Un pequeño truco por si quieres coger una asignatura con las plazas llenas es ir actualizando constantemente la página hasta que alguien se desmatricule de esa asignatura, entonces tendrás que ser rápido, coger la asignatura y finalizar la alteración de la matrícula. Con paciencia puedes conseguirlo.";
			break;
			
		case '/Gracia':
			$respuesta = "Convocatoria de gracia\n
			Es una convocatoria extra que se proporciona cuando has agotado 6 convocatorias (3 matrículas). 
			Para pedirla, debes ir a conserjería a principios del curso (septiembre) y ya ellos se encargarán del papeleo.
			La asignatura te costará un 30% de una 4ª matrícula, es decir, en total unos 150€ y el método de evaluación es de evaluación única final.
			Normativa e instrucciones oficiales: https://sede.ugr.es/procs/Gestion-Academica-Solicitud-de-convocatoria-de-gracia/";
			break;

			
		case '/Compensacion':
			$respuesta = "Créditos de compensación\n
			Es una opción de convalidación de créditos de la asignatura que quieras cumpliendo los siguientes requisitos:
			- Que solo te quede el TFG y esa asignatura por aprobar.
			- Haber agotado mínimo 4 convocatorias de dicha asignatura (2 matrículas).
			- Haber sacado en al menos 2 convocatorias más de un 3 de nota.
			Si cumples estos requisitos entonces debes matricularte de la asignatura (solo si has agotado 4 convocatorias) e ir a secretaría a compensarla. Si has agotado las 6 convocatorias, puedes compensarla directamente sin matricularte (ya que no puedes hacerlo)";
			break;

			
		case '/Empresa':
			$respuesta = "Prácticas de empresa\n
			Son prácticas externas en alguna empresa que eliges por la plataforma Ícaro.
			A la hora de convalidar créditos, puedes convalidar hasta 12 créditos optativos dependiendo del número de horas trabajadas, además, puedes solicitar evaluación donde es normal tener una nota muy alta que viene bien para aumentar la nota media.
			Para solicitar las prácticas de empresa hay que hacer lo siguiente:
			- Tener el 50% o más de los créditos superados.
			- Registrarte en la plataforma de ícaro https://icaro.ual.es/ y poner todos tus datos.
			- Solicitas la oferta que más te llame la atención.
			- Si a la empresa le interesas, contactará contigo, harás una entrevista y te pondrás a trabajar.
			- Una vez tengas el contrato, vas al CEPEP a firmar un papel que entregas en la ETSIIT y ya ellos te matriculan de la asignatura Prácticas de Empresa. Si te matriculas antes de estar en las prácticas te rechazarán la asignatura, pero no pasa nada, haciendo lo anterior te matricularían ellos.";
			break;

			
		case '/Tribunal':
			$respuesta = "Revisión por tribunal\n
			Si después de la revisión de un examen no estás conforme con la nota, método de evaluación, manera de corregir del profesor o que no se ha ajustado a la guía docente, tienes la posibilidad de pedir la revisión por tribunal.
			Vas a conserjería y pides una hoja de revisión por tribunal, rellenas tu datos y la información que pide y vas a secretaría a entregarlo. Debes entregarlo 1 día después de la revisión del examen.
			Cuando el tribunal haya corregido el examen te notificarán por correo electrónico y enviarán una carta a tu domicilio.";
			break;

		case '/TFG':
			$respuesta = "Información sobre el Trabajo Fin de Grado\n
			El Trabajo Fin de Grado, como bien indica su nombre, es un trabajo completo que se realiza al terminar los estudios. Para poder matricularte del TFG debes cumplir los siguientes requisitos:
			- Tener como mínimo el 75% de los créditos superados.
			- Tener todas las asignaturas de 1º aprobadas.

			Si te quedan asignaturas de 1º pendientes
			Si te queda alguna asignatura del primer cuatrimestre del 1º y luego la apruebas, te puedes matricular del TFG en la alteración del 2º cuatrimestre.
			Si te queda alguna asignatura pendiente del segundo cuatrimestre de 1º, no podrás matricularte ese año del TFG a menos que pidas la convocatoria especial de Noviembre donde haces el examen de esa asignatura en Noviembre, si la apruebas, podrás matricularte del TFG en la alteración de matrícula del 2º cuatrimestre.

			Una vez te matriculas del TFG, habrá una charla relacionada con el proyecto. Eliges de una lista los TFG que te interesan y te asignarán uno
			Una vez asignado el TFG, tendrás tu tutor correspondiente y ya podrás empezarlo.
			Más información en el siguiente enlace: https://etsiit.ugr.es/pages/trabajos_fin_grado

			TFG con un tema propuesto
			Otra opción es que prefieras hacer un TFG de un tema que hayas pensado y decidido llevar a cabo. Para realizarlo hay que buscar al profesor adecuado que quiera realizarlo contigo. El profesor tiene los meses de septiembre y octubre para registrar el tema que has propuesto, así que de tener un tema que quieras proponer, hay que hacerlo cuanto antes.";
			break;

		default:

			$respuesta="No te he entendido bien. Puedes usar el comando /Ayuda para saber qué puedes preguntarme ";
			break;

		

	}
	enviarMensaje($chatId,$respuesta,$contestacion);	
}
else { //si el mensaje es de una respuesta

/*------------------------PRIMER CURSO--------------------*/
/*------------------------PRIMER CUATRIMESTRE--------------------*/
	switch ($frase[0]){
	    
		/*case '1':
		case 'primero':
		case 'Primero':
			$respuesta = "Dime qué asignatura quieres comprobar.";
			$contestacion = TRUE;
			break;*/

		case 'ALEM':
		case 'alem':
		case 'Álgebra':
		case 'álgebra':
		case 'Algebra':
		case 'algebra':

			$respuesta = $naranja."Álgebra Lineal y Estructuras Matemáticas".$naranja."\n\n"
			.$profesoresT."\n"
			.$amarillo."José Carlos Rosales González: En clase lee sus PDFs, si dices que no lo entiendes te lo vuelve a leer. Puedes no ir a sus clases y luego estudiar los temas por tu cuenta \n"
			.$naranja."Laiachi El Kaoutit Zerri: En sus clases usa mucha notación algebraica y te vas a perder mucho. Las relaciones de ejercicios son imposibles(enteras). No va a matar en los exámenes\n"
			.$naranja."Manuel Cortés Izurdiaga: Los examenes se ciñen a lo dado en clase, el problema es que no te enteras del 75% con sus clases\n"
			.$rojo."Juan Manuel Urbano Blanco: Exámenes complicados. Sus explicaciones son buenas pero no están enfocadas para hacer los exámenes. No recomendable\n"
			.$verde."Jesús García Miranda: Mejor profesor de la ETSIIT. Pone preguntas con una vuelta de tornillo de más, pero sus explicaciones y su implicación están a la altura.\n\n"
			.$profesoresP."\n"
			.$verde."José Carlos Rosales González: Explica muy bien. Se preocupa para que entiendas y preguntes sobre los ejercicios de clase \n"
			.$naranja."Laiachi El Kaoutit Zerri: Hace 1 problema o 2 por clase de practicas. Si no estás atento, te pierdes\n"
			.$naranja."Manuel Cortés Izurdiaga: Va con buenas intenciones pero explica fatal\n"
			.$rojo."Juan Manuel Urbano Blanco: Corrige ejercicios en practicas y hace parciales. No es recomendable.\n"
			.$verde."Jesús García Miranda: Un santo, un dios, un grande, un titan, un fiera, un masodonte, un crack, un tiburon, una deidad si quieres aprobar ALEM.\n\n";

			break;

		case 'CA':
		case 'ca':
		case 'Cálculo':
		case 'Calculo':
		case 'cálculo':
		case 'calculo':

			$respuesta = $naranja."Cálculo".$naranja."\n\n"
			.$profesoresT."\n"
			.$amarillo."Pilar Muñoz Rivas: Es un amor de persona. Explica muy bien y puedes preguntarle cualquier duda, estudiando se saca fácil. Importante ir a sus clases \n"
			.$amarillo."Pieralberto Sicbaldi: Explica muy bien aunque exige muchas demostraciones. Sus parciales son asequibles. \n"
			.$verde."Jerónimo Alaminos Prats: Recomendado. Explica genial, es muy cercano y se porta bien en el examen \n\n"
			.$profesoresP."\n"
			.$amarillo."Pilar Muñoz Rivas: Es un amor de persona. Explica muy bien y puedes preguntarle cualquier duda, estudiando se saca fácil. Importante ir a sus clases \n"
			.$amarillo."Pieralberto Sicbaldi: No tiene mucha idea de usar Máxima. Tiene los exámenes más faciles de toda la asignatura \n"
			.$verde."Jerónimo Alaminos Prats: Explica muy bien, claro y ejercicios no te faltan. Los examenes de practicas son asequibles \n";
			break;

		case 'Fundamentos':
		case 'fundamentos':
		case 'fs':
		case 'FS':
		case 'fp':
		case 'FP':
		case 'fft':
		case 'FFT':
		case 'fbd':
		case 'FBD':
		case 'fis':
		case 'FIS':
		case 'fr':
		case 'FR':

			if($frase[2] == "software" | $frase[2] == 'Software' | $frase[0] == 'fs' | $frase[0] == 'FS'){

				$respuesta = $verde."Fundamentos del Software".$verde."\n\n"
				.$profesoresT."\n"
				.$amarillo."Ana Mª Sánchez: No tiene mucha idea de lo que cuenta. Los examenes los hace con una plantilla y los corrije con solucionario, aconsejo ir a revisión. \n"
				.$verde."Rosana Montes: Las clases son un poco aburridas. MUY IMPORTANTE hacer lo que siga por Telegram y el portfolio. Muy buena poniendo la nota, si has hecho lo del Telegram y apruebas los exámenes vas a tener notazas \n"
				.$amarillo."Buenaventura Clares: Se pasa las clases pasando diapositivas pero si atiendes, entiendes. Sus examenes son 100% de preguntas de definiciones \n\n"
				.$profesoresP."\n"
				.$amarillo."Ana Mª Sánchez: Los exámenes no son difíciles pero el tiempo demasiado justo \n"
				.$naranja."Francisco Araque: Explica a ratos y los exames son jodidisimos \n"
				.$amarillo."Kawtar Benghazi: Intenta sacar buena nota en el 1º parcial porque el 2º es bastante dificil. Puedes preguntarle todo lo que no entiendas \n"
				.$rojo."Salvador Villena: No explica, y en el examen los scripts deben funcionar, sino 0 (no mira el codigo). NO OS COPIÉIS  \n"
				.$verde."Pablo Garcia: Te explica todos los comandos y pone ejemplos prácticos. Los exámenes son muy asequibles. Hay que atender a clase \n"
				.$verde."Miguel Vega: Explica muy bien y sus exámenes son muy asequibles. Recomendable \n"
				.$desconocido."David Griol: se desconoce \n";
			}
			else if($frase[2] == "programación" | $frase[2] == 'Programación' | $frase[2] == "programacion" | $frase[2] == 'Programacion' | $frase[0] == 'fp' | $frase[0] == 'FP'){

				$respuesta = $amarillo."Fundamentos de Programación".$amarillo."\n\n"
				.$profesoresT."\n"
				.$amarillo."Juan Carlos Cubero Talavera: Explica con diapositivas pero tiene los mejores apuntes de programación la carrera. Examenes normales pero muy estricto corrigiendo \n"
				.$verde."Manuel Lozano Márquez: Explica bien pero tienes que leer las diapositivas de Cubero, te motiva a estudiar programación y a no abandonarlo, es muy permisivo corrigiendo \n"
				.$naranja."David A. Pelta Mochcovsky: Explica bien y puedes pedirle que te explique cualquier duda o tutorías, bastante exigente. \n"
				.$naranja."Daniel Molina Cabrera: Explica bien y es buen profesor, aunque corrige duro en los exámenes. \n\n"
				.$profesoresP."\n"
				.$amarillo."Juan Carlos Cubero Talavera: Explica bien, con diapositivas claras y tal. Sus practicas son algo mas complicadas que el resto pero te preparan mejor para la teoría \n"
				.$verde."Antonio Garrido Carrillo: Buen profesor en general. Haz los ejercicios y atiende en clase, tendrás buenas notas \n"
				.$verde."Manuel Lozano Márquez: Es muy buena gente. Si haces los ejercicios y las prácticas que manda, puedes tener buena nota \n"
				.$verde."Juan Gómez Romero: Explica muy bien y siempre intenta tener cercania con el alumno \n"
				.$verde."Siham Tabik: Explica bien, Se lía mucho pero se puede aprender bien con sus clases. Muy asequibles sus exámenes \n"
				.$desconocido."Mª del Carmen Pegalajar: No hay información \n";
			}
			else if($frase[1] == 'físicos' | $frase[1] == 'fisicos' | $frase[1] == 'Físicos' | $frase[1] == 'Fisicos' | $frase[0] == 'fft' | $frase[0] == 'FFT'){

				$respuesta = $naranja."Fundamentos Físicos y Tecnológicos".$naranja."\n\n"
				.$profesoresT."\n"
				.$amarillo."Pedro Cartujo Cassinello: No explica mucho. Repite preguntas de hace años. Si suspendes en la extraordinaria con al menos un 3 ve a la revisión, puedes llevarte una sorpresa y aprobar. \n"
				.$verde."Ignacio Melchor Ferrer: Explica muy bien, se hacen muchos ejercicios (incluso clases de repaso antes del examen). Suele quitar la parte de corriente alterna. Recomendable \n"
				.$rojo."José Luis Padilla de la Torre: Explica muy bien pero es muchísimo temario y a diferencia de otros no hace parciales. Examen final muy duro y aprueba poca gente. \n\n"
				.$profesoresP."\n"
				.$amarillo."Pedro Cartujo Cassinello: Igual que en teoría, explica bastante mal tienes que mirar videos de youtube \n"
				.$verde."Ignacio Melchor Ferrer: Puede ser que lleges muy perdido el primer día, pero explica muy bien y las practicas son asequibles \n"
				.$amarillo."José Luis Padilla de la Torre: En sus clases resuelve dudas de teoría. Las prácticas las haces por tu cuenta. Hace muchos test de laboratorio \n"
				.$desconocido."Daniel González Castro: No hay información \n";
			}
			else if($frase[2] == 'bases' | $frase[2] == 'Bases' | $frase[0] == 'FBD' | $frase[0] == 'fbd'){

				$respuesta = $naranja."Fundamentos de Bases de Datos".$naranja."\n\n"
				.$profesoresT."\n"
				.$desconocido."Mª Amparo Vila Miranda: No hay información \n"
				.$desconocido."Juan Manuel Medina Rodríguez: No hay información \n"
				.$verde."Rocío Celeste Romero Zaliz: No hay información \n"
				.$amarillo."Olga Pons Capote: Explica bastante bien, las prácticas son fáciles con ella \n\n"
				.$profesoresP."\n"
				.$desconocido."Mª Amparo Vila Miranda: No hay información \n"
				.$desconocido."Juan Manuel Medina Rodríguez: No hay información \n"
				.$amarillo."Rocío Celeste Romero Zaliz: No hay información \n"
				.$desconocido."Olga Pons Capote: No hay información \n";
			}
			else if($frase[2] == 'Ingeniería' | $frase[2] == 'ingeniería' | $frase[2] == 'Ingenieria' | $frase[2] == 'ingenieria' | $frase[0] == 'fis' | $frase[0] == 'FIS'){

				$respuesta = $naranja."Fundamentos de Ingeniería del Software".$naranja."\n\n"
				.$profesoresT."\n"
				.$amarillo."María Luisa Rodríguez Almendros: No hay información \n"
				.$desconocido."Miguel Vega López: No hay información \n"
				.$desconocido."Salvador Villena Morales: No hay información \n"
				.$desconocido."Francisco Luis Gutiérrez Vela: No hay información \n\n"
				.$profesoresP."\n"
				.$amarillo."María Luisa Rodríguez Almendros: No hay información \n"
				.$desconocido."Miguel Vega López: No hay información \n"
				.$desconocido."Salvador Villena Morales: No hay información \n"
				.$desconocido."Cecilia Delgado Negrete: No hay información \n";
			}
			else if($frase[2] == 'Redes' | $frase[2] == 'redes' | $frase[0] == 'fr' | $frase[0] == 'FR'){

				$respuesta = $naranja."Fundamentos de Redes".$naranja."\n\n"
				.$profesoresT."\n"
				.$naranja."Sandra Sendra Compte: Explica todo y muy completo, hace muchos ejercicios, pero estricta en los exámenes \n"
				.$naranja."José Camacho Páez: Explica bien pero los exámenes son duros, en tutorías explica los problemas mejor que en clase \n"
				.$naranja."Juan Manuel López Soler: No hay información \n\n"
				.$profesoresP."\n"
				.$desconocido."Sandra Sendra Compte: No hay información \n"
				.$amarillo."Antonio Mora García: No hay información \n"
				.$desconocido."Juan Manuel López Soler: Buen profesor, se implica bastante \n";
			}
			else{
				$respuesta = $asignatura;
			}
			break;
			


/*------------------------SEGUNDO CUATRIMESTRE--------------------*/
		case 'ES':
		case 'es':
		case 'Estadística':
		case 'Estadistica':
		case 'estadística':
		case 'estadistica':

			$respuesta = $amarillo."Estadística".$amarillo."\n\n"
			.$profesoresT."\n"
			.$verde."Nuria Rico Castro: No hay información \n"
			.$desconocido."Rocío Raya Miranda: Explica muy bien aunque exige muchas demostraciones. Sus parciales son asequibles. \n"
			.$desconocido."Mª Del Carmen Segovia García: No hay información \n"
			.$verde."María Dolores Huete Morales: Explica bien y se hacen ejercicios en clase \n\n"
			.$profesoresP."\n
			No hay información sobre los profesores de prácticas \n";

			break;

		case 'ies':
		case 'IES':
		case 'Empresa':
		case 'empresa':

			$respuesta = $verde."Ingeniería, Empresa y Sociedad".$verde."\n\n"
			.$profesoresT."\n"
			.$desconocido."Rodrigo Martín Rojas: No hay información \n"
			.$verde."Javier Delgado Ceballos: Suele proponer bastantes trabajos grupales en las clases para motivar la participación. Explica bien y el examen es muy asequible. \n"
			.$desconocido."Francisco Juan López Martín: No hay información \n"
			.$desconocido."José Aureliano Martín Segura: No hay información \n"
			.$desconocido."Elena Mellado García: No hay información \n\n"
			.$profesoresP."\n
			No hay información sobre los profesores de prácticas \n";
			
			break;

		case 'lmd':
		case 'LMD':
		case 'lp':
		case 'LP':
		case 'Lógica':
		case 'Logica':
		case 'lógica':
		case 'logica':
			if($frase[2] == "Métodos" | $frase[2] == 'métodos' | $frase[2] == "Metodos" | $frase[2] == 'metodos' | $frase[0] == 'ec' | $frase[0] == 'EC'){
				$respuesta = $naranja."Lógica y Métodos Discretos".$naranja."\n\n"
				.$profesoresT."\n"
				.$amarillo."Francisco García Olmedo: No hay información \n"
				.$amarillo."Aurora Inés Del Río Cabeza: No hay información \n"
				.$amarillo."Antonio J. Rodríguez Salas: Examen final que cuenta 10 puntos y las prácticas suben, te dice los tipos de ejercicios que entran \n"
				.$desconocido."Manuel Cortés Izurdiaga: No hay información \n"
				.$rojo."Juan Manuel Urbano Blanco: No hay información \n"
				.$amarillo."Jesús García Miranda: Explica bien, es buen profesor y muy flexible con las notas. Hace 2 parciales (de 1p cada uno) Si no te salen bien, no te lo cuenta y haces el final a 7p. Sacando en el examen un 5, aunque tengas las prácticas un 0, te aprueba igualmente. \n\n"
				.$profesoresP."\n"
				.$amarillo."Jesús García Miranda: Sus prácticas consisten en hacer ejercicios en clase. Manda 3 relaciones de ejercicios que es lo que te puntuará en las prácticas\n";
			}
			else if($frase[2] == "Programación" | $frase[2] == 'programación' | $frase[2] == "Programacion" | $frase[2] == 'programacion' | $frase[0] == 'lp' | $frase[0] == 'LP'){

				$respuesta = $naranja."Lógica y Programación".$naranja."\n\n"
				.$descripcion."\n
				Cálculo lambda en teoría, Haskell en prácticas. En la guía también hay Lógica Combinatoria y Prolog, pero no se ven demasiado. \n\n"
				.$profesoresT."\n"
				.$amarillo."Miguel García Olmedo: Ideal para los amantes de las matemáticas. Prima lejana de Álgebra y LMD. Si se lleva al día no tiene por qué hacerse cuesta arriba, el profesor es amable y explica bien. Sales de la asignatura sabiendo algo de programación funcional, cosa que luego puedes aplicar en python u otros lenguajes para hacerte la vida más fácil. En resumen, cuesta pero merece la pena, dicen que haskell es el futuro a largo plazo. \n\n"
				.$profesoresP."\n"
				.$desconocido."Alejandro J. León Salas:  No hay información \n";

			}
			else{
				$respuesta = $asignatura;
			}
			break;

		case 'MP':
		case 'mp':
		case 'Metodología':
		case 'metodología':
		case 'Metodologia':
		case 'metodologia':

			$respuesta = $naranja."Metodología de la Programación".$naranja."\n\n"
			.$profesoresT."\n"
			.$amarillo."Francisco José Cortijo Bon: Muy disciplinario. Algo testarudo y estricto, no le gusta que le preguntes tonterías, pero se implica en explicar las cosas y en hacer la asignaturas progresiva,  de manera que si te implicas puedes llevar una buena base para los cursos posteriores. \n"
			.$desconocido."Silvia Acid Carrillo: No hay información \n"
			.$amarillo."Manuel Gómez Olmedo: Explica bien y es comprensivo, puedes aprobar sin problemas. \n"
			.$amarillo."Javier Abad Ortega: Explica bien pero estricto, importante ir a clase porque dirá cosas importantes de cara al examen. Tarda mucho en corregir pero lo hace bien. \n"
			.$desconocido."Enrique Bermejo Nievas: No hay información \n"
			.$desconocido."Juan Francisco Huete Guadix: No hay información \n\n"
			.$profesoresP."\n"
			.$desconocido."Francisco José Cortijo Bon: No hay información\n"
			.$naranja."Silvia Acid Carrillo: Explica poco \n"
			.$amarillo."David Pelta: No hay información \n"
			.$desconocido."Javier Abad Ortega: No hay información \n";
			
			break;

		case 'TOC':
		case 'toc':
		case 'Tecnología':
		case 'tecnología':
		case 'Tecnologia':
		case 'tecnologia':

			$respuesta = $amarillo."Tecnología y Organización de Computadores".$amarillo."\n\n"
			.$profesoresT."\n"
			.$verde."Manuel Rodríguez Álvarez: Explica muy bien y es un amor de persona. Pone exámenes muy asequibles \n"
			.$desconocido."Pedro Jesús Martín Smith: Está de baja \n"
			.$desconocido."Eva Martínez Ortigosa: Explica bien y es comprensivo, puedes aprobar sin problemas. \n"
			.$desconocido."Carlos García Puntonet: Explica bien pero estricto, importante ir a clase porque dirá cosas importantes de cara al examen. Tarda mucho en corregir pero lo hace bien. \n\n"
			.$profesoresP."\n"
			.$verde."Carlos García Puntonet: Explica No hay información \n"
			.$desconocido."Pedro Jesús Martín Smith: No hay información \n"
			.$verde."Manuel Rodríguez Álvarez: No hay información \n"
			.$desconocido."Eduardo Ros Vidal: No hay información \n";
			
			break;

/*------------------------SEGUNDO CURSO--------------------*/
/*------------------------PRIMER CUATRIMESTRE--------------------*/

		case 'Estructura':
		case 'estructura':
		case 'ec':
		case 'EC':
		case 'ed':
		case 'ED':
			if($frase[2] == "Computadores" | $frase[2] == 'computadores' | $frase[0] == 'ec' | $frase[0] == 'EC'){

				$respuesta = $naranja."Estructura de Computadores".$naranja."\n\n"
				.$profesoresT."\n"
				.$amarillo."Antonio Cañas Vargas:Aunque no te enteres muy bien de la asignatura, trabajas un poco y la Magia de Cañas te ayudará a aprobar. \n"
				.$naranja."F. Javier Fernández Baldomero: Clases pesadas y no enseña apenas \n\n"
				.$profesoresP."\n"
				.$amarillo."Antonio Cañas Vargas: Los exámenes no son difíciles pero el tiempo demasiado justo \n"
				.$amarillo."F. Javier Fernández Baldomero: Explica a ratos y los exames son jodidisimos \n";
			}
			else if($frase[2] == "Datos" | $frase[2] == 'datos' | $frase[0] == 'ed' | $frase[0] == 'ED'){

				$respuesta = $naranja."Estructura de Datos".$naranja."\n\n"
				.$profesoresT."\n"
				.$desconcido."Javier Abad Ortega: No hay información \n"
				.$verde."MIguel García Silvente: La clases teóricas se pueden hacer algo cansinas por su forma de explicar, pero se implica en sus explicaciones. A la hora de evaluar se podría decir que tira al alza (sin exagerar, claro) \n"
				.$amarillo."Rosa Rodríguez Sánchez: No hay información \n"
				.$amarillo."Joaquín Fernández Valdivia: No hay información \n\n"
				.$profesoresP."\n"
				.$desconocido."M. Carmen Pegalajar: No hay información \n"
				.$desconocido."Rosa Rodriguez Sánchez: No hay información \n"
				.$amarillo."Joaquin Fdez-Valdivia: No hay información \n"
				.$desconcido."Javier Martínez Baena: No hay información \n";
			}
			else{
				$respuesta = $asignatura;
			}
			break;

		case 'PDOO':
		case 'pdoo':
		case 'PW':
		case 'pw':
		case 'PTC':
		case 'ptc':
		case 'PGV':
		case 'pgv':
		case 'PLD':
		case 'pld':
		case 'PPR':
		case 'ppr':
		case 'PDM':
		case 'pdm':
		case 'Programación':
		case 'programación':
		case 'Programacion':
		case 'programacion':

			if($frase[2] == "Diseño" | $frase[2] == 'diseño' | $frase[0] == 'pdoo' | $frase[0] == 'PDOO'){

				$respuesta = $amarillo."Programación y Diseño Orientado a Objetos".$amarillo."\n\n"
				.$profesoresT."\n"
				.$rojo."Miguel Lastra Leidinger: No se recomienda. \n"
				.$amarillo."MªJosé Rodríguez Fortiz: Explica bien y no abusa de Ruby, se puede sacar sin problemas. \n"
				.$desconocido."Nuria Medina Medina: No hay información \n"
				.$verde."Zoraida Callegas Carrión: No hay información \n\n"
				.$profesoresP."\n"
				.$desconocido."Miguel Lastra Leidinger: No hay información \n"
				.$amarillo."verde: Pone pocos o ningún examen en Ruby, lo que facilita mucho aprobar las prácticas \n"
				.$desconocido."Kawtar Benghazi Akhlaki: No hay información \n"
				.$desconocido."María del Campo Bermúdez Edo: No hay información \n"
				.$amarillo."Francisco Velasco Anguita:No hay información \n"
				.$desconocido."Nuria Medina Medina: No hay información \n";

			}
			else if($frase[1] == "Web" | $frase[1] == 'web' | $frase[0] == 'pw' | $frase[0] == 'PW'){

				$respuesta = $verde."Programación Web".$verde."\n\n"
				.$descripcion."\n
				Pertenece al Tridente de asignaturas web, junto con TW y SIBW, aprendes programación web en HTML, CSS, PHP... \n\n"
				.$profesoresT."\n"
				.$verde."José Manuel Benítez Sánchez: Las explicaciones del profesor no son la típica lectura de diapositivas, te explica muy bien los conceptos y los relaciona para que lo comprendas bien. Las prácticas son sencillas aunque requieren de un poco de tiempo y el examen final si asistes a todas las clases de teoría con media hora o una hora de repaso se aprueba fácil(de hecho si no vas a teoría te va a costar un poco aprobar). \n\n"
				.$profesoresP."\n"
				.$verde."José Manuel Benítez Sánchez:  No hay información \n"
				.$verde."Juan Manuel Fernández Luna:  No hay información \n";
			}
			else if($frase[1] == "Técnica" | $frase[1] == 'Tecnica' | $frase[1] == "técnica" | $frase[1] == 'tecnica' | $frase[0] == 'ptc' | $frase[0] == 'PTC'){

				$respuesta = $verde."Programación Técnica y Científica".$verde."\n\n"
				.$descripcion."\n
				Hay 2 prácticas: 1ª Hacer web scrapping y 2ª Machine Learning \n\n"
				.$profesoresT."\n"
				.$verde."Eugenio Aguirre Molina: No hay información \n\n"
				.$profesoresP."\n"
				.$desconocido."Eugenio Aguirre Molina:  No hay información \n";


			}
			else if($frase[1] == "Gráfica" | $frase[1] == 'Grafica' | $frase[1] == "gráfica" | $frase[1] == 'grafica' | $frase[0] == 'pgv' | $frase[0] == 'PGV'){

				$respuesta = $verde."Programación Gráfica de Videojuegos".$verde."\n\n"
				.$descripcion."\n
				No hay descripción de la asignatura \n\n"
				.$profesoresT."\n"
				.$verde."Alejandro J. León Salas: Profesor que puede faltar a clase casi sin previo aviso (avisando cuando ya estás llegando a la escuela o en camino...)Te dice que te va a dar material para complementar lo que no te explica pero no lo hace, te las tienes que apañar. Examen fácil, corrige al alza. \n\n"
				.$profesoresP."\n"
				.$desconocido."Alejandro J. León Salas:  No hay información \n";

			}
			else if($frase[1] == "Lúdica" | $frase[1] == 'Ludica' | $frase[1] == "lúdica" | $frase[1] == 'ludica' | $frase[0] == 'pld' | $frase[0] == 'PLD'){

				$respuesta = $amarillo."Programación Lúdica".$amarillo."\n\n"
				.$descripcion."\n
				La asignatura no es complicada, para ser de la rama de CSI se da muy poco sobre IA y mucho sobre Ingeniera Software. (Es un buen repaso de muchos conceptos de diferentes asignaturas de la rama de Software) Las prácticas son muy autónomas \n\n"
				.$profesoresT."\n"
				.$verde."Antonio Bautista Bailón Morillas: No hay información \n\n"
				.$profesoresP."\n"
				.$desconocido."Antonio Bautista Bailón Morillas:  No hay información \n";

			}
			else if($frase[1] == "Paralela" | $frase[1] == 'paralela' | $frase[0] == 'ppr' | $frase[0] == 'PPR'){

				$respuesta = $verde."Programación Lúdica".$verde."\n\n"
				.$descripcion."\n
				No hay descripción de la asignatura \n\n"
				.$profesoresT."\n"
				.$verde."José Miguel Mantas Ruiz: El profesor explica bastante bien y las prácticas no son difíciles. A parte el profesor es bastante majo y comprensible con los alumnos. \n\n"
				.$profesoresP."\n"
				.$desconocido."José Miguel Mantas Ruiz:  No hay información \n";

			}
			else if($frase[2] == "Dispositivos" | $frase[2] == 'dispositivos' | $frase[0] == 'pdm' | $frase[0] == 'PDM'){

				$respuesta = $desconocido."Programación Lúdica".$desconocido."\n\n"
				.$descripcion."\n
				No hay descripción de la asignatura \n\n"
				.$profesoresT."\n"
				.$desconocido."Marcelino J. Cabrera Cuevas: No hay informació \n\n"
				.$profesoresP."\n"
				.$desconocido."Marcelino J. Cabrera Cuevas:  No hay información \n";

			}
			else{
				$respuesta = $asignatura;
			}
			break;

		case 'Sistemas':
		case 'sistemas':
		case 'SCD':
		case 'scd':
		case 'SO':
		case 'so':
		case 'SMM':
		case 'smm':
		case 'SMP':
		case 'smp':
		case 'SIE':
		case 'sie':
		case 'SMD':
		case 'smd':
		case 'SG':
		case 'sg':
		case 'SIBW':
		case 'sibw':
		case 'SE':
		case 'se':
		case 'SIG':
		case 'sig':
		case 'SCGC':
		case 'scgc':
			if($frase[1] == "Concurrentes" | $frase[1] == 'concurrentes' | $frase[0] == 'scd' | $frase[0] == 'SCD'){

				$respuesta = $amarillo."Sistemas Concurrentes y Distribuidos".$amarillo."\n\n"
				.$profesoresT."\n"
				.$naranja."Manuel Capel Tuñón: No sabe mucho y explica algunas cosas y otras no \n"
				.$amarillo."Manuel Noguera García: No es una maravilla, a veces quiere aparentar más de lo que sabe, pero es majo y se involucra \n"
				.$desconocido."Carlos Ureña Almagro: No hay información \n"
				.$amarillo."Pedro Villar Castro: No hay información \n\n"
				.$profesoresP."\n"
				.$desconocido."Manuel Capel Tuñón: No hay información \n"
				.$rojo."Miguel Lastra Leidinger: No hay información \n"
				.$desconocido."José Miguel Mantas Ruiz: No hay información \n"
				.$desconocido."Ana Mª Sánchez López: No hay información. \n"
				.$desconocido."Carlos Ureña Almagro: No hay información \n"
				.$amarillo."Pedro Villar Castro: No hay información \n";
			}
			else if($frase[1] == "Operativos" | $frase[1] == 'operativos' | $frase[0] == 'so' | $frase[0] == 'SO'){

				$respuesta = $naranja."Sistemas Operativos".$naranja."\n\n"
				.$profesoresT."\n"
				.$desconcido."Jose Antonio Gómez Hernández: No hay información \n"
				.$naranja."Jose Luis Rodríguez Bullejos: A preguntas random, respuestas random.  Nunca dejar preguntas en blanco, con que pongas cosas que demuestres que te has mirado el temario y has comprendido algo, se puede aprobar \n"
				.$naranja."Patricia Pederewski Rodríguez: Te enteras poco en clase y exámenes duros \n"
				.$amarillo."MªAngustias Sánchez Buendía: No hay información \n\n"
				.$profesoresP."\n"
				.$desconcido."Jose Antonio Gómez Hernández: No hay información \n"
				.$naranja."Jose Luis Rodríguez Bullejos: No hay información \n"
				.$amarillo."Manuel Noguera García: No hay información \n"
				.$naranja."MªAngustias Sánchez Buendía: No hay información \n"
				.$naranja."Patricia Pederewski Rodríguez: No hay información \n";
			}
			else if($frase[1] == "Multimedia" | $frase[1] == 'multimedia' | $frase[0] == 'SMM' | $frase[0] == 'smm'){

				$respuesta = $amarillo."Sistemas Multimedia".$amarillo."\n\n"
				.$descripcion."\n
				El 100% de la nota es la realización de una práctica en JAVA,se realiza un paint, photoshop, grabadora de sonido y webcam en términos sencillos. Mucha carga de trabajo e importantísimo llevarlo al día y asistir a clases, se puede convertir en un infierno si lo dejas para el final. \n\n"
				.$profesoresT."\n"
				.$naranja."Jesús Chamorro Martínez: Profesor bueno durante el curso hasta que llega la entrega del trabajo, ahí se pone bastante estricto.  \n\n"
				.$profesoresP."\n"
				.$amarillo."Jesús Chamorro Martínez: Principalmente seguir los guiones, y modificaciones adicionales propuestas \n";

			}
			else if($frase[2] == "Microprocesadores" | $frase[2] == 'microprocesadores' | $frase[0] == 'SMP' | $frase[0] == 'smp'){

				$respuesta = $desconocido."Diseño de Sistemas Electrónicos".$desconocido."\n\n"
				.$descripcion."\n
				Teoría 10%, Prácticas 90%. Se hace durante todo el  curso un robot de sumo en grupos de hasta 3 personas.  La asignatura es muy entretenida y divertida, muy fácil sacar sobresaliente \n\n"
				.$profesoresT."\n"
				.$desconocido."Christian A. Morillas Gutiérrez: Profesor bastante bueno, la teoría es difícil de entender pero solo cuenta el 10% de la nota \n\n"
				.$profesoresP."\n"
				.$desconocido."Christian A. Morillas Gutiérrez:  El profesor te ayudará en todo lo que pueda, la realización del robot es un 90% de la nota, fácil sacar el máximo. \n";

			}
			else if($frase[4] == "Empresas" | $frase[4] == 'Empresas' | $frase[0] == 'SIE' | $frase[0] == 'sie'){

				$respuesta = $desconocido."Sistemas de Información para Empresas".$desconocido."\n\n"
				.$descripcion."\n
				No hay descripción de la asignatura \n\n"
				.$profesoresT."\n"
				.$desconocido."Buenaventura Clares Rodríguez: No hay información \n\n"
				.$profesoresP."\n"
				.$desconocido."Buenaventura Clares Rodríguez: No hay información \n";

			}
			else if($frase[1] == "Multidimensionales" | $frase[1] == 'multidimensionales' | $frase[0] == 'SMD' | $frase[0] == 'smd'){

				$respuesta = $desconocido."Sistemas Multidimensionales".$desconocido."\n\n"
				.$descripcion."\n
				No hay descripción de la asignatura \n\n"
				.$profesoresT."\n"
				.$desconocido."José Samos Jiménez: No hay información \n\n"
				.$profesoresP."\n"
				.$desconocido."José Samos Jiménez: No hay información \n";

			}
			else if($frase[1] == "Gráficos" | $frase[1] == 'gráficos' | $frase[0] == 'SG' | $frase[0] == 'sg'){

				$respuesta = $amarillo."Sistemas Gráficos".$amarillo."\n\n"
				.$descripcion."\n
				Es la continuación de IG \n\n"
				.$profesoresT."\n"
				.$amarillo."Francisco Velasco Anguita: Se implica mucho en sus explicaciones. Le gusta lo que hace, y eso se nota \n\n"
				.$profesoresP."\n"
				.$amarillo."Francisco Velasco Anguita: Las prácticas son entretenidas, la carga de trabajo moderada \n";

			}
			else if($frase[3] == "Basados" | $frase[3] == 'basados' | $frase[0] == 'SIBW' | $frase[0] == 'sibw'){

				$respuesta = $verde."Sistemas de Información Basados en Web".$verde."\n\n"
				.$descripcion."\n
				Pertenece al Tridente de asignaturas web, junto con TW y PW, aprendes programación web en HTML, CSS, PHP... \n\n"
				.$profesoresT."\n"
				.$verde."Sergio Alonso Burgos: No hay información \n\n"
				.$profesoresP."\n"
				.$verde."Sergio Alonso Burgos: Es trabajosa, pero si a Sergio le gusta tu página web, te pone nota extra. \n"
				.$desconocido."José María Guirao Miras: No hay información \n";

			}
			else if($frase[1] == "Empotrados" | $frase[1] == 'empotrados' | $frase[0] == 'SE' | $frase[0] == 'se'){
				
				$respuesta = $desconocido."Sistemas Empotrados".$desconocido."\n\n"
				.$descripcion."\n
				No hay descripción de la asignatura \n\n"
				.$profesoresT."\n"
				.$desconocido."Jesús González Peñalver: No hay información \n\n"
				.$profesoresP."\n"
				.$desconocido."Jesús González Peñalver: No hay información \n";

			}
			else if($frase[2] == "Información" | $frase[2] == 'información' | $frase[2] == "Informacion" | $frase[2] == 'informacion' | $frase[0] == 'SIG' | $frase[0] == 'sig'){
				
				$respuesta = $desconocido."Sistemas de Información Geográficos".$desconocido."\n\n"
				.$descripcion."\n
				No hay descripción de la asignatura \n\n"
				.$profesoresT."\n"
				.$desconocido."José Samos Jiménez: No hay información \n\n"
				.$profesoresP."\n"
				.$desconocido."José Samos Jiménez: No hay información \n";

			}
			else if($frase[1] == "Cooperativos" | $frase[1] == 'cooperativos' | $frase[0] == 'SCGC' | $frase[0] == 'scgc'){
				
				$respuesta = $verde."Sistemas Cooperativos y Gestión de Contenidos".$verde."\n\n"
				.$descripcion."\n
				Desarrollo de una página web en Wordpress, asignatura muy útil, entretenida y sencilla de sacar nota \n\n"
				.$profesoresT."\n"
				.$verde."Javier Melero : Buen profesor que explica bien y ayuda en todo lo que puede \n\n"
				.$profesoresP."\n"
				.$verde."Javier Melero : No hay información \n";

			}
			else{
				$respuesta = $asignatura;
			}
			break;
			

/*------------------------SEGUNDO CUATRIMESTRE--------------------*/
//Fundamentos de Bases de Datos (FBD) y Fundamentos de Ingeniería del Software (FIS) está con las asignaturasde "Fundamentos" de 1º

		case 'ALG':
		case 'alg':
		case 'Algorítmica':
		case 'Algoritmica':
		case 'algorítmica':
		case 'algoritmica':

			$respuesta = $naranja."Algorítmica".$naranja."\n\n"
			.$profesoresT."\n"
			.$amarillo."Luis Miguel de Campos Ibáñez: No hay información \n"
			.$naranja."MªTeresa Lamata Jiménez: No hay información  \n"
			.$verde."Manuel Pegalajar Cuéllar: No es que sea muy fácil, pero es significamente el que te lo va a explicar más detallado y comprensible. Sus examenes son asequibles, especialmente para lo que es Algoritmica \n"
			.$naranja."José Luis Verdegay Galdeano: No hay información  \n\n"
			.$profesoresP."\n"
			.$desconocido."Cecilia Delgado Negrete: No hay información \n"
			.$naranja."MªTeresa Lamata Jiménez: No hay información  \n"
			.$amarillo."Manuel Pegalajar Cuéllar: No hay información \n"
			.$desconocido."José Luis Verdegay Galdeano: No hay información \n";

			break;

		case 'AC':
		case 'ac':
		case 'ACAP':
		case 'acap':
		case 'AS':
		case 'as':
		case 'Arquitectura':
		case 'arquitectura':
			if($frase[2] == "Computadores" | $frase[2] == 'computadores' | $frase[0] == 'AC' | $frase[0] == 'ac'){
				$respuesta = $naranja."Arquitectura de Computadores".$naranja."\n\n"
				.$profesoresT."\n"
				.$rojo."Mancia Anguita López: Sus parciales son complejos, no explica mal, es exigente, y tiene predisposición a enseñar y hacer tutorias. Si apruebas sus parciales (no es sencillo), el final se saca sin problemas. \n"
				.$amarillo."Julio Ortega Lopera: Sus parciales son fáciles, pero quizás por exigencia o por detallado de sus explicaciones, es posible que no se llegue al nivel que luego se exige (para sacar nota) en el final, donde Mancia también pone preguntas suyas. \n\n"
				.$profesoresP."\n"
				.$desconocido."Mancia Anguita López: No hay información \n"
				.$amarillo."Christian Morillas: Explica muy bien las prácticas \n"
				.$naranja."Francisco Barranco Expósito: No hay información \n"
				.$desconocido."Julio Ortega Lopera: No hay información \n";
			}
			else if($frase[2] == "Computación" | $frase[2] == 'computación' | $frase[2] == "Computacion" | $frase[2] == 'computacion' | $frase[0] == 'ACAP' | $frase[0] == 'acap'){

				$respuesta = $desconocido."Arquitectura y Computación de Altas Prestaciones".$desconocido."\n\n"
				.$descripcion."\n
				No hay descripción de la asignatura \n\n"
				.$profesoresT."\n"
				.$desconocido."Maribel García Arenas : No hay información \n\n"
				.$profesoresP."\n"
				.$desconocido."Maribel García Arenas : No hay información \n";

			}
			else if($frase[2] == "Sistemas" | $frase[2] == 'sistemas' | $frase[0] == 'AS' | $frase[0] == 'as'){

				$respuesta = $desconocido."Arquitectura de Sistemas".$desconocido."\n\n"
				.$descripcion."\n
				No hay descripción de la asignatura \n\n"
				.$profesoresT."\n"
				.$desconocido."Gustavo Romero López: No hay información \n\n"
				.$profesoresP."\n"
				.$desconocido."Gustavo Romero López: No hay información \n";

			}
			else{
				$respuesta = $asignatura;
			}
			break;

		case 'IA':
		case 'ia':
		case 'IN':
		case 'in':
		case 'Inteligencia':
		case 'inteligencia':
			if($frase[1] == "Artificial" | $frase[1] == 'artificial' | $frase[0] == 'IA' | $frase[0] == 'ia'){
				$respuesta = $amarillo."Inteligencia Artificial".$amarillo."\n\n"
				.$profesoresT."\n"
				.$amarillo."Antonio González Muñoz: Apañado y cercano aunque un poco estricto en los exámenesn \n"
				.$amarillo."Miguel Delgado Calvo-Flores: No hay información \n\n"
				.$profesoresP."\n"
				.$desconocido."Juan Fernández Olivares: No hay información\n"
				.$amarillo."Antonio González Muñoz: No hay información\n"
				.$amarillo."Antonio González Muñoz: No hay información\n";
			}
			else if($frase[2] == "Negocio" | $frase[2] == 'negocio' | $frase[0] == 'IN' | $frase[0] == 'in'){

				$respuesta = $desconocido."Creación de Empresas y Gestión Emprendedora".$desconocido."\n\n"
				.$descripcion."\n
				No hay descripción de la asignatura \n\n"
				.$profesoresT."\n"
				.$desconocido."Dr. Francisco Herrera Triguero: No hay información \n\n"
				.$profesoresP."\n"
				.$desconocido."Dr. Francisco Herrera Triguero: No hay información \n";

			}
			else{
				$respuesta = $asignatura;
			}
			break;

/*------------------------TERCER CURSO--------------------*/
/*------------------------PRIMER CUATRIMESTRE--------------------*/

//Fundamentos de Redes (FR) está con las asignaturasde "Fundamentos" de 1º

		case 'DDSI':
		case 'ddsi':
		case 'DSE':
		case 'dse':
		case 'DIU':
		case 'diu':
		case 'Diseño':
		case 'diseño':
			if($frase[2] == "Desarrollo" | $frase[2] == 'desarrollo' | $frase[0] == 'DDSI' | $frase[0] == 'ddsi'){
				$respuesta = $verde."Diseño y Desarrollo de Sistemas de Información".$verde."\n\n"
				.$profesoresT."\n"
				.$verde."Ignacio José Blanco Medina: Explica muy bien y es fácil aprobar \n"
				.$verde."Francisco Javier Cabrerizo Lorite: Es un profesor que ayuda muchísimo al estudiante, es fácil de aprobar con él. \n"
				.$verde."Daniel Sánchez Fernández: Sus clases son un tanto aburridas, sobre todo cuando llega a la parte de álgebra relacional. En general explica bien y en tutorías resuelve las dudas con facilidad. \n"
				.$verde."Carlos Cruz Corona: No hay información \n"
				.$desconocido."María José Martín Bautista: No hay información \n\n"
				.$profesoresP."\n"
				.$verde."Ignacio José Blanco Medina: No hay información \n"
				.$desconocido."Francisco Javier Cabrerizo Lorite: Es un profesor que ayuda muchísimo al estudiante, es fácil de aprobar con él. \n"
				.$verde."Daniel Sánchez Fernández: Aunque debas esforzarte un poco para sacar buena nota, califica positivamente si nota que has trabajado y has investigado por tu cuenta en las prácticas, aunque las entregues con algún aspecto incompleto \n"
				.$verde."Carlos Cruz Corona: No hay información \n"
				.$desconocido."María José Martín Bautista: No hay información \n";
			}
			else if($frase[2] == "Sistemas" | $frase[2] == 'sistemas' | $frase[0] == 'DSE' | $frase[0] == 'dse'){

				$respuesta = $desconocido."Diseño de Sistemas Electrónicos".$desconocido."\n\n"
				.$descripcion."\n
				No hay descripción de la asignatura \n\n"
				.$profesoresT."\n"
				.$desconocido."José Luis Padilla de la Torre: No hay información \n\n"
				.$profesoresP."\n"
				.$desconocido."José Luis Padilla de la Torre: No hay información \n";

			}
			else if($frase[2] == "Interfaces" | $frase[2] == 'interfaces' | $frase[0] == 'DIU' | $frase[0] == 'diu'){

				$respuesta = $verde."Diseño de Sistemas Electrónicos".$verde."\n\n"
				.$descripcion."\n
				Asignatura famosa por su baja dificultad, las clases de teoría son interactivas con el profesor y en las prácticas realizas el diseño de una aplicación \n\n"
				.$profesoresT."\n"
				.$desconocido."Miguel Gea Megías: Explica bien la asignatura y realiza ejercicios en clase. \n\n"
				.$profesoresP."\n"
				.$desconocido."Miguel Gea Megías: Suele poner bastantes pegas. \n"
				.$desconocido."Rosana Montes Soldado: Al igual que con Miguel, Rosana pone bastantes pegas y tienes que rehacer algunas cosas \n";

			}
			else{
				$respuesta = $asignatura;
			}
			break;

		case 'IG':
		case 'ig':
		case 'II':
		case 'ii':
		case 'Informática':
		case 'informática':
		case 'Informatica':
		case 'informatica':

			if($frase[1] == "Gráfica" | $frase[1] == 'gráfica' | $frase[1] == "Grafica" | $frase[1] == 'grafica' | $frase[0] == 'IG' | $frase[0] == 'ig'){
				$respuesta = $naranja."Informática Gráfica".$naranja."\n\n"
				.$profesoresT."\n"
				.$amarillo."Javier Melero: Profesor exigente y estricto, explica muy bien y sus clases son divertidas. Necesitas esforzarte para sacar las prácticas con él, pero se aprende muchísimo. \n"
				.$rojo."Domingo Martín: Sus clases de teoría se basan en explicar las prácticas, complicado aprobar con él, puede inventarse los métodos de evaluación y no avisar, es estricto corrigiendo. \n"
				.$amarillo."Antonio López: No hay información \n\n"
				.$profesoresP."\n"
				.$amarillo."Javier Melero: Debes tener cuidado con los plazos de entrega de prácticas, sobre todo en las últimas semanas de la asignatura. Puede ser un poco ambigüo en ciertas partes del proyecto y si le preguntas puede no responderte directamente a la duda. Si te gusta la asignaturá será relativamente fácil de sacar, aunque cuidado con él en la evaluación. \n"
				.$amarillo."Domingo Martín: No hay información \n"
				.$verde."Antonio López: Si te aplicas, es muy fácil sacar nota con él. \n"
				.$desconocido."Juan Carlos Torres: No hay información \n";
			}
			else if($frase[1] == "Industrial" | $frase[1] == 'industrial' | $frase[0] == 'ii' | $frase[0] == 'II'){

				$respuesta = $desconocido."Informática Industrial".$desconocido."\n\n"
				.$descripcion."\n
				No hay descripción de la asignatura \n\n"
				.$profesoresT."\n"
				.$desconocido."Miguel Damas Hermoso: No hay información \n\n"
				.$profesoresP."\n"
				.$desconocido."Miguel Damas Hermoso: No hay información \n";

			}
			else{
				$respuesta = $asignatura;
			}
			break;
			break;

		case 'ISE':
		case 'ise':
		case 'IC':
		case 'ic':
		case 'ISI':
		case 'isi':
		case 'Ingeniería':
		case 'ingeniería':
		case 'Ingenieria':
		case 'ingenieria':
			if($frase[2] == "Servidores" | $frase[2] == 'servidores' | $frase[0] == 'ise' | $frase[0] == 'ISE'){
				$respuesta = $naranja."Ingeniería de Servidores".$naranja."\n\n"
				.$profesoresT."\n"
				.$naranja."Héctor Pomares Cintas: Profesor exigente y estricto, explica muy bien pero es una asignatura en la que se atascan muchísimos alumnos por su gran densidad de contenido, además que el mínimo del 5 complica las cosas. \n\n"
				.$profesoresP."\n"
				.$rojo."David Palomar Sáez: Va muy rápido, se hace complicado entender lo que está haciendo y copiar los comandos a la vez. Para el trabajo autónomo es bastante estricto\n"
				.$amarillo."Alberto Guillén Perales: No hay información\n";
			}
			else if($frase[2] == "Conocimiento" | $frase[2] == 'conocimiento' | $frase[0] == 'ic' | $frase[0] == 'IC'){

				$respuesta = $amarillo."Ingeniería del Conocimiento".$amarillo."\n\n"
				.$descripcion."\n
				2 prácticas: 1ª Ejercicios y 2ª Sistema con razonamiento automático \n\n"
				.$profesoresT."\n"
				.$verde."Juan Luis Castro Peña: El contenido no es muy complicado y el profesor explica bien \n\n"
				.$profesoresP."\n"
				.$desconocido."Juan Luis Castro Peña: No hay información \n";
				
			}
			else if($frase[2] == "Sistemas" | $frase[2] == 'sistemas' | $frase[0] == 'isi' | $frase[0] == 'ISI'){
				$respuesta = $desconocido."Ingeniería de Sistemas de Información".$desconocido."\n\n"
				.$descripcion."\n
				No hay descripción de la asignatura \n\n"
				.$profesoresT."\n"
				.$naranja."Fernando Berzal Galiano: No hay información \n\n"
				.$profesoresP."\n"
				.$desconocido."Fernando Berzal Galiano: No hay información \n";
			}
			else{
				$respuesta = $asignatura;
			}

			break;

		case 'MC':
		case 'mc':
		case 'MCA':
		case 'mca':
		case 'Modelos':
		case 'modelos':
			if($frase[2] == "Computación" | $frase[2] == 'computación' | $frase[0] == 'mc' | $frase[0] == 'MC'){
				$respuesta = $amarillo."Modelos de Computación".$amarillo."\n\n"
				.$profesoresT."\n"
				.$azul."José Antonio García Soria: Profesor simpático y apañado, es difícil suspender. Si lo que buscas es aprender, con este profesor no se aprende mucho y puedes tener muchas dificultades en MAC (rama de CSI). \n"
				.$desconocido."Miguel Angel Rubio Escudero: No hay información \n"
				.$desconocido."Gabriel Navarro Garulo: No hay información \n\n"
				.$profesoresP."\n"
				.$verde."José Antonio García Soria: Echándole un ratillo a tutoriales en Youtube apruebas. (y sin ellos también) \n"
				.$desconocido."Miguel Angel Rubio Escudero: No hay información \n"
				.$desconocido."Gabriel Navarro Garulo: No hay información \n";
			}
			else if($frase[3] == "Avanzados" | $frase[3] == 'avanzados' | $frase[0] == 'mca' | $frase[0] == 'MCA'){

				$respuesta = $naranja."Modelos de Computación Avanzados".$naranja."\n\n"
				.$descripcion."\n
				No hay descripción de la asignatura \n\n"
				.$profesoresT."\n"
				.$naranja."Serafín Moral Callejón: Tienes que estudiar muchísimo para poder comprender qué está ocurriendo en esa asignatura \n\n"
				.$profesoresP."\n"
				.$desconocido."Serafín Moral Callejón: No hay información \n"
				.$desconocido."Juan Luis Castro Peña: No hay información \n";
				
			}
			else{
				$respuesta = $asignatura;
			}
			break;

/*------------------------SEGUNDO CUATRIMESTRE--------------------*/
/*------------------------RAMA DE COMPUTACIÓN Y SISTEMAS INTELIGENTES (CSI)--------------------*/

//Ingeniería del Conocimiento (IC) está con las asignaturas de "Ingeniería" de 3º, Modelos de Computación Avanzados (MCA) está con MC en 3º
		case 'AA':
		case 'aa':
		case 'Aprendizaje':
		case 'aprendizaje':

			$respuesta = $naranja."Aprendizaje Automático".$naranja."\n\n"
			.$descripcion."\n
			No hay descripción de la asignatura \n\n"
			.$profesoresT."\n"
			.$verde."Nicolás Pérez de la Blanca Capilla: Con este profesor se hace insufrible, pone unos tests que son demasiado complicados \n\n"
			.$profesoresP."\n"
			.$verde."Nicolás Pérez de la Blanca Capilla: No hay información \n";

			break;

		case 'mh':
		case 'MH':
		case 'Metaheurísticas':
		case 'Metaheuristicas':
		case 'metaheurísticas':
		case 'metaheuristicas':

			$respuesta = $verde."Metaheurísticas".$verde."\n\n"
			.$descripcion."\n
			No hay descripción de la asignatura \n\n"
			.$profesoresT."\n"
			.$verde."Francisco Herrera Triguero: No hay información \n\n"
			.$profesoresP."\n"
			.$desconocido."Daniel Molina Cabrera: No hay información \n"
			.$verde."Óscar Cordón:  \n"
			.$desconocido."Francisco Herrera Triguero: No hay información \n";

			break;

		case 'TSI':
		case 'tsi':
		case 'Técnicas':
		case 'Tecnicas':
		case 'técnicas':
		case 'tecnicas':

			$respuesta = $amarillo."Técnicas de los Sistemas Inteligentes".$amarillo."\n\n"
			.$descripcion."\n
			Es la continuación de IA. Es monótona pero no muy dificil \n\n"
			.$profesoresT."\n"
			.$amarillo."Antonio González Muñoz: No hay información \n\n"
			.$profesoresP."\n"
			.$desconocido."Antonio González Muñoz: No hay información \n";

			break;
		case 'AA':
		case 'aa':
		case 'Aprendizaje':
		case 'aprendizaje':

			$respuesta = $naranja."Aprendizaje Automático".$naranja."\n\n"
			.$descripcion."\n
			No hay descripción de la asignatura \n\n"
			.$profesoresT."\n"
			.$verde."Nicolás Pérez de la Blanca Capilla: Con este profesor se hace insufrible, pone unos tests que son demasiado complicados \n\n"
			.$profesoresP."\n"
			.$verde."Nicolás Pérez de la Blanca Capilla: No hay información \n";

			break;

		case 'mh':
		case 'MH':
		case 'Metaheurísticas':
		case 'Metaheuristicas':
		case 'metaheurísticas':
		case 'metaheuristicas':

			$respuesta = $verde."Metaheurísticas".$verde."\n\n"
			.$descripcion."\n
			No hay descripción de la asignatura \n\n"
			.$profesoresT."\n"
			.$verde."Francisco Herrera Triguero: No hay información \n\n"
			.$profesoresP."\n"
			.$desconocido."Daniel Molina Cabrera: No hay información \n"
			.$verde."Óscar Cordón:  \n"
			.$desconocido."Francisco Herrera Triguero: No hay información \n";

			break;

		case 'TSI':
		case 'tsi':
		case 'Técnicas':
		case 'Tecnicas':
		case 'técnicas':
		case 'tecnicas':

			$respuesta = $amarillo."Técnicas de los Sistemas Inteligentes".$amarillo."\n\n"
			.$descripcion."\n
			Es la continuación de IA. Es monótona pero no muy dificil \n\n"
			.$profesoresT."\n"
			.$amarillo."Antonio González Muñoz: No hay información \n\n"
			.$profesoresP."\n"
			.$desconocido."Antonio González Muñoz: No hay información \n";

			break;

/*------------------------RAMA DE TECNOLOGÍAS DE LA INFORMACIÓN (TI)--------------------*/

//Sistemas Multimedia (SMM) está con las asignaturas de "Sistemas" de 2º

		case 'CUIA':
		case 'cuia':
		case 'Computación':
		case 'computación':
		case 'Computacion':
		case 'computacion':
			$respuesta = $verde."Computación Ubicua e Inteligencia Ambiental".$verde."\n\n"
			.$descripcion."\n
			En la teoría se suelen hacer clases donde participen los alumnos son amenas y entretenidas, en las prácticas se realiza una app de realidad aumentada, la dificultad reside en tener que buscarte la vida aunque algo de ayuda tienes del profesor \n\n"
			.$profesoresT."\n"
			.$verde."Antonio Bautista Bailón Morillas: Profesor majo y simpático, lo verás en cada clase con una camiseta friki distinta. Hace las clases amenas. Suele ir diciendo a que cosas hacer incapie de cara al examen final, el cual no es muy sencillo... \n\n"
			.$profesoresP."\n"
			.$amarillo."Antonio Bautista Bailón Morillas: Te tienes que buscar un poco la vida para hacer la APP aunque Antonio te ayuda en lo que puede \n";

			break;

		case 'SWAP':
		case 'swap':
		case 'Servidores':
		case 'servidores':

			$respuesta = $azul."Servidores Web de Altas Prestaciones".$azul."\n\n"
			.$descripcion."\n
			Continuación espiritual de ISE, pero infinitamente más sencilla,  clases de teoría sencillas y realizar una exposición de gran peso en la nota. Las prácticas son como las de ISE pero mucho más sencillas y fáciles. Sobresaliente fácil. \n\n"
			.$profesoresT."\n"
			.$azul."José Manuel Soto Hidalgo: Muy buen profesor y apañado, hace de esta una de las asignaturas más fáciles de la carrera. \n\n"
			.$profesoresP."\n"
			.$azul."José Manuel Soto Hidalgo: Es simplemente seguir un guión en las practicas, muy fácil.  \n";


			break;

		case 'TW':
		case 'tw':
		case 'TR':
		case 'tr':
		case 'TE':
		case 'te':
		case 'Tecnologías':
		case 'tecnologías':
		case 'Tecnologias':
		case 'tecnologias':
			if($frase[1] == "Web" | $frase[1] == 'web' | $frase[0] == 'TW' | $frase[0] == 'tw'){
				$respuesta = $amarillo."Tecnologías Web".$amarillo."\n\n"
				.$descripcion."\n
				Asignatura idéntica a PW y SIBW, aprendizaje del desarrollo web con HTML, CSS, PHP y JAVASCRIPT, en las prácticas se  realizan sencillas páginas webs y habrá un proyecto o dos  durante el curso de páginas web completas. \n\n"
				.$profesoresT."\n"
				.$amarillo."Javier Martínez Baena: Explica bien pero es estricto en los exámenes  \n\n"
				.$profesoresP."\n"
				.$amarillo."Javier Martínez Baena: No hay información \n";
			}
			else if($frase[2] == "Red" | $frase[2] == 'red' | $frase[0] == 'TR' | $frase[0] == 'tr'){

				$respuesta = $desconocido."Tecnologías de Red".$desconocido."\n\n"
				.$descripcion."\n
				No hay descripción de la asignatura \n\n"
				.$profesoresT."\n"
				.$desconocido."Jesús E. Díaz Verdejo: No hay información \n\n"
				.$profesoresP."\n"
				.$desconocido."Jesús E. Díaz Verdejo: No hay información \n";

			}
			else if($frase[1] == "Emergentes" | $frase[1] == 'emergentes' | $frase[0] == 'TE' | $frase[0] == 'te'){

				$respuesta = $desconocido."Tecnologías Emergentes".$desconocido."\n\n"
				.$descripcion."\n
				No hay descripción de la asignatura \n\n"
				.$profesoresT."\n"
				.$desconocido."Samuel Fco. Romero García: No hay información \n\n"
				.$profesoresP."\n"
				.$desconocido."Samuel Fco. Romero García: No hay información \n";
			}
			else{
				$respuesta = $asignatura;
			}
			break;

		case 'TDRC':
		case 'tdrc':
		case 'Transmisión':
		case 'transmisión':

			$respuesta = $naranja."Transmisión de Datos y Redes de Computadores".$naranja."\n\n"
			.$descripcion."\n
			Continuación de FR, se siguen dando todo lo relacionado con  redes pero de forma más completa. En las prácticas se realizan cosas similares a FR. Hay que llevarla al día y hacer muchos  ejercicios de cara al examen de teoría \n\n"
			.$profesoresT."\n"
			.$amarillo."Antonio Mora García: Explica bien y es poco estricto  \n\n"
			.$profesoresP."\n"
			.$amarillo."Miguel Ángel López Gordo: No hay información \n";

			break;

/*------------------------RAMA DE INGENIERÍA DE COMPUTADORES (IC)--------------------*/

//ACAP y AS está con las asignaturas de "Arquitectura" de 2º, DSE está con las asignaturas de "Diseño" en 3º, SMP está con las asignaturas "Sistemas" de 2º

		case 'DHD':
		case 'dhd':
		case 'DS':
		case 'ds':
		case 'DSD':
		case 'dsd':
		case 'DBA':
		case 'dba':
		case 'DAI':
		case 'dai':
		case 'Desarrollo':
		case 'desarrollo':
			if($frase[2] == "Hardware" | $frase[2] == 'hardware' | $frase[0] == 'DHD' | $frase[0] == 'dhd'){

				$respuesta = $desconocido."Desarrollo de Hardware Digital".$desconocido."\n\n"
				.$descripcion."\n
				No hay descripción de la asignatura \n\n"
				.$profesoresT."\n"
				.$desconocido."Begoña del Pino Prieto: No hay información \n\n"
				.$profesoresP."\n"
				.$desconocido."Begoña del Pino Prieto: No hay información \n";
			}
			else if($frase[2] == "Software" | $frase[2] == 'software' | $frase[0] == 'DS' | $frase[0] == 'ds'){

				$respuesta = $naranja."Desarrollo de Software".$naranja."\n\n"
				.$descripcion."\n
				Una de las asignaturas más importantes de la rama, lástima que haya caido en malas manos. Se estudian patrones de diseño y conceptos de planificación y diseño \n\n"
				.$profesoresT."\n"
				.$naranja."María del Mar Abad Grau: No tiene ni idea, y no lo disimula, lo dice sin reparo en clase \n\n"
				.$profesoresP."\n"
				.$naranja."María del Mar Abad Grau: No sabe muy bien de la asignatura y te dice que busques en foros. \n";

			}
			else if($frase[2] == "Sistemas" | $frase[2] == 'sistemas' | $frase[0] == 'DSD' | $frase[0] == 'dsd'){

				$respuesta = $amarillo."Desarrollo de Sistemas Distribuidos".$amarillo."\n\n"
				.$descripcion."\n
				No hay descripción de la asignatura \n\n"
				.$profesoresT."\n"
				.$amarillo."Jose Luis García Bullejos: Debes estudiar del libro bien. No hace falta estudiar mucho, la evaluación se basa mucho en trabajos cortos que entregas en lugar de examenes. \n\n"
				.$profesoresP."\n"
				.$desconocido."Jose Luis García Bullejos: No hay información \n"
				.$desconocido."Francisco Carranza García: No hay información \n";

			}
			else if($frase[2] == "Basado" | $frase[2] == 'basado' | $frase[0] == 'DBA' | $frase[0] == 'dba'){

				$respuesta = $amarillo."Desarrollo Basado en Agentes".$amarillo."\n\n"
				.$descripcion."\n
				No hay descripción de la asignatura \n\n"
				.$profesoresT."\n"
				.$amarillo."Luis Castillo Vidal: Examen con apuntes, debes saber lo que haces. Prácticas en equipo, se puede aprobar con las prácticas pero hay que echarle muchas horas. \n\n"
				.$profesoresP."\n"
				.$desconocido."Luis Castillo Vidal: No hay información \n";

			}
			else if($frase[2] == "Aplicaciones" | $frase[2] == 'aplicaciones' | $frase[0] == 'DAI' | $frase[0] == 'dai'){

				$respuesta = $verde."Desarrollo de Aplicaciones para Internet".$verde."\n\n"
				.$descripcion."\n
				No hay descripción de la asignatura \n\n"
				.$profesoresT."\n"
				.$verde."José Mª Guirao Miras: Las explicaciones son claras, aunque resultan un poco monótonas. Las prácticas son muy asequibles y el examen final no es difícil, aunque conseguir muy buena nota puede serlo. \n\n"
				.$profesoresP."\n"
				.$desconocido."José Mª Guirao Miras: No hay información \n";

			}
			else{
				$respuesta = $asignatura;
			}
			

			break;

/*------------------------RAMA DE SISTEMAS DE INFORMACIÓN (TI)--------------------*/

//Ingeniería de Servidores (ISI) está con las asignaturas de "Ingeniería" de 3º, Programación Web (PW) está con las asignaturas de "Programación" de 2, SIE y SMD está con "Sitemas" de 2º

		case 'ABD':
		case 'abd':
		case 'Administración':
		case 'administración':
		case 'Administracion':
		case 'administracion':

			$respuesta = $verde."Administración de Bases de Datos".$verde."\n\n"
			.$descripcion."\n
			Es la continuación de FBD, un poco liosa pero sencilla de aprobar \n\n"
			.$profesoresT."\n"
			.$desconocido."Ignacio José Blanco Medina: El profesor sabe mucho del tema, explica muy bien y se preocupa por sus explicaciones. Hay muchos ejercicios de ev.continua que ayudan mucho a aprobar la asignatura. \n\n"
			.$profesoresP."\n"
			.$desconocido."Ignacio José Blanco Medina: No hay información \n"
			.$amarillo."Antonio Gabriel López Herrera: No hay información \n";

			break;

/*------------------------RAMA DE TECNOLOGÍAS DE LA INFORMACIÓN (TI)--------------------*/

// DS y DSD están con la asignatura "Desarrollo" de 3º rama IC, DIU está con las asignaturas "Diseño" de 3º, SG y SIBW está con las asignaturas "Sistemas" de 2º


/*------------------------CUARTO CURSO--------------------*/
/*------------------------PRIMER CUATRIMESTRE--------------------*/
/*------------------------RAMA DE COMPUTACIÓN Y SISTEMAS INTELIGENTES (CSI)--------------------*/

//Programación Técnica y Científica (PTC) está con las asignaturas de "Programación" de 2º

		case 'VC':
		case 'vc':
		case 'Visión':
		case 'Vision':
		case 'visión':
		case 'vision':


			$respuesta = $rojo."Visión por Computador".$rojo."\n\n"
			.$descripcion."\n
			Redes Neuronales para reconocer cosas en imágenes, básicamente. La teoría es densa e igual es más idónea para el que esté haciendo el doble grado con mates. Hay muchas matemáticas, más te vale tener ALEM fresca. Las prácticas son aprender OpenCV y programar redes neuronales con Keras. \n\n"
			.$profesoresT."\n"
			.$rojo."Nicolás Pérez de la Blanca Capilla: Pone cuestionarios y exámenes muy duros, nada flexible en las correciones y hace que la asignatura se complique. Si te apasionan las redes neuronales adelante, si no te llaman especialmente, no te metas. Lo bueno es que sales con conocimientos suficientes para montar sistemas inteligentes que funcionen sobre imágenes o vídeo, el que eso merezca la pena o no depende de ti. \n\n"
			.$profesoresP."\n"
			.$desconocido."Nicolás Pérez de la Blanca Capilla: No hay información \n";

			break;

		case 'NPI':
		case 'npi':
		case 'Nuevos':
		case 'nuevos':

			$respuesta = $naranja."Nuevos Paradigmas de Interacción".$naranja."\n\n"
			.$descripcion."\n
			Se hace una app de Android desde 0 \n\n"
			.$profesoresT."\n"
			.$naranja."Marcelino J. Cabrera Cuevas: No recomendable este profesor \n\n"
			.$profesoresP."\n"
			.$desconocido."Marcelino J. Cabrera Cuevas: No hay información \n";

			break;

		case 'PL':
		case 'pl':
		case 'Procesadores':
		case 'procesadores':

			$respuesta = $amarillo."Procesadores de Lenguajes".$amarillo."\n\n"
			.$descripcion."\n
			Asignatura sencilla, se puede aprobar con las prácticas \n\n"
			.$profesoresT."\n"
			.$naranja."Salvador: Salvador hace la teoría difícil, pero el de prácticas se vuelve fácil \n\n"
			.$profesoresP."\n"
			.$amarillo."Ramón López-Cózar Delgado: No hay información \n";

			break;

		case 'TIC':
		case 'tic':
		case 'Teoría':
		case 'Teoria':
		case 'teoría':
		case 'teoria':

			$respuesta = $azul."Teoría de la Información y la Codificación".$azul."\n\n"
			.$descripcion."\n
			No hay descripción de la asignatura \n\n"
			.$profesoresT."\n"
			.$azul."Manuel Pegalajar Cuéllar: Explica bien y el material es claro \n\n"
			.$profesoresP."\n"
			.$desconocido."Manuel Pegalajar Cuéllar: No hay información \n";

			break;

		case 'SS':
		case 'ss':
		case 'Simulación':
		case 'simulación':
		case 'Simulacion':
		case 'simulacion':

			$respuesta = $azul."Simulación de Sistemas".$azul."\n\n"
			.$descripcion."\n
			Hay que hacer al menos 4 prácticas, si las apruebas con nota no haces examen \n\n"
			.$profesoresT."\n"
			.$desconocido."Luis M. de Campos Ibáñez: No hay información \n\n"
			.$profesoresP."\n"
			.$desconocido."Luis M. de Campos Ibáñez: No hay información \n";

			break;
/*------------------------RAMA DE COMPUTACIÓN Y SISTEMAS INTELIGENTES (CSI)--------------------*/

//DBA está con las asignaturas de "Desarrollo" de la rama de IC de 3º, LP está con Lógica en 1º, Programación Gráfica de Videojuegos (PGV) está con las asignaturas de "Programación" de 2º

		case 'DGP':
		case 'dgp':
		case 'Dirección':
		case 'dirección':
		case 'Direccion':
		case 'direccion':

			$respuesta = $verde."Dirección y Gestión de Poyectos".$verde."\n\n"
			.$descripcion."\n
			No tiene examenes. Solo la entrega de una práctica final (y sucesivos informes durante el curso) y actividades grupales sencillas hechas en las horas de teoria \n\n"
			.$profesoresT."\n"
			.$verde."M.ª José Rodríguez Fórtiz: No hay información \n\n"
			.$profesoresP."\n"
			.$desconocido."M.ª José Rodríguez Fórtiz: No hay información \n";

			break;

		case 'MDA':
		case 'mda':
		case 'Metodologías':
		case 'Metodologias':
		case 'metodologías':
		case 'metodologias':

			$respuesta = $verde."Metodologías de Desarrollo Ágil".$verde."\n\n"
			.$descripcion."\n
			Atendiendo en clase y haciendo las actividades que manda se aprueba fácil \n\n"
			.$profesoresT."\n"
			.$verde."María Luisa Rodríguez Almendros : No hay información \n\n"
			.$profesoresP."\n"
			.$desconocido."María Luisa Rodríguez Almendros : No hay información \n";

			break;

		case 'SSO':
		case 'sso':
		case 'Seguridad':
		case 'seguridad':

			$respuesta = $verde."Seguridad en Sistemas Operativos".$verde."\n\n"
			.$descripcion."\n
			La teoría es un poco divulgación sobre seguridad informática, no es difícil. Las prácticas están más interesantes, se analizan virus y se aprende a hacer análisis de seguridad, análisis de volcados de memoria, etc. Se hace un trabajo grupal con su respectiva exposición de temática prácticamente libre.  \n\n"
			.$profesoresT."\n"
			.$desconocido."José Antonio Gómez Hernández: Profesor bonachón, sabe mucho pero no tiene mucho interés (parece), las prácticas están anticuadas (software que no funciona con versiones modernas de linux y tal). Nadie suele suspender. Los alumnos se hacen correcciones mutuas que cuentan para nota y parece ser que se valora solo el número de prácticas entregadas, no el que estén bien o mal. Exámenes exigentes pero que no cuentan mucho para nota. \n\n"
			.$profesoresP."\n"
			.$desconocido."José Antonio Gómez Hernández: No hay información \n";

			break;

/*------------------------RAMA DE INGENIERÍA DE COMPUTADORES (IC)--------------------*/
//Sistemas Empotrados (SE) está con las asignaturas de "Sistemas" de 2º, TR y TE está con las asignaturas de "Tecnologías" de la rama de TI de 3º, II está con la asignatura de "Informática" de 3º

		case 'CPD':
		case 'cpd':
		case 'Centros':
		case 'centros':

			$respuesta = $verde."Centros de Procesamiento de Datos".$verde."\n\n"
			.$descripcion."\n
			Continuación espiritual de SWAP, las prácticas son casi idénticas a SWAP y la teoría un poco aburrida, fácil sacar notable para arriba. \n\n"
			.$profesoresT."\n"
			.$azul."Antonio F. Díaz García: Profesor muy majo que explica bien tanto teoría como prácticas. Muy sencillo aprobar con él sacando buena nota. \n\n"
			.$profesoresP."\n"
			.$azul."Antonio F. Díaz García: No hay información \n";

		 	break;

/*------------------------RAMA DE SISTEMAS DE INFORMACIÓN (SI)--------------------*/
//IN está con las asignaturas de "Inteligencia" de 2º, SIG está con las asignaturas de "Sistemas" de 2º



		case 'BDD':
		case 'bdd':
		case 'Bases':
		case 'bases':

			$respuesta = $desconocido."Bases de Datos Distribuidas".$desconocido."\n\n"
			.$descripcion."\n
			No hay descripción de la asignatura \n\n"
			.$profesoresT."\n"
			.$desconocido."Cecilia Delgado Negrete: No hay información \n\n"
			.$profesoresP."\n"
			.$desconocido."Cecilia Delgado Negrete: No hay información \n";

			break;

		case 'RI':
		case 'ri':
		case 'Recuperación':
		case 'recuperación':
		case 'Recuperacion':
		case 'recuperacion':

			$respuesta = $desconocido."Recuperación de Información".$desconocido."\n\n"
			.$descripcion."\n
			No hay descripción de la asignatura \n\n"
			.$profesoresT."\n"
			.$desconocido."Juan F. Huete Guadix: No hay información \n\n"
			.$profesoresP."\n"
			.$desconocido."Juan F. Huete Guadix: No hay información \n";

			break;

		case 'GRD':
		case 'grd':
		case 'Gestión':
		case 'gestión':
		case 'Gestion':
		case 'gestion':

			$respuesta = $verde."Gestión de Recursos Digitales".$verde."\n\n"
			.$descripcion."\n
			Desarrollo de una biblioteca digital, muy fácil de aprobar y sacar nota. Se realizan actividades en grupo un tanto raras pero curiosas. \n\n"
			.$profesoresT."\n"
			.$verde."Juan Manuel Luna Fernández: Explica bien y se implica en lo que dice \n\n"
			.$profesoresP."\n"
			.$desconocido."Juan Manuel Luna Fernández: No hay información \n";

			break;

		case 'RSC':
		case 'rsc':
		case 'RMS':
		case 'rms':
		case 'Redes':
		case 'redes':
			if($frase[2] == "Sistemas" | $frase[2] == 'sistemas' | $frase[0] == 'RSC' | $frase[0] == 'rsc'){

				$respuesta = $azul."Redes y Sistemas Complejos".$azul."\n\n"
				.$descripcion."\n
				El profesor explica demasiado bien y te motiva mucho para trabajar. La asignatura a simple vista no parece muy interesante, pero puedes llevarte una sorpresa. El temario es sencillo de asimilar y de aprobar \n\n"
				.$profesoresT."\n"
				.$azul."Oscar Cordón García: No hay información \n\n"
				.$profesoresP."\n"
				.$desconocido."Oscar Cordón García: No hay información \n";

			}
			else if($frase[1] == "Multiservicio" | $frase[1] == 'multiservicio' | $frase[0] == 'RMS' | $frase[0] == 'rms'){

				$respuesta = $verde."Redes Multiservicio".$verde."\n\n"
				.$descripcion."\n
				Se puede cusar sin haber dado TR, se hacen trabajos y a veces sube nota si vas a charlas y haces resúmenes \n\n"
				.$profesoresT."\n"
				.$verde."Juan José Ramos Muñoz: En clase el profesor es genial, explica todo super claro con ejemplos muy simple y anima a participar mucho. \n\n"
				.$profesoresP."\n"
				.$verde."Juan José Ramos Muñoz: No hay información \n";

			}
			else{
				$respuesta = $asignatura;
			}
			break;

/*------------------------RAMA DE TECNOLOGÍAS DE LA INFORMACIÓN (TI)--------------------*/
//DAI está con las asignaturas de "Desarrollo" de la ramad e IC de 3º

		case 'IV':
		case 'iv':
		case 'Infraestructura':
		case 'infraestructura':

			$respuesta = $desconocido."Infraestructura Virtual".$desconocido."\n\n"
			.$descripcion."\n
			No hay descripción de la asignatura \n\n"
			.$profesoresT."\n"
			.$desconocido."Juan Julián Merelo Guervós: No hay información \n\n"
			.$profesoresP."\n"
			.$desconocido."Juan Julián Merelo Guervós: No hay información \n";

			break;

		case 'SPSI':
		case 'spsi':
		case 'Seguridad':
		case 'seguridad':

			$respuesta = $amarillo."Seguridad y Protección de Sistemas Informáticos".$amarillo."\n\n"
			.$descripcion."\n
			Asignatura sobre seguridad, donde en teoría se dan las matemáticas en los algoritmos de cifrado y en prácticas se ven dichos algoritmos. Prácticas fáciles de aprobar, teoría un poco más complicada. \n\n"
			.$profesoresT."\n"
			.$amarillo."Francisco García Olmedo: Es un profesor de matemáticas por lo que explica bien la teoría en cuanto a algoritmos de cifrado, en las prácticas le cuesta más explicar. Fácil aprobar con él.n \n\n"
			.$profesoresP."\n"
			.$verde."Francisco García Olmedo: No hay información \n";

			break;

		case 'CRIM':
		case 'crim':
		case 'Compresión':
		case 'compresión':
		case 'Compresion':
		case 'compresion':

			$respuesta = $desconocido."Compresión y Recuperación de Información Multimedia".$desconocido."\n\n"
			.$descripcion."\n
			No hay descripción de la asignatura \n\n"
			.$profesoresT."\n"
			.$desconocido."Rafael Molina Soriano: No hay información \n\n"
			.$profesoresP."\n"
			.$desconocido."Rafael Molina Soriano: No hay información \n";

			break;

		case 'TID':
		case 'tid':
		case 'Tratamiento':
		case 'tratamiento':

			$respuesta = $desconocido."Tratamiento de Imágenes Digitales".$desconocido."\n\n"
			.$descripcion."\n
			No hay descripción de la asignatura \n\n"
			.$profesoresT."\n"
			.$desconocido."Rafael Molina Soriano: No hay información \n\n"
			.$profesoresP."\n"
			.$desconocido."Rafael Molina Soriano: No hay información \n";

			break;

/*------------------------SEGUNDO CUATRIMESTRE--------------------*/
/*------------------------ASIGNATURAS COMUNES--------------------*/

		case 'EISI':
		case 'eisi':
		case 'Ética':
		case 'Etica':
		case 'ética':
		case 'etica':

			$respuesta = $azul."Ética, Informática y Sociedad de la Información".$azul."\n\n"
			.$descripcion."\n
			Se leen textos filosóficos centrados en el concepto de la moral y se filosofa al respecto \n\n"
			.$profesoresT."\n"
			.$azul."Mª Angustias Sánchez Buendía: La asignatura es un cachondeo, con tal de que filosofes un poco y vayas a clase la tienes aprobada \n\n"
			.$profesoresP."\n"
			.$desconocido."Mª del Mar Abad Grau: No hay información \n";


			break;

		case 'CEGE':
		case 'cege':
		case 'Creación':
		case 'creación':
		case 'Creacion':
		case 'creacion':

			$respuesta = $desconocido."Creación de Empresas y Gestión Emprendedora".$desconocido."\n\n"
			.$descripcion."\n
			No hay descripción de la asignatura \n\n"
			.$profesoresT."\n"
			.$desconocido."Francisco López Martín: No hay información \n\n"
			.$profesoresP."\n"
			.$desconocido."Lázaro Rodríguez Ariza: No hay información \n";

			break;

		case 'DI':
		case 'di':
		case 'Derecho':
		case 'derecho':

			$respuesta = $desconocido."Derecho Informático".$desconocido."\n\n"
			.$descripcion."\n
			No hay descripción de la asignatura \n\n"
			.$profesoresT."\n"
			.$desconocido."Concha Sánchez Salas: No hay información \n\n"
			.$profesoresP."\n"
			.$desconocido."Concha Sánchez Salas: No hay información \n";

			break;

/*------------------------RAMA DE COMPUTACIÓN Y SISTEMAS INTELIGENTES (CSI)--------------------*/
//PLD está con las asignaturas de "Programación" de 2º

		case 'CRIP':
		case 'crip':
		case 'Criptografía':
		case 'criptografía':
		case 'Criptografia':
		case 'criptografia':

			$respuesta = $desconocido."Criptografía y Computación".$desconocido."\n\n"
			.$descripcion."\n
			No hay descripción de la asignatura \n\n"
			.$profesoresT."\n"
			.$desconocido."Jesús García Miranda: No hay información \n\n"
			.$profesoresP."\n"
			.$desconocido."Jesús García Miranda: No hay información \n";

			break;

		case 'RI':
		case 'ri':
		case 'Robótica':
		case 'robótica':
		case 'Robotica':
		case 'robotica':

			$respuesta = $desconocido."Robótica Industrial".$desconocido."\n\n"
			.$descripcion."\n
			No hay descripción de la asignatura \n\n"
			.$profesoresT."\n"
			.$desconocido."Fermín Segovia Román: No hay información \n\n"
			.$profesoresP."\n"
			.$desconocido."Fermín Segovia Román: No hay información \n";

			break;

/*------------------------RAMA DE INGENIERÍA DEL SOFTWARE (IS)--------------------*/
//PPR está con las asignaturas de "Programación" de 2º

		case 'AO':
		case 'ao':
		case 'Animación':
		case 'animación':
		case 'Animacion':
		case 'animacion':

			$respuesta = $verde."Animación por Ordenador".$verde."\n\n"
			.$descripcion."\n
			Asignatura fácil, solo hay que echarle unas horas a las prácticas para aprobar. \n\n"
			.$profesoresT."\n"
			.$verde."Pedro Cano Olivares: No hay información \n\n"
			.$profesoresP."\n"
			.$desconocido."Pedro Cano Olivares: No hay información \n";

			break;

		case 'NTP':
		case 'ntp':
		case 'Nuevas':
		case 'nuevas':

			$respuesta = $desconocido."Nuevas Tecnologías de la Programación".$desconocido."\n\n"
			.$descripcion."\n
			No hay descripción de la asignatura \n\n"
			.$profesoresT."\n"
			.$desconocido."Manuel Gómez Olmedo: No hay información \n\n"
			.$profesoresP."\n"
			.$desconocido."Manuel Gómez Olmedo: No hay información \n";

			break;


/*------------------------RAMA DE INGENIERÍA DEL COMPUTADORES (IC)--------------------*/


		case 'CII':
		case 'cii':
		case 'Circuitos':
		case 'circuitos':

			$respuesta = $desconocido."Circuitos Integrados e Impresos".$desconocido."\n\n"
			.$descripcion."\n
			No hay descripción de la asignatura \n\n"
			.$profesoresT."\n"
			.$desconodido."Pedro García Fernández: No hay información \n\n"
			.$profesoresP."\n"
			.$desconocido."Pedro García Fernández: No hay información \n";

			break;

		case 'MEI':
		case 'mei':
		case 'Mantenimiento':
		case 'mantenimiento':

			$respuesta = $azul."Mantenimiento de Equipos Informáticos".$azul."\n\n"
			.$descripcion."\n
			Aprendes a desmontar un ordenador, a usar programas de análisis del PC, etc. Teoría aburrida pero fácil sacar nota. \n\n"
			.$profesoresT."\n"
			.$desconocido." Carlos Navarro Moralo: El profesor explica muy bien la asignatura y es comprensible con el alumnado. No te regala la asignatura, pero con las explicaciones que da en clase, es muy fácil aprobar. \n\n"
			.$profesoresP."\n"
			.$desconocido." Carlos Navarro Moral: No hay información \n";

			break;

/*------------------------RAMA DE SISTEMAS DE INFORMACIÓN (SI)--------------------*/
//SCGC está con las asignaturas de "Sistemas" de 2º


		case 'PDIH':
		case 'pdih':
		case 'Periféricos':
		case 'periféricos':
		case 'Perifericos':
		case 'perifericos':

			$respuesta = $desconocido."Periféricos y Dispositivos de Interfaz Humana".$desconocido."\n\n"
			.$descripcion."\n
			No hay descripción de la asignatura \n\n"
			.$profesoresT."\n"
			.$desconodido."Fernando Rojas Ruiz: No hay información \n\n"
			.$profesoresP."\n"
			.$desconocido."Fernando Rojas Ruiz: No hay información \n";

			break;

/*------------------------RAMA DE TECNOLOGÍAS DE LA INFORMACIÓN (TI)--------------------*/
//PDM está con las asignaturas de "Programación" de 2º, RMS está con las asignarutas de "Redes" del primer cuatrimestre de 4º de la rama SI

		case 'PDS':
		case 'pds':
		case 'Procesamiento':
		case 'procesamiento':

			$respuesta = $verde."Procesamiento Digital de Señales".$verde."\n\n"
			.$descripcion."\n
			No hay descripción de la asignatura \n\n"
			.$profesoresT."\n"
			.$verde."Javier Ramírez Pérez de Inestrosa: Profesor muy apañado, fácil sacar nota con él \n\n"
			.$profesoresP."\n"
			.$desconocido."Javier Ramírez Pérez de Inestrosa: No hay información \n";

			break;


		default:
			
			$respuesta = $asignatura;
			
			break;


	} //cierre del switch

	enviarMensaje($chatId,$respuesta,$contestacion);

} // cierre del else

/*------------------------FUNCIONES--------------------*/	

function enviarMensaje($chatId, $respuesta, $contestacion){

	if ($contestacion == TRUE) { //si queremos responder a lo que el bot nos diga
		
		$GLOBALS['numero'] = 1;
		$replica = array('force_reply' => True);
		file_get_contents($GLOBALS[path].'/sendMessage?chat_id='.$chatId.'&parse_mode=HTML&reply_markup='.json_encode($replica).'&text='.urlencode($respuesta));
		

	}else{
        //Con GLOBALS coge el contenido de la variable definida "path", si no se pone entonces no recuerda nada de la variable "path"
		file_get_contents($GLOBALS[path]."/sendmessage?chat_id=".$chatId."&parse_mode=HTML&text=".urlencode($respuesta));
	}

}

//función del teclado
function keyboard ($chatId){
	

	$keyboard = array('keyboard' => array(array(array('text' => 'Ayuda'), array('text' => 'Leyenda'), array('text' => 'Asignaturas'), array('text' => 'General'), array('text' => 'FAQ'))),'one_time_keyboard' => false,'resize_keyboard' => true); 

	file_get_contents($GLOBALS[path].'/sendMessage?chat_id='.$chatId.'&parse_mode=HTML&reply_markup='.json_encode($keyboard).'&text='.urlencode("Cargando..."));
}

?>
