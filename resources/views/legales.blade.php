@extends('templates.default')

@section('header')
<script type="text/javascript" src="{{ url('js/llqrcode.js') }}"></script>
<script type="text/javascript" src="{{ url('js/webqr.js') }}"></script>

@endsection


@section('pagecontent')

<div class="container">

		<div class="col-sm-12">
			@include('snip.notificaciones')
		</div>


		

		<div class="row">
			<div class="col-md-3">
				<p>&nbsp;</p>
				<h3>LEGALES</h3>
				<p>&nbsp;</p>
				<ul>
					<li>
						<b><a href="#" onclick="legales('aviso')" class="grey-text ">AVISO DE PRIVACIDAD</a></b>
					</li>
					<li>
						<b><a href="#" onclick="legales('terminos')" class="grey-text ">TÉRMINOS Y CONDICIONES</a></b>
					</li>
				</ul>
				
			</div>
			<div class="col-md-9">

				 <section class="pb-3 text-justify legales aviso">
				        
				    <p>&nbsp;</p>
				    <h3 class="section-title section-title-center">
	                  <b></b>
	                  <span class="secition-title-main">Aviso de privacidad</span>
	                  <b></b>
	                </h3>

				    <p>&nbsp;</p>
				    
				    <div class="row">
						<div class="col-md-12">
							<h4><b>Rifas Web, S.A.P.I. de C.V.</b></h4>
							<p class="grey-text ">
								El presente Aviso de Privacidad se emite en cumplimiento a lo dispuesto por el artículo 15 de la Ley Federal de Protección de Datos Personales en Posesión de los Particulares, reglamentada por el segundo párrafo del Artículo 16 de la Constitución Política de los Estados Unidos Mexicanos, el Reglamento de la Ley Federal de Protección de Datos Personales en Posesión de los Particulares y los Lineamientos del Aviso de Privacidad publicado en el Diario Oficial de la Federación y demás disposiciones aplicables, las cuales se ponen a disposición de cualesquiera personas que tengan, hayan tenido o lleguen a tener algún vínculo o relación con Rifas Web, S.A.P.I. de C.V. (“<u>Rifaweb</u>”) y el servicio que brinda, que por cualquier motivo entregue a Rifaweb datos o información personal.
							</p>
							<p class="grey-text ">
								El objeto del presente escrito es hacer del conocimiento de cualesquiera personas que tengan, hayan tenido o lleguen a tener algún vínculo o relación con Rifaweb y el servicio que brinda (el “Usuario”), sobre la importancia del “AVISO DE PRIVACIDAD” y su referida Ley, la cual se creó con la finalidad de regular y sentar las bases para buscar la protección de los datos personales en posesión de los particulares con el fin de regular su tratamiento legítimo, controlado e informado, a efecto de garantizar la privacidad y el derecho a la autodeterminación informativa de las personas, es decir proteger a los individuos del acceso, rectificación, cancelación y oposición de sus datos personales (denominados derechos ARCO).
							</p>
							<p class="grey-text ">
								En nuestro carácter de responsables en el tratamiento de datos personales observamos los principios que marca la ley, de licitud, consentimiento, información, calidad, finalidad, lealtad, proporcionalidad y responsabilidad acuerdo al artículo 16 de la Ley Federal de Protección de Datos Personales en Posesión de los Particulares
							</p>
							<h5><b>I. NOMBRE Y DOMICILIO DEL RESPONSABLE DE RECABAR LOS DATOS PERSONALES.</b></h5>
							<p class="grey-text ">
								Rifaweb es una Sociedad Anónima Promotora de Inversión de Capital Variable con fines de lucro constituida conforme a la legislación mexicana, que cuenta con los permisos y autorizaciones correspondientes para poder operar conforme a su objeto social que principalmente consiste en la compra, venta, arrendamiento comercialización de todos los recursos necesarios para la divulgación o promoción de actividades, productos o servicios que se relacionan con la publicidad general, así como la realización de actividades para el desarrollo de su objeto social, con domicilio indicado en su página web www.rifaweb.com y Registro Federal de Contribuyentes RIF180118CC1.
							</p>
							<h5><b>II. FINALIDADES Y USO DE LOS DATOS PERSONALES</b></h5>
							<p class="grey-text ">
								Para Rifaweb, es muy importante contar con la confianza del Usuario, por lo que todos los datos que se recaben o sean generados con motivo de su relación con Rifaweb y del cumplimiento en el desempeño de su objeto, son tratados con absoluta confidencialidad, siendo utilizados para todos los fines vinculados con dicha relación, atendiendo a lo dispuesto por la legislación mexicana. Los fines vinculados con dicha relación, serian:
							</p>
							<p class="grey-text ">
								a) llevar a cabo nuestros servicios de rifas y sorteos de productos, servicios, experiencias o cualquier otro dentro del marco legal. b) Contar con datos suficientes para brindar el servicio que se describe anteriormente de manera correcta, así como cualquier otra actividad análoga relacionada con el objeto social de Rifaweb. c) Ofrecer servicio de pago en línea a través de su portal web www.rifaweb.com y recabar de tal modo datos bancarios, número de tarjeta, código de seguridad, domicilio, RFC, CURP, correo electrónico y demás información del Usuario para dicha operación. d) Formación del expediente e historial de los Usuarios. e) Enviar notificaciones de cambios a este aviso de privacidad.

