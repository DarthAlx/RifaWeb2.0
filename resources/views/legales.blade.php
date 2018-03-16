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

				 <section class="pb-3 text-justify">
				        
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
				
			
		</div>
	

</div>

@endsection


@section('scripts')


@endsection