f) Atender cualquier queja, pregunta o comentario. g) En el caso de los empleados: para su inscripción en el R.F.C., IMSS e INFONAVIT, así como la apertura de una cuenta bancaria para el depósito de sueldo. h) Enviar por cualquier medio físico, electrónico o magnético, incluyendo de manera enunciativa y no limitativa, avisos, circulares, noticias, promociones, correo ordinario, correo electrónico, mensajes de texto y llamadas telefónicas por conducto de nuestro personal. i) Crear bases de datos para los fines que requieran nuestros servicios y para poder distribuirla según crea conveniente y atendiendo a los términos y condiciones aprobados en su momento por el Usuario. j) Registrar, identificar, localizar y contactar al Usuario. k) Realizar cualquier otro tipo de actividad vinculada con los incisos anteriores para garantizar la correcta ejecución de los fines contenidos arriba.
							</p>
							<p class="grey-text ">
								De igual forma, la información recabada se podrá utilizar para servicios secundarios de tipo mercadotécnico, proporcionar datos dentro de nuestra página web, campañas publicitarias, entre otros
							</p>
							<p class="grey-text ">
								El Usuario podrá manifestar su rechazo al uso de su información para cualquiera de los fines aquí descritos en cualquier momento de la forma que se indica más adelante.
							</p>
							<h5><b>III. INFORMACIÓN QUE SE RECABA DE LOS USUARIOS O EMPLEADOS.</b></h5>
							<p class="grey-text ">
								Para las finalidades señaladas en el presente Aviso de Privacidad, Rifaweb recabará sus datos personales cuando: a) Usted los proporcione directamente a solicitud de alguno de los miembros de Rifaweb y/o; b) Le sean requeridos a través de nuestra página web, o de algún otro medio electrónico.
							</p>
							<p class="grey-text ">
								En forma enunciativa mas no limitativa, los datos personales que recabamos y tratamos a través de las formas anteriores pueden ser, entre otros: a) Datos sobre el Usuario: nombre completo, CURP, RFC, fecha de nacimiento, celular personal, correo electrónico personal, nacionalidad, escuela de procedencia y sus datos de domicilio, etc. b) En el caso de solicitar facturación electrónica, además se podrá solicitar RFC, CURP, domicilio fiscal y demás datos necesarios; c) Datos fiscales y patrimoniales; d) Número de tarjeta de crédito, débito o vales y la información necesaria para realizar pagos en línea; e) Datos del Empleado, tales como: nombre, CURP, Registro Federal de Contribuyente, Número de Seguro Social, Número de Pasaporte, Número de Cartilla del Servicio Militar Nacional, Numero de Cedula Profesional, domicilio, teléfono, fecha de nacimiento, lugar de nacimiento, género, correo electrónico, profesión, nacionalidad, parentescos, puestos y lugares de trabajo anteriores y demás datos laborales, entre otros.
							</p>
							<p class="grey-text ">
								Cabe señalar que toda la información antes referida será manipulada de forma confidencial por nuestra institución teniendo control sobre el uso y divulgación de la misma.
							</p>
							<p class="grey-text ">
								Rifaweb está en redes sociales, incluyendo sin limitar, Facebook, Instagram, LinkedIn y Twitter. Le recomendamos al Usuario revisar las políticas de privacidad de cada una de las redes sociales en las que siga a Rifaweb ya que Rifaweb se deslinda y no es de ninguna manera responsable por el tratamiento que dicha red social pueda dar a la información el Usuario.
							</p>
							<h5><b>IV. CONSENTIMIENTO DEL USO DE LOS DATOS.</b></h5>
							<p class="grey-text ">
								El Usuario acepta que si solicitaron o expresaron su interés por celebrar un contrato laboral (empleados) o en su caso optar por el servicio que brinda Rifaweb, otorgaron su consentimiento pleno para el tratamiento y transferencia de la Información, para los fines antes descritos.
							</p>
							<p class="grey-text ">
								Para los fines distintos a los que se señalan a continuación, cuando se trate de datos financieros o patrimoniales Rifaweb recabará el consentimiento pertinente, el cual junto con el presente Aviso de Privacidad le faculta, a darle el tratamiento que haya sido autorizado por los Usuarios.
							</p>
							<p class="grey-text ">
								De igual forma, utilizará sus datos sin previa autorización cuando:
							</p>
							<p class="grey-text ">
								I. Esté previsto en una Ley; II. Los datos figuren en fuentes de acceso público;

III. Los datos personales se sometan a un procedimiento previo de disociación; IV. Tenga el propósito de cumplir obligaciones derivadas de una relación jurídica entre el Usuario y el responsable; V. Exista una situación de emergencia que potencialmente pueda dañar a un individuo en su persona o en sus bienes; VI. Sean indispensables para la atención médica, la prevención, diagnóstico, la prestación de asistencia sanitaria, tratamientos médicos o la gestión de servicios sanitarios, mientras el titular no esté en condiciones de otorgar el consentimiento, en los términos que establece la Ley General de Salud y demás disposiciones jurídicas aplicables y que dicho tratamiento de datos se realice por una persona sujeta al secreto profesionioal u obligación equivalente, o VII. Se dicte resolución de autoridad competente.
							</p>
							<p class="grey-text ">
								Al proporcionar sus datos personales por cualquier forma a Rifaweb, usted acepta la recopilación, uso, divulgación, procesamiento y transferencia de la Información personal de acuerdo con los términos de este Aviso de Privacidad. Si usted provee cualquier tipo de Información personal relacionada con otra persona, por el presente usted declara y acepta que ha obtenido el consentimiento legal correspondiente de dicha persona para los efectos de dicho aviso de privacidad.
							</p>

							<h5><b>V. DERECHOS DE ACCESO, RECTIFICACIÓN, CANCELACIÓN U OPOSICIÓN (ARCO).</b></h5>
							<p class="grey-text ">
								Usted tiene derecho a acceder a sus datos personales que poseemos y a los detalles del tratamiento de los mismos, así como a rectificarlos en caso de ser inexactos o solicitar la cancelación de los mismos cuando considere que resulten ser excesivos o innecesarios para las finalidades que justificaron su obtención u oponerse al tratamiento de los mismos para fines específicos.
							</p>
							<p class="grey-text ">
								En caso de que el titular quiera limitar o revocar su consentimiento sobre el tratamiento, divulgación o transferencia o hacer uso de los derechos ARCO (Acceso, Rectificación, Cancelación u Oposición), deberá presentar su solicitud con firma autógrafa, en el domicilio de Rifaweb, acompañada de la identificación oficial que lo acredite como titular de los datos (IFE, pasaporte), indicando las modificaciones a realizar y anexando la documentación que sustente su petición.
							</p>
							<p class="grey-text ">
								Rifaweb comunicará al solicitante en un plazo máximo de 15 días hábiles contados a partir de la fecha en que se reciba la solicitud de acceso, rectificación, cancelación u oposición la determinación adoptada. Si resulta procedente, se hará efectiva dentro de los 15 días siguientes a la fecha en que se les comunique la respuesta.
							</p>
							<p class="grey-text ">
								Se podrá negar el acceso de datos personales, rectificación, cancelación o concesión de la oposición al tratamiento de los mismos, en los siguientes supuestos:
							</p>
							<p class="grey-text ">
								a. Cuando el solicitante no sea el titular de los datos personales, o el representante legal no esté debidamente acreditado para ello. b. Cuando en su base de datos no se encuentren los datos personales del solicitante. c. Cuando se lesionen los derechos de un tercero. d. Cuando exista un impedimento legal, o la resolución de una autoridad competente que restrinja el acceso a los datos personales o que no permita la rectificación, cancelación u oposición de los mismos e. Cuando la rectificación, cancelación u oposición haya sido previamente cancelada.
							</p>
							<p class="grey-text ">
								La negativa a que se refiere este artículo podrá ser parcial en cuyo caso Rifaweb indicará en qué casos se podrá efectuar el acceso, rectificación, cancelación u oposición requerida por el titular.
							</p>
							<p class="grey-text ">
								En todos los casos anteriores, Rifaweb deberá informar el motivo de su decisión y comunicarla a los titulares o en su caso, al representante legal, en los plazos establecidos para tal efecto, por el mismo medio por el que se llevó a cabo la solicitud, acompañando, en su caso, las pruebas que resulten pertinentes.
							</p>
							<h5><b>VI. TRANSFERENCIA DE DATOS PERSONALES.</b></h5>
							<p class="grey-text ">
								Rifaweb podrá compartir todos o parte de sus datos personales con cualquiera de las empresas relacionadas con la misma, en México y el extranjero; así como con empresas autorizadas de acuerdo a la Legislación de conformidad con los fines descritos anteriormente; y los demás empleados y asesores de la institución, quienes podrán o no tratar sus datos personales por cuenta del mismo.
							</p>
							<p class="grey-text ">
								Asimismo, nos reservamos el derecho de compartir sus datos personales con autoridades gubernamentales, administrativas y/o judiciales en los Estados Unidos Mexicanos o en el extranjero en caso de ser necesario o requerido.
							</p>
							<p class="grey-text ">
								Rifaweb, no compartirá o transferirá sus datos personales a terceros salvo en los casos previstos en la Ley Federal de Protección de Datos Personales en Posesión de los Particulares o cualquier otra legislación o reglamento aplicable.
							</p>
							<h5><b>VII. SEGURIDAD, ALMACENAMIENTO Y UBICACIÓN DE DATOS PERSONALES.</b></h5>
							<p class="grey-text ">
								Rifaweb podrá conservar sus datos personales en bases de datos ubicadas en los Estados Unidos Mexicanos o en el extranjero sin limitación alguna.
							</p>
							<p class="grey-text ">
								Las transmisiones de datos a través de internet nunca son 100% seguras o libres de error. En consecuencia, no garantizamos ni podemos garantizar la seguridad, precisión o exactitud de la información personal. Sin embargo, aplicamos procedimientos físicos, electrónicos y administrativos razonables para proteger la información personal contra destrucción accidental o ilegal, perdida o alteración accidental y divulgación o acceso no autorizado.
							</p>
							<p class="grey-text ">
								Los datos personales de los Usuarios se conservarán en nuestras bases de datos permanentemente, salvo que se exprese lo contrario por escrito mediante los mecanismos descritos en el presente aviso de privacidad.
							</p>
							<h5><b>VIII. MODIFICACIONES AL AVISO DE PRIVACIDAD.</b></h5>
							<p class="grey-text ">
								Nos reservamos el derecho de efectuar en cualquier momento modificaciones o actualizaciones al presente aviso de privacidad, para la atención de novedades legislativas o jurisprudenciales, políticas internas o nuevos requerimientos para la prestación u ofrecimiento de nuestro servicio educativo. Estas modificaciones estarán disponibles para la comunidad educativa a través nuestra página web www.rifaweb.com
							</p>



							<h5><b>IX. CANALES DE COMUNICACIÓN.</b></h5>
							<p class="grey-text ">
								Para mayor información, puede comunicarse al número de teléfono que aparece en la página web www.rifaweb.com al dar click en “Contacto” o enviar un mensaje al correo que aparecerá ahí mismo y con gusto lo atenderemos.
							</p>
							<p class="grey-text ">
								De conformidad con el artículo octavo de la Ley Federal de Protección de Datos Personales en Posesión de los Particulares, por el simple hecho de no manifestar oposición al leer el presente Aviso se entenderá su aceptación a los términos del mismo.
							</p>
							<p class="grey-text "></p>

							<p class="grey-text ">
								Última actualización: 14 de marzo de 2018
							</p>


		





							<p class="grey-text "></p>
						</div>
				    </div>
				    
				</section>



				<section class="pb-3 text-justify legales terminos" style="display: none;">
				        
				    <p>&nbsp;</p>
				    <h3 class="section-title section-title-center">
	                  <b></b>
	                  <span class="secition-title-main">Términos y Condiciones</span>
	                  <b></b>
	                </h3>

				    <p>&nbsp;</p>
				    
				    <div class="row">
						<div class="col-md-12">
							<h4><b>Rifas Web, S.A.P.I. de C.V.</b></h4>
							<p class="grey-text ">
								Estos términos y condiciones constituyen un acuerdo integral entre Rifasweb, S.A.P.I. de C.V. (“Rifaweb”) y el usuario que ingrese al sitio web www.rifaweb.com y a los sitios relacionados a los que se ingrese a través de dicho sitio web (el “Usuario”) (conjuntamente, el “Sitio”).
							</p>
							<p class="grey-text ">
								Por el simple hecho de acceder al Sitio, usted acepta estos términos y condiciones y el aviso de privacidad ahí contenidos, mismos que podrán verse modificados de tiempo en tiempo, entendiéndose que el uso continuo del Sitio una vez realizada cualquier modificación, se entenderá de igual forma como aceptación de dichas modificaciones.
							</p>
							<p class="grey-text ">
								Toda persona que quiera utilizar nuestros servicios deberá de leer y aceptar las políticas que rigen dichos servicios. El Sitio únicamente podrá destinarse a usuarios mayores de 18 años de edad (o la edad que sea aplicable para participar en sorteos/rifas en el lugar en el que se encuentren), aquellas personas que no cumplan con este requisito deberán abstenerse de utilizar el Sitio y queda prohibido que los mismos participen dentro del mismo.
							</p>
							<p class="grey-text ">
								Favor de leer íntegramente estos términos y condiciones y el aviso de privacidad contenido en el Sitio y regresar a revisar cualquier actualización de forma frecuente. En caso de no aceptar alguna de las condiciones contenidas en los términos y condiciones, el aviso de privacidad y cualquier otra política del Sitio, deberá de dejar de utilizar el Sitio de manera inmediata.
							</p>
							<h4><b>Horario de Servicio</b></h4>
							<p class="grey-text ">
								Rifaweb busca estar a su servicio las 24 horas del día, según se indica en el Sitio. Intentaremos responder sus dudas o comentarios a la brevedad posible, sin poder prometer un tiempo específico de respuesta.
							</p>
							<p class="grey-text ">
								Los medios de atención de Rifaweb son a través de los puntos de contacto que podrán revisar en la pestaña de “Contacto” dentro del Sitio.
							</p>
							<h4><b>Política Comercial</b></h4>
							<p class="grey-text ">
								Rifaweb es una plataforma Web en la cual se sortean diversos productos, beneficios o servicios que pueden variar de tiempo en tiempo (el “Producto”).
							</p>
							<p class="grey-text ">
								El Sitio tiene como objeto fungir como un portal de sorteos en el que los Usuarios pueden adquirir boletos electrónicos (“Tickets”) para participar en el sorteo de alguno de los Productos que se encuentren en el Sitio.
							</p>
							<p class="grey-text ">
								Se prohíbe utilizar el Sitio indebidamente, falsear la identidad de un usuario y llevar a cabo actividades fraudulentas en la misma.
							</p>
							<p class="grey-text ">
								Alta del usuario. Los usuarios que formen parte del Sitio y deseen adquirir Tickets para participar en algún sorteo, deberán seguir el siguiente proceso:
							</p>
							<p class="grey-text ">
								1) Alta del Usuario: el Usuario deberá crear una cuenta en la plataforma y proporcionar la información que se le solicite en la misma para poder ser identificado dentro del Sitio y tener acceso a adquirir Tickets y participar en sorteos;

2) Generando un usuario y contraseña al momento de registrar sus datos y crear una cuenta, este usuario y contraseña será responsabilidad y deberán ser debidamente administrados por quien se haya dado de alta. Así mismo, Rifaweb interpreta, de buena fe, que los datos proporcionados por el usuario son correctos.

3) Seleccionar el Producto por el que desea participar en el sorteo y adquirir Tickets mediante compra electrónica a través del Sitio.

4) Revisar detenidamente las bases y los términos y condiciones del sorteo en el que desea participar, en el entendido que una vez que el Usuario adquiera Tickets para un sorteo, los mismos no serán reembolsables y deberá sujetarse a los lineamientos de dicho sorteo.

5) Esperar a que el resultado del sorteo sea anunciado, para lo cual utilizaremos la información de contacto que nos proporcione el Usuario en el Sitio.
							</p>
							<p class="grey-text ">
								Al momento de utilizar el Sitio, el usuario está de acuerdo con el aviso de privacidad y los términos y condiciones del mismo.
							</p>
							<h4><b>Políticas de Entregas</b></h4>
							<p class="grey-text ">
								Cada sorteo específico dentro del Sitio detallará la forma de entrega del Producto sorteado.
							</p>
							<p class="grey-text ">
								El Usuario deberá someterse a la forma de entrega detallada en el sorteo específico en caso de ser ganador del mismo.
							</p>
							<p class="grey-text ">
								Las formas de entrega pueden ser:
							</p>
							<p class="grey-text ">
								1) Entrega en las oficinas de Rifaweb: la entrega del Producto se hará directamente en las oficinas de Rifaweb que se indiquen en las bases del sorteo específico, el Usuario o un representante del Usuario deberá acudir a las oficinas de Rifaweb con la información que Rifaweb le solicite y en los horarios y dentro del plazo detallado en las bases del sorteo en cuestión. En caso de no cumplir con alguno de los requisitos para la entrega del Producto en las oficinas de Rifaweb, el Usuario perderá el derecho sobre el Producto y Rifaweb pasará a ser propietario de dicho Producto para utilizarlo de la forma que mejor le convenga.

2) Entrega a domicilio: la entrega del Producto se hará vía mensajería en el domicilio que el Usuario señaló en el Sitio. El Usuario deberá cubrir el costo de envío y deberá sujetarse a los tiempos del mismo. En caso de que el domicilio proporcionado en el Sitio sea incorrecto y el Producto no pueda entregarse, el Usuario perderá todo derecho sobre

el Producto y el mismo pasará a ser propiedad de Rifaweb para el uso que mejor le convenga. En caso de que el Producto no logre ser entregado correctamente, sufra algún daño, sea robado o se pierda por causas que no sean directamente imputables a Rifaweb, Rifaweb no será responsable ni deberá reponer dicho Producto al Usuario por lo que el Usuario se obliga a sacar en paz y a salvo a Rifaweb por cualquier de los casos anteriormente mencionados.

3) Entrega vía electrónica: la entrega se hará vía correo electrónico para el caso de Productos que puedan ser entregados de esta forma. El Producto se entregará al correo electrónico proporcionado por el Usuario en el Sitio, en caso de que dicho correo electrónico sea incorrecto, el Usuario perderá todo derecho sobre dicho Producto y Rifaweb pasará a ser propietario del mismo para usarlo como mejor le convenga.

4) Cualquier otro tipo de entrega señalado por Rifaweb en las bases y términos del sorteo.
							</p>
							<p class="grey-text ">
								Rifaweb no será responsable del Producto en caso fortuito o de fuerza mayor, el Usuario sacará en paz y a salvo a Rifaweb de cualquier contingencia al respecto derivada de caso fortuito o fuerza mayor y Rifaweb ofrecerá, en este caso, reembolso al Usuario del valor de los Tickets que haya adquirido para el sorteo.
							</p>
							<p class="grey-text ">
								El Usuario deberá de tomar en cuenta que aceptamos las tarjetas de crédito, débito y métodos de pago descritos en el Sitio
							</p>
							<p class="grey-text ">
								Sin importar el lugar de residencia del Usuario, este último deberá de contar con las facilidades necesarias para que la entrega del Producto pueda llevarse a cabo.
							</p>
							<p class="grey-text ">
								Una vez que el Usuario reciba el Producto (para entregas en persona) o que el mismo haya sido enviado por mensajería, Rifaweb no se hace responsable por el uso, daños, desperfectos o cualquier queja respecto al mismo.
							</p>
							<h4><b>Política de Privacidad</b></h4>
							<p class="grey-text ">
								Usted está en un Sitio administrado y manejado por Rifaweb.
							</p>
							<p class="grey-text ">
								La información aquí proporcionada y su veracidad es única y exclusivamente responsabilidad del Usuario.
							</p>
							<p class="grey-text ">
								Los usuarios reconocen que, al proporcionar la información de carácter personal requerida en el Sitio, otorgan a Rifaweb las facultades contenidas en la Ley Federal de Derechos de Autor, incluyendo sin limitar, la autorización señalada en el artículo 109 de la Ley Federal del Derecho de Autor. En todos los casos, el Usuario responderá por la veracidad de la información proporcionada a Rifaweb.
							</p>
							<p class="grey-text ">
								Para mayor información sobre la Política de Privacidad de Rifaweb consulte nuestro aviso de Privacidad que se encuentra en el Sitio.
							</p>
							<h4><b>Política de Cambios y Devoluciones</b></h4>
							<p class="grey-text ">
								El Producto que el Usuario reciba como ganador de algún sorteo en el Sitio, no podrá ser devuelto ni cambiado salvo por causas directamente imputables a Rifaweb y reportadas en un máximo de 2 días hábiles a partir de la entrega de dicho Producto. Para el caso de beneficios o servicios, el reporte deberá hacerse en un máximo de 2 días hábiles a partir de que el mismo sea efectivamente prestado u otorgado.
							</p>
							<p class="grey-text ">
								El Usuario deberá comprobar la imputabilidad directa de Rifaweb en todos los casos, para que el Producto pueda ser devuelto y el Ticket reembolsado o en su caso cambiado. Rifaweb se reserva el derecho de cambiar un Producto, dependiendo de la existencia del mismo y factibilidad de Rifaweb para conseguirlo.
							</p>
							<h4><b>Política de Privacidad y Seguridad de la Información</b></h4>
							<p class="grey-text ">
								Rifaweb se compromete a cumplir, en la operación del Sitio y proyectos de afinidades, los requisitos de la política de privacidad de Rifaweb que a continuación se establece
							</p>
							<p class="grey-text ">
								<b>Rifaweb respeta su privacidad</b>
							</p>
							<p class="grey-text ">
								Rifaweb respeta su derecho a la privacidad. La presente Declaración de privacidad le informa acerca de nuestras prácticas sobre privacidad, así como de las opciones de las que dispone sobre el modo en que se recaba y utiliza la información en línea. Esta declaración se puede consultar con facilidad en la parte inferior de la página web www.rifaweb.com.
							</p>
							<p class="grey-text ">
								Durante la elaboración de las políticas y las normas de privacidad de Rifaweb, respetamos y tenemos en cuenta los principales marcos y principios de todo el mundo, incluidas las Directrices de la OCDE sobre la protección de la privacidad y los flujos transfronterizos, la Directiva 95/46/CE de la UE, el Marco de privacidad de APEC y la Resolución de Madrid sobre estándares internacionales de privacidad.
							</p>
							<p class="grey-text ">
								<b>Sitios incluidos en esta Declaración de privacidad</b>
							</p>
							<p class="grey-text ">
								La presente Declaración de privacidad se aplica a todos los sitios web y a todos los dominios propiedad de Rifaweb, salvo que un sitio web de Rifaweb incluya una declaración de privacidad especifica referida a un programa o servicio particular de Rifaweb, en cuyo caso aplicará dicha declaración de privacidad especifica en vez de la presente Declaración de privacidad.
							</p>
							<p class="grey-text ">
								<b>Enlaces a sitios Web de otras empresas</b>
							</p>
							<p class="grey-text ">
								El Sitio puede incluir enlaces a sitios web de terceros, para su comodidad o para efectos informativos. Si obtiene acceso a dichos enlaces, abandonará el sitio web de Rifaweb. Rifaweb no controla dichos sitios, ni tampoco sus prácticas sobre privacidad, que pueden diferir de las prácticas de Rifaweb. Rifaweb no asume ninguna responsabilidad en relación con esos sitios web de terceros. Los datos personales que decida proporcionar en esos sitios de terceros, o que son recabados por esos terceros, no están incluidos en la Declaración de privacidad de Rifaweb. Le recomendamos que revise la política de privacidad de cualquier empresa antes de enviar su información personal.
							</p>
							<p class="grey-text ">
								Asimismo, podemos facilitar en nuestro sitio web funciones de medios sociales que le permiten compartir la información de Rifaweb en sus redes sociales e interactuar con Rifaweb en diversos sitios de medios sociales. La utilización de estas funciones puede implicar que se recabe o comparta información sobre usted, lo cual dependerá de cada función concreta. Le recomendamos que revise la configuración y las políticas de privacidad de los sitios de los medios sociales con los que interactúa para asegurarse de que comprende la información que se podría compartir en dichos sitios.
							</p>
							<p class="grey-text ">
								<b>Obtención de información personal</b>
							</p>
							<p class="grey-text ">
								Para poder servirle mejor y comprender mejor sus necesidades e intereses, Rifaweb le notifica de manera oportuna y solicita su consentimiento al recabar, exportar y utilizar su información personal, además de cumplir con el requisito de registro ante las autoridades de protección de datos cuando sea pertinente. Por ejemplo, al solicitar información, al subscribirse a materiales de soporte o de marketing, al registrarse personalmente, al participar en concursos o en encuestas o al solicitar un puesto de trabajo en Rifaweb, le pediremos que nos proporcione información personal para completar dichas transacciones. El tipo de información personal que nos proporcione en dichas páginas puede incluir información de contacto, como su nombre, domicilio, número de teléfono y dirección de correo electrónico; información financiera, como su número de tarjeta de crédito; y otra información exclusiva, como la identificación de usuario y las contraseñas, información de facturación o transaccional, preferencias sobre productos y servicios, preferencias de contacto, historial académico y laboral y datos relativos a interés en puestos de trabajo.
							</p>
							<p class="grey-text ">
								Si publica, comenta o comparte información personal, incluidas fotografías, en cualquier foro público de un sitio de Rifaweb, red social, blog u otro foro de este tipo, debe tener en cuenta que cualquier información personal que publique la podrán leer, ver, recabar o utilizar otros usuarios de dichos foros, y se podría utilizar para ponerse en contacto con usted, enviarle mensajes no solicitados o con fines que ni usted ni Rifaweb podemos controlar. Rifaweb no es responsable de la información personal que decida enviar a estos foros. De igual forma, Rifaweb podrá hacer uso de la información publicada para los fines que mejor le convengan.
							</p>
							<p class="grey-text ">
								Además de la información que nos proporcione, Rifaweb también podrá recabar información durante su visita a un sitio web de Rifaweb, o a un sitio web "administrado por" otras empresas en nombre de Rifaweb, a través de nuestras Herramientas para Recabar Datos Automáticamente, entre las que se incluyen web beacons, cookies, enlaces web integrados y otras herramientas para recabar información. Dichas herramientas recaban cierta información de tráfico que su explorador envía a un sitio web, como puede ser el tipo de su navegador, el idioma, las horas de acceso y la dirección del sitio web del que procede. También pueden recabar información acerca de su Protocolo de Internet (IP), de su comportamiento relativo a dónde hace clic (es decir, las páginas web que visita, los enlaces en los que hace clic y otras acciones que lleva a cabo en relación con los sitios web de Rifaweb u otros sitios web utilizados) y también acerca de la información de un Producto. Una dirección IP es un número que se asigna automáticamente a su computadora, cada vez que navega por la red, lo que permite a los servidores de red localizar e identificar su computadora. Las computadoras utilizan las direcciones IP para comunicarse en Internet, permitiendo a los usuarios navegar y realizar compras. Rifaweb podrá utilizar también algunas de esas Herramientas para Recabar Datos Automáticamente en relación con determinados mensajes de correo electrónico enviados desde Rifaweb y, por tanto, Rifaweb puede recabar información mediante el uso de dichas herramientas cuando abra el correo electrónico o haga clic en un enlace que aparece en dicho correo.
							</p>
							<p class="grey-text ">
								Rifaweb también recaba información de fuentes comerciales disponibles que sean dignas de su confianza. Dicha información puede incluir su nombre, domicilio, dirección de correo electrónico y datos demográficos. La información que Rifaweb obtiene de sus fuentes comerciales puede utilizarse junto con la información que Rifaweb recaba cuando visita los sitios web de Rifaweb. Por ejemplo, Rifaweb podrá comparar la información geográfica adquirida de sus fuentes comerciales con la dirección IP recabada por las Herramientas para Recabar Datos Automáticamente para concluir cuál es su zona geográfica general.
							</p>
							<h4><b>Generales</b></h4>


							
							<p class="grey-text ">
								<b>Propiedad Intelectual:</b>
							</p>
							<p class="grey-text ">
								Toda la información, imágenes, diseño, código, contenido entre otros que se encuentre dentro del Sitio, será propiedad de Rifaweb o de los terceros que sean sus propietarios, por lo que la distribución o reproducción de lo anterior por parte del usuario podrá constituir un incumplimiento que podrá ser objeto de acción judicial. La propiedad intelectual del Sitio sólo podrá ser utilizada por el usuario de la manera en que expresamente lo autorice Rifaweb o los terceros propietarios de la misma.
							</p>
							<p class="grey-text ">
								<b>Jurisdicción Aplicable:</b>
							</p>
							<p class="grey-text ">
								Los presentes términos y condiciones serán regulados por las leyes de México, sometiéndose Rifaweb y el Usuario a los tribunales competentes de la Ciudad de México, CDMX y renunciando a cualquier otro fuero que les pudiera corresponder.
							</p>
							<p class="grey-text ">
								<b>Contenido:</b>
							</p>
							<p class="grey-text ">
								Las opiniones vertidas en el Sitio serán exclusiva responsabilidad de quien la realice y no reflejan necesariamente la opinión de Rifaweb.
							</p>
							<p class="grey-text ">
								<b>Usuario:</b>
							</p>
							<p class="grey-text ">
								El Usuario no podrá utilizar el Sitio para uso comercial. Ni podrá, copiar, modificar, distribuir, reproducir, explotar ni utilizar de ningún otro modo el Sitio.
							</p>
							<p class="grey-text ">
								El usuario es responsable de la actividad que realice en el Sitio, misma que deberá apegarse a las normas del mismo y a las leyes vigentes. El Usuario será responsable por cualquier mal uso que se de a su cuenta ya sea por sí mismo o a través de terceros. Rifaweb advierte al Usuario que su cuenta sólo puede ser utilizada por el mismo, por lo tanto, cualquier compra realizada a través de la misma se entenderá realizada por el Usuario y no será objeto de reclamos o devoluciones.
							</p>
							<p class="grey-text ">
								El Usuario reconoce que deberá sacar en paz y a salvo a Rifaweb, sus filiales, empleados y demás personas que tengan una relación directa con Rifaweb, de cualquier reclamación o acción ejercitada en contra de dicho Usuario por el uso que se dé al Sitio.
							</p>
							<p class="grey-text ">
								El Usuario reconoce que Rifaweb no puede garantizar la seguridad y privacidad del Sitio, así como la satisfacción del usuario al utilizar y adquirir nuestros Productos. Por lo anterior, el usuario no ejercerá ninguna acción ni hará responsable a Rifaweb por cualquier acto del cual no sea exclusiva y directamente responsable Rifaweb por negligencia fundada y comprobada
							</p>
							<p class="grey-text ">
								<b>Modificaciones:</b>
							</p>
							<p class="grey-text ">
								Rifaweb se reserva el derecho de realizar cualquier cambio o modificación a estos términos y condiciones de tiempo en tiempo, dichas modificaciones o cambios serán actualizadas directamente en el Sitio.
							</p>
							<p class="grey-text "></p>

						</div>
				    </div>
				    
				</section>
				
			</div>
		</div>
	

</div>

@endsection


@section('scripts')
<script>
	function legales(valor){
		$('.legales').fadeOut();
		$('.'+valor).fadeIn();
	}
</script>

@endsection