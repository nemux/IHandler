<?php

use Illuminate\Database\Seeder;

class AttackSignatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attackCategories = [
            [

                "name" => ".htpasswd access",
                "description" => "Esta firma muestra un comportamiento donde la comunicación se da hacia un servidor web desde cualquier otro equipo. Se da con el propósito de obtener acceso al archivo .htpasswd de forma remota a través de un navegador web usando un comando que el lenguaje PHP pueda interpretar, mediante cadenas parecidas a la siguiente: 'find all .htpasswd files'=>'find / -type f -name .htpasswd',..'find .htpasswd files in current dir'=>'find . -type f -name .htpasswd'.\n\nEste indicador salta especialmente al detectar la cadena \".htpasswd\" en la petición.\nDentro del archivo .htpasswd se encuentra una lista de usuarios y contraseñas que permiten el acceso al directorio relacionado, en él los usuarios están en texto plano y las contraseñas se encuentran cifradas con un método hash.\n\nSi un atacante o entidad malintencionada tiene acceso a este archivo podría realizar un ataque de intento de acceso mediante fuerza fruta.",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-El archivo .htpasswd debe ser almacenado en un lugar fuera del DocumentRoot para el servidor web, para protegerlo en caso de que se suscite un acceso no autorizado.\n-La configuración por defecto debe incluir la siguiente sección para evitar el acceso a los archivos .ht:\n     -Order allow,deny\n     -Deny from all\n-Asegúrese de que las contraseñas almacenadas en .htpasswd se encuentren cifradas, por algún algoritmo seguro.",
                "risk" => "El atacante podría realizar una solicitud para recuperar el archivo .htpasswd a continuación, utilizar la información en ella para lanzar un ataque de diccionario basado en los nombres de usuario que se encuentran.",
                "reference" => "https://www.snort.org/rule_docs/1071",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "/bin/sh In URI Possible Shell Command Execution Attempt",
                "description" => "El comportamiento que genera esta alerta es el relacionado a un intento de ejecución de código de manera remota, incluyendo comandos en la URL con la cual se realizó la solicitud hacia el servidor web. Esta alarma se dispara cuando se detecta la cadena \"/bin/sh\" la cual hace referencia a un directorio de Unix en busca de ejecutar un archivo.\n\nSi un atacante o entidad maliciosa genera una inyección de cogido exitosa, le permitiría ejecutar código de manera remota, examinar los archivos del servidor, y sustraer información sensible.",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Verificar que la conexión realizada entre los equipos con IP´s reportados sea legítima.\n-Verificar que el servidor cuente con la validación de datos de todas las entradas en todos los Scripts GCI con los que cuente el servidor.\n-Mantener el servidor completamente actualizado, con los últimos parches de seguridad instalados.\n-Bloquear en el Firewall perimetral la dirección IP desde donde se recibió el ataque.\n-Realizar una verificación de código para asegurarse que el CGI, así como la aplicación que lo ejecuta, se encuentren sanitizando correcamente las entradas que reciben a fin de evitar inyección de comandos.",
                "risk" => "La especificación CGI ofrece oportunidades para leer archivos, adquirir acceso shell y archivos corruptos sistemas de manera remota, de no contar con la suficiente seguridad se puede provocar una fuga de información sensible.\n\nPermite la ejecución de comandos de manera remota, de tal forma que un atacante podría provocar una denegación de servicio (QoS) e incluso ejecución de código malicioso.",
                "reference" => "https://www.sans.org/security-resources/malwarefaq/guestbook.php\nhttp://phrack.org/issues/49/8.html\nhttps://www.owasp.org/index.php/Command_Injection",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "/system32/ in Uri - Possible Protected Directory Access Attempt",
                "description" => "Esta firma nos indica que se identificó una solicitud a un sitio web, que intenta tener acceso a directorios del sistema del servidor web. Esta alerta se activa cuando en la solicitud se observa la cadena  \"/system32/\" dentro de URL de la solicitud.\n\nEl directorio de \"system32\" es propio del Sistema Operativo Windows y en él se encuentran los archivos de arranque del sistema, así como algunos archivos de ejecución y configuración de las aplicaciones que se ejecutan sobre él. El acceso sin autorización a este directorio puede traer serias consecuencias al equipo, puede generar pérdida de información sensible, ejecución de código arbitrario de forma remota, hasta una denegación del servicio que se esté proporcionando.",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Verificar que la conexión realizada entre los equipos con IP´s reportados sea legítima.\n-Asegurarse que los documentos del sistema cuentan con seguridad y están protegidos de los usuarios del servicio Web.\n-Mantener el servidor completamente actualizado, con los últimos parches de seguridad instalados.\n-Bloquear en el Firewall perimetral la dirección IP desde donde se recibió el ataque.\n-Realizar una verificación de código para asegurarse que la aplicación se encuentra realizando una correcta sanitización de las entradas a fin de evitar una inyección de código.",
                "risk" => "Fuga de información sensible.\nCambio en la configuración del servidor.\nDenegación de servicios (QoS).\nEjecución de código malicioso.",
                "reference" => "http://www.iss.net/security_center/advice/Intrusions/2000645/default.htm",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "@lex Guestbook SQL Injection Attempt -- index.php lang SELECT",
                "description" => "\"@Guestbook\" es un script de libro de visitas para los sitios web de Internet. Escrito en lenguaje PHP, que es fácil de instalar en cuestión de minutos en la mayoría de los casos, incluso para los principiantes. Permite a los usuarios de las aplicaciones web poder ingresar datos así como comentarios u observaciones de un tema en particular.\n\nLa vulnerabilidad encontrada en este script es que no se validan adecuadamente los campos que se ingresan, en especial el parámetro \"lang\", lo cual puede permitir la ejecución de código que permita la sustracción de información sensible, una denegación de servicio así como la infección por malware.",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Identificar el equipo involucrado en el tráfico entrante.\n-Verificar que se trabaja con libro de visitas de Alexphpteam Alex versión 4.0.2 o superior.\n-Analizar el archivo index.php.\n- Editar el código fuente para asegurar que las entradas son verificadas apropiadamente.\n     -En especial el parámetro \"lang\".\n-Bloquear en el Firewall perimetral la dirección IP desde donde se recibió el ataque.",
                "risk" => "Acceder a la aplicación sin tener nombre de usuario ni contraseña.\nAveriguar el nombre de los campos.\nAveriguar el nombre de las tablas.\nAveriguar el contenido de los registros.\nAñadir nuevos usuarios.\nBorrar información de la base de datos.\nRobar información importante para la institución.\nProvocar una denegación de servicios.\nSuplantación de identidad.\nDivulgar información confidencial.",
                "reference" => "http://www.scip.ch/en/?vuldb.34347\nhttp://www.cisco.com/web/about/security/intelligence/sql_injection.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "DNS Query for .su TLD (Soviet Union) Often Malware Related",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar si la comunicación es legítima.\n• Validar si el sitio se encuentra dentro de las políticas de navegación segura de la institución, en caso de no serlo: \n   o Realizar un análisis completo a los equipos relacionados en búsqueda de Malware con un software antivirus actualizado. \n   o Bloquear el dominio en el archivo “hosts” del equipo reportado.\n   o En caso de contar con un servidor de filtrado de contenido web, bloquearlo.",
                "risk" => "El ingreso a este tipo de dominios puede causar que el equipo se infecte con algún tipo de código malicioso comprometiendo así la seguridad de los recursos que maneja. Además de propicias fuga de información y denegación de servicio.",
                "reference" => "https://labs.opendns.com/2013/10/14/investigating-new-botnet-security-graph/\nhttps://www.abuse.ch/?p=3581",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "DNS Query For XXX Adult Site Top Level Domain",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Validar que el acceso a sitios con contenido para adultos se encuentre restringido en las políticas de uso aceptable del equipo de cómputo de la institución.\n• Bloquear el dominio reportado:\n   o En el archivo “hosts” del equipo reportado.\n   o En caso de contar con un servidor de filtrado de contenido web, bloquearlo.\n• Analizar el equipo reportado con un software antivirus actualizado para descartar la presencia de malware debido a estos sitios.\n",
                "risk" => "El ingreso a este tipo de dominios puede causar que el equipo se infecte con algún tipo de código malicioso comprometiendo así la seguridad de los recursos que maneja. Además de propicias fuga de información y denegación de servicio. Además que se incurre en la violación de políticas de la institución.",
                "reference" => "https://riesgosinternet.wordpress.com/2010/05/31/el-porno-como-cebo-para-malware-extorsionador/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "414 Request URI Too Large",
                "description" => "Esta alerta se da cuando se detecta una respuesta desde el servidor web hacia cualquier equipo que realizó la solicitud, donde indica que el largo de la URL es demasiado extenso, y el servidor web interpreta que es errona.\n\nEste comportamiento va relacionado a un ataque de tipo inyección de código, ya que las cadenas tan largas son provocadas por esconder comandos a ejecutar en el servidor, en la URL de la solicitud al sitio web. Esto provoca que el analizador de URL ejecutara comandos que permitan al atacante poder obtener información del servidor, o ejecutar código arbitrario.",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Identificar el equipo involucrado en el tráfico entrante.\n-Verificar que se tiene correctamente configurado el valor máximo aceptado en la URL.\n-Analizar los archivos involucrados en la ruta atacada a fin de detectar posibles vulnerabilidades de inyección de código.\n-Editar el código fuente para asegurar que las entradas son verificadas apropiadamente.\n-Bloquear en el Firewall perimetral la dirección IP desde donde se recibió el ataque.",
                "risk" => "En alta frecuencia, puede hacer que el servidor se sobrecarga de peticiones y generar una denegación del servicio.\nPuede ser un intento para un ataque por inyección SQL, que permita el robo o modificación de información sensible.\nPuede ser un intento de explotar vulnerabilidades de desbordamiento de buffer del servidor Web\nPuede ser un intento de explotar vulnerabilidades de validación de entradas en la aplicación Web\nPuede ser un intento de ataques del tipo path traversal al servidor Web o aplicación ejecutaba en el servidor Web.",
                "reference" => "http://knowledgebase.progress.com/articles/Article/P181249",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Abuseat.org Block Message",
                "description" => "Se trata de un mensaje indicando que se bloqueó un correo electrónico, al detectar que se encuentra relacionado con alguna dirección IP identificada en listas negras por realizar actividades de SPAM.\n\nLo anterior puede suceder debido a que en tiempos recientes, el SPAM en internet ha aumentado considerablemente, por lo que muchos proveedores han tenido que tomar medidas para mantener controlado el SPAM excesivo en los buzones de correo.\n\nExisten diversas listas negras que pueden utilizarse para bloquear correo electrónico, tales como:\n• SPAMHAUS.\n• NJABL.\n• CBL.\n• SORBS.\n• DSBL.\n• SPAMCOP.",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Identificar el equipo responsable del tráfico generado.\n-Analizar el equipo con un software Antivirus completamente actualizado, para descartar la presencia de algún Malware que intente usar el correo electrónico como medio de infección hacia otros equipos de la red.\n-Analizar si el tráfico de los mensajes de correo a los cuales se les esta restringiendo la comunicación sean confiables y no se encuentras registrados en alguna blocklist.\n-Corroborar que la IP o dominio del correo electrónico institucional no se encuentre en reportado en alguna BlockList en el sitio \"cbl.abuseat.org\".",
                "risk" => "El equipo puede ser infectado por algun malware si recibe los mensajes de una direccion reportada.\nEl equipo podria ya estar infectado y ser el generador de los mensajes de spam, y crear mala fama al dominio de correo de la emrpesa.",
                "reference" => "http://www.correobloqueado.es/\nhttp://cbl.abuseat.org/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Adware.Gen5 Reporting",
                "description" => "Adware.Gen5 está catalogado como un programa potencialmente no deseado (PUP por sus siglas en inglés) que realiza cambios indeseados al sistema comprometiendo el rendimiento general de la navegación.\n\nModifica las principales configuraciones de los navegadores web, despliega ventanas con publicidad y recopila información personal sobre los hábitos de navegación del usuario. Se propaga mediante la instalación de software descargado desde Internet y su instalación se da sin consentimiento del usuario.",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Identificar el equipo responsable del tráfico generado.\n-Analizar el equipo con un software Adware Cleaner completamente actualizado, para descartar la presencia del Adware.",
                "risk" => "Entorpecer el trabajo de los usuarios.\nAbre la puerta a infecciones de otro tipo de malware.\nSe puede terminar con programas ocultos que son difíciles de eliminar.\nPuede mandar publicidad de sitios, indeseados.",
                "reference" => "http://www.vsantivirus.com/adware-gen.htm",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Adware.Win32/SProtector.A Client Checkin",
                "description" => "Sprotector es un programa potencialmente no deseado (PUP) diseñado para proteger sus programas asociados y asegurarse que permanezcan instalados y sin cambios realizados por otros programas. \n\nEste Adware forma parte de Search Assistant SProtect Program, y es desarrollado por Search Assistant WebSearch, conocida por sus programas maliciosos. De estar infectado el equipo mostrara dos procesos con el nombre “SProtector.exe”.\n\nSProtector.exe tiene 9 versiones conocidas, siendo la más reciente la 1.5.0.71 y se ejecuta con los privilegios de la cuenta de usuario utilizada. Usualmente se instala junto con aplicaciones de terceros y sin conocimiento del usuario\n\nPresenta características maliciosas, tales como: realizar cambios indeseados al sistema comprometiendo el rendimiento general de la navegación y modificar las principales configuraciones de los navegadores web sin permitir regresarlas a su estado original.",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Identificar el equipo responsable del tráfico generado.\n-Desinstalar los complementos desconocidos en los navegadores web, usualmente dentro de la sección de plugins o en su defecto extensiones.\n-Detener el proceso que se ejecuta en segundo plano con el nombre de Sprotector.exe\n-Analizar el equipo con un software Adware Cleaner completamente actualizado, para descartar la presencia del Adware.",
                "risk" => "Entorpecer el trabajo de los usuarios.\nAbre la puerta a infecciones de otro tipo de malware.\nSe puede terminar con programas ocultos que son difíciles de eliminar.\nPuede mandar publicidad de sitios, indeseados.",
                "reference" => "http://malwaretips.com/blogs/sprotector-exe-virus-removal/\nhttp://greatis.com/blog/adware/saveshare-sprotector-dll.htm",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "GPL DNS named version attempt",
                "description" => null,
                "recommendation" => "Actualizar el sistema del servidor DNS. Modificar los parámetros en el servidor DNS para mantener la seguridad en el servidor ocultando la versión de Bind.\n\nModificar el archivo named.conf para que las consultas de este tipo no regresen la versión del servidor DNS. \noptions[version “NONE”;}",
                "risk" => "Provocar fuga de información, adquirir codigo malicioso, e incluso acceso remoto formando porte de una botnet.",
                "reference" => "http://www.cisco.com/web/about/security/intelligence/dns-bcp.html\nhttp://www.dnsinspect.com/articles/hide-version.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Adware-Win32/EoRezo Reporting",
                "description" => "EoRezo se encuentra catalogado como un PUP (Programa Potencialmente no Deseado) por sus iniciales en inglés. Los programas no deseados tienen la habilidad de realizar cambios en el equipo o en los navegadores web sin consentimiento del usuario. \n\nEn este caso, Win32/EoRezo puede instalar otros Adware, barras de herramientas, redireccionar el tráfico o secuestrar el navegador web (realizar cambios a las configuraciones, por ejemplo, cambiar la página de inicio).\n\nSe puede encontrar dicho Adware desde diversas fuentes como pueden ser:\n• Links maliciosos.\n• Mensajes SPAM de correo electrónico.\n• Conexiones punto a punto (P2P).",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Identificar el equipo responsable del tráfico generado.\n-Revisar la existencia de la siguiente entrada en el registro, en caso de existir eliminarla.\n     -HKLM\\Software\\EoRezo\n-Analizar el equipo con un software Adware Cleaner completamente actualizado, para descartar la presencia del Adware.",
                "risk" => "Entorpecer el trabajo de los usuarios.\nAbre la puerta a infecciones de otro tipo de malware.\nSe puede terminar con programas ocultos que son difíciles de eliminar.\nPuede mandar publicidad de sitios, indeseados.",
                "reference" => "https://www.microsoft.com/security/portal/threat/encyclopedia/entry.aspx?Name=Adware:Win32/EoRezo#tab=2",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Alexa Search Toolbar User-Agent 2",
                "description" => "Alexa-Toolbar es un Adware que añade una barra de herramientas al navegador web, modificando la configuración del mismo, de modo que las búsquedas por defecto se realizan en la página de búsqueda de Alexa. Después, estas búsquedas realizadas por el usuario son enviadas a la empresa Alexa, que utiliza esta información para generar distintas estadísticas.\n\nDicha barra de herramientas crea los archivos ALXRES.DLL y ALXTB1.DLL en la carpeta de Windows, además de varios archivos en la subcarpeta ALEXA TOOLBAR, creada dentro de la carpeta Archivos de Programa.\nTambién crea las siguientes entradas en el Registro de Windows:\n\nHKEY_LOCAL_MACHINE\\ Software\\ Alexa Toolbar\nHKEY_LOCAL_MACHINE\\ Software\\ Alexa Internet",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Identificar el equipo responsable del tráfico generado, verificar que la barra de herramientas se encuentre instalada y proceder a la inmediata desinstalación.\n-Desinstalar los complementos generados en los navegadores web, usualmente dentro de la sección de plugins o en su defecto extensiones.\n-Buscar y eliminar los siguientes registros en el sistema.\n     -HKEY_LOCAL_MACHINE\\ Software\\ Alexa Toolbar\n     -HKEY_LOCAL_MACHINE\\ Software\\ Alexa Internet\n-Analizar el equipo con un software Antivirus completamente actualizado, para descartar la presencia de Malware.",
                "risk" => "Entorpecer el trabajo de los usuarios.\nEl usuario puede ser víctima de phishing.\nRobo de contraseñas.\nPerdida de información sensible.\nAbre la puerta a infecciones de otro tipo de malware.\nUtiliza innecesariamente recursos del sistema, entorpeciendo el desempeño del mismo.",
                "reference" => "http://www.pandasecurity.com/spain/homeusers/security-info/50399/information/Alexa-Toolbar",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Alexa Search Toolbar User-Agent 2 (Alexa Toolbar)",
                "description" => "Se identificó en la cabecera User-Agent el uso de la barra de búsqueda \"Alexa Toolbar\".\nAlexa Toolbar proporciona informaciones variadas sobre sitios, como el ranking de tráfico, evaluaciones de usuarios y datos similares, sin embargo está catalogado como un programa potencialmente indeseado (PUP por sus siglas en inglés) ya que modifica la configuración de los navegadores web, recopila información, hábitos de navegación del usuario, entre otros.\nAlexa Toolbar generalmente se instala como complemento de software descargado desde sitios contenedores de diversos programas; aunque también puede descargarse e instalarse desde su página oficial (http://www.alexa.com/toolbar).",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Identificar el equipo responsable del tráfico generado, verificar que la barra de herramientas se encuentre instalada y proceder a la inmediata desinstalación.\n-Desinstalar los complementos generados en los navegadores web, usualmente dentro de la sección de plugins o en su defecto extensiones.\n-Buscar y eliminar los siguientes registros en el sistema.\n     -HKEY_LOCAL_MACHINE\\ Software\\ Alexa Toolbar\n     -HKEY_LOCAL_MACHINE\\ Software\\ Alexa Internet\n-Analizar el equipo con un software Antivirus completamente actualizado, para descartar la presencia de Malware.",
                "risk" => "Entorpecer el trabajo de los usuarios.\nEl usuario puede ser víctima de phishing.\nRobo de contraseñas.\nPerdida de información sensible.\nAbre la puerta a infecciones de otro tipo de malware.\nUtiliza innecesariamente recursos del sistema, entorpeciendo el desempeño del mismo.",
                "reference" => "http://www.pandasecurity.com/spain/homeusers/security-info/50399/information/Alexa-Toolbar",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "All Numerical .cn Domain Likely Malware Related",
                "description" => "Consultas dirigidas hacia dominios .cn, dichos dominios pertenecen al país de la República popular de China y en gran cantidad se encuentran catalogados como sitios maliciosos.\nSe identificaron peticiones hacia el dominio \"360.cn\" catalogado como sitio malicioso. Este sitio está relacionado con hao.360.cn la cual se instala como una extensión de los navegadores mostrando anuncios publicitarios relacionados con los hábitos de navegación del usuario, está clasificado como un programa potencialmente indeseado (PUP por sus siglas en inglés) ya que modifica la configuración de los navegadores web, recopila información, hábitos de navegación del usuario, entre otros.",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Validar que el dominio al cual se realizaron las peticiones DNS sea autentico y se encuentre permitido dentro de las políticas de uso de equipo de la institución.\n-Analizar el equipo que origina las peticiones con un antivirus completamente actualizado, para eliminar todo tipo de amenaza por infección de Malware.\n-En el caso de que el sitio web no esté permitido se recomienda bloquear el dominio en el equipo mediante el Firewall de Windows o con la utilería Iptables para sistemas Linux.\n-De contar con un servidor de filtrado de contenido, bloquear los dominios identificados en estas peticiones.",
                "risk" => "Se hacen peticiones a un sitio web que infectara al equipo con algún tipo de malware.\nEl equipo ya está infectado por algún Bot y trata de enviar información a la Botnet que recolecto de equipo o para solicitar instrucciones.\nPermita el acceso a otro tipo de malware más dañino.",
                "reference" => "https://www.cert.org/blogs/certcc/post.cfm?EntryID=55",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Bittorrent P2P Client User-Agent (Blizzard Downloader 2.x)",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Validar que el uso del software de Blizzard esté permitido en las políticas de uso de equipo de la institución.\n-De no ser permitidas estas aplicaciones se recomienda identificar el equipo donde se detectó la alerta y proceder a desinstalarlas inmediatamente, así como cualquier otro software clientes de redes P2P.\n-Analizar el equipo con un software Antivirus completamente actualizado, para descartar la presencia de Malware.",
                "risk" => "Recepción de archivos con código malicioso.\nRecepción de archivos falsos.\nViolar la propiedad intelectual con archivos de contenido de dudosa procedencia.\nPerdida de información sensible.\nUso de recursos del sistema innecesario.\nSaturar el tráfico en la red.\nEl uso de estos programas aumenta la probabilidad de recibir ataques.",
                "reference" => "https://www.udayton.edu/udit/accounts_access/p2p.php\nhttp://eu.blizzard.com/es-es/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "All Numerical .ru Domain Likely Malware Related",
                "description" => "Consultas dirigidas hacia dominios .ru, dichos dominios pertenecen al país de Rusia y diversos dominios se encuentran catalogados como sitios maliciosos.\nAlgunos sitios como soaksoak.ru han sido catalogados como grandes distribuidores de malware afectando gran cantidad de equipos.\n",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Validar que el dominio al cual se realizaron las peticiones DNS sea autentico y se encuentre permitido dentro de las políticas de uso de equipo de la institución.\n-Analizar el equipo que origina las peticiones con un antivirus completamente actualizado, para eliminar todo tipo de amenaza por infección de Malware.\n-En el caso de que el sitio web no esté permitido se recomienda bloquear el dominio en el equipo mediante el Firewall de Windows o con la utilería Iptables para sistemas Linux.\n-De contar con un servidor de filtrado de contenido, bloquear los dominios identificados en estas peticiones.",
                "risk" => "Se hacen peticiones a un sitio web que infectara al equipo con algún tipo de malware.\nEl equipo ya está infectado por algún Bot y trata de enviar información a la Botnet que recolecto de equipo o para solicitar instrucciones.\nPermita el acceso a otro tipo de malware más dañino.",
                "reference" => "http://garwarner.blogspot.mx/2014_06_01_archive.html\nhttp://www.malwaredomainlist.com/mdl.php",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "CURRENT_EVENTS Cushion Redirection",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Identificar el equipo que genera el tráfico.\n-Analizar el equipo con un antivirus completamente actualizado, para eliminar todo tipo de amenaza por infección de Malware.\n-Validar que el dominio con el cual se establece la comunicación, es legítimo, y está permitido dentro de las políticas de uso de equipo de la institución.\n-De lo contrario se recomienda:\n     -Se recomienda bloquear el dominio en el equipo mediante el Firewall de Windows o con la utilería Iptables para sistemas Linux.\n     -De contar con un servidor de filtrado de contenido, bloquear los dominios identificados en estas peticiones.",
                "risk" => "Redirigir las consultas hacia páginas Web no deseadas.\nExponer el equipo a una infección por malware.\nInstalación de programas dañinos sin el conocimiento del usuario.\nEjecución de scripts con el propósito de obtener información del equipo.\nRedirigir el tráfico hacia sitios inseguros donde un atacante puede robar la información transmitida.",
                "reference" => "http://latam.kaspersky.com/mx/internet-security-center/internet-safety/cybersquatting",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "allow_url_include PHP config option in uri",
                "description" => "Se trata de una vulnerabilidad que afecta a servidores web, la cual permite la posibilidad de ingresar archivos PHP de manera remota a través de una URL en lugar de una ruta de archivo local como generalmente se realiza.\nLa vulnerabilidad se encuentra en el módulo de allow_url_include en PHP, el cual de encontrarse habilitado puede dar inicio a un ataque de inyección de código PHP que permita descargar, modificar o borrar archivos del servidor web.",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\nVerificar si la conexión establecida con el servidor es legítima.\nSi la conexión establecida no es de confianza bloquear la dirección IP publica en el firewall desde la cual se realiza el intento de inyección de código.\nDirigirnos al archivo php.ini y asegurarnos que la opción allow_url_include este igualada a off\nRealizar la misma operación mencionada anteriormente para el archivo el archivo de configuración de apache httpd.conf (php_flag allow_url_include off).\nVerificar que el uso de la directiva “allow_url_fopen”, de no ser utilizada deshabilitarla.\nMantener el servidor instalado con las más recientes actualizaciones para sistema operativo y programas.",
                "risk" => "Esta directiva permite la recuperación de datos de forma remota.\nExtracción de información sensible del servidor.\nSi no se valida correctamente las entradas de usuario se pueden incluir archivos al servidor de forma remota.\nProvocar una denegación de servicios.\nPermite visualizar archivos del servidor a través de una llamada vía URL.\nPermite la ejecución de scripts que puedan poner el riesgo la información dentro del servidor.",
                "reference" => "http://phpsec.org/projects/phpsecinfo/tests/allow_url_include.html\nhttp://acunetix.com/vulnerabilities/web/php-allow_url_include-enabled",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Andromeda Checkin",
                "description" => "Se trata de un troyano que se transmite de manera muy sencilla mediante dispositivos extraíbles como USB o incluso descargado desde Internet como una aplicación legítima.\nComo característica, después de descifrar el archivo que contiene el troyano se puede observar la siguiente leyenda:\n\"-= The Andromeda Strain >- Version 1.00\"\n\"By : Crypt Keeper\"\n\"Mission Complete... Have fun with your virus(es)\"\n\"\\ANDROM.SEC *.COM\"\n\"RUNME.COM COMMAND.COM SCAN.EXE CLEAN.EXE NAV.EXE NAV_._NO\"\nEl troyano Andromeda tiene diversas características entre las cuales está dar inicio a una botnet conocida con el mismo nombre, la cual puede distribuir malware o tomar control total de nuestro equipo poniendo en riesgo la seguridad del equipo y la red en general.",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Identificar el equipo de origen de los paquetes.\n-Revisar la existencia de los archivos:\n      -andi.exe\n      -msetqo.cmd\nIndicador del posible contagio de Malware.\n-Proceder a eliminar el archivo mencionado en el punto anterior.\n-Eliminar la siguiente entrada en el registro:\n      -HKLM\\SOFTWARE\\Microsoft\\Windows\\CurrentVersion\\policies\\Explorer\\Run\\\n      -Con valor: 41470\n-Analizar el equipo con un antivirus completamente actualizado, para eliminar todo tipo de amenaza por Malware.\n-Restablezca la configuración de los exploradores Web.",
                "risk" => "Deshabilita los sistemas de seguridad en el equipo, lo cual lo deja expuesto a contagios de otros malware.\nSe contagia a los demás equipos usando la red de datos, también puede contagiarse por los dispositivos extraíbles.\nDeshabilita cualquier antivirus que se encuentre instalado.\nCambia la configuración para que el usuario no pueda ver los archivos ocultos del sistema.\nPuede propagarse por los recursos en red, usando las credenciales del equipo infectado en el cual se encuentra.\nRobo de información financiera.\nRobo de registros de clientes, planos, guías de productos, etc.",
                "reference" => "http://www.securitystronghold.com/es/gates/remove-win32-andromeda.html\nhttp://blog.trendmicro.com/trendlabs-security-intelligence/andromeda-botnet-resurfaces/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "AnnonceScriptHP SQL Injection Attempt -- email.php id SELECT",
                "description" => "Una de las vulnerabilidades de los scripts de PHP es “SQL inyection”. Este ataque consiste en inyectar código SQL ajeno en una consulta ya programada, con el fin de alterar el funcionamiento de la base de datos. Estas alteraciones podrían producir fuga, modificación o borrado de la información en la base de datos.\nEstos ataques se aprovechan principalmente de las vulnerabilidades en los siguientes parámetros:\n• email.php: id\n• voirannonce.php: no\n• /admin/admin_membre/fiche_membre.php: idmembre\n• /admin/admin_annonce/okvalannonce.php: idannonce\n• /admin/admin_annonce/changeannonce.php: idannonce",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Identificar el equipo involucrado en el tráfico entrante.\n-Verificar que se trabaja con AnnonceScriptHP.\n-Analizar el archivo index.php.\n- Editar el código fuente para asegurar que las entradas son verificadas apropiadamente.\n     -En especial el parámetro \"email.php: id\".\n-Bloquear en el Firewall perimetral la dirección IP desde donde se recibió el ataque.",
                "risk" => "Acceder a la aplicación sin tener nombre de usuario ni contraseña.\nAveriguar el nombre de los campos.\nAveriguar el nombre de las tablas.\nAveriguar el contenido de los registros.\nAñadir nuevos usuarios.\nBorrar información de la base de datos.\nRobar información importante para la institución.\nProvocar una denegación de servicios.\nSuplantación de identidad.\nDivulgar información confidencial.",
                "reference" => "http://www.cvedetails.com/vulnerability-list/vendor_id-5603/product_id-9471/version_id-39008/Scriptphp-Annoncescripthp-2.0.html\nhttps://www.juniper.net/security/auto/vulnerabilities/vuln21514.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "AnnonceScriptHP SQL Injection Attempt -- email.php id UNION SELECT",
                "description" => "Una de las vulnerabilidades de los scripts de PHP es “SQL inyection”. Este ataque consiste en inyectar código SQL ajeno en una consulta ya programada, con el fin de alterar el funcionamiento de la base de datos. Estas alteraciones podrían producir fuga, modificación o borrado de la información en la base de datos.\nEstos ataques se aprovechan principalmente de las vulnerabilidades en los siguientes parámetros:\n• email.php: id\n• voirannonce.php: no\n• /admin/admin_membre/fiche_membre.php: idmembre\n• /admin/admin_annonce/okvalannonce.php: idannonce\n• /admin/admin_annonce/changeannonce.php: idannonce",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Identificar el equipo involucrado en el tráfico entrante.\n-Verificar que se trabaja con AnnonceScriptHP.\n-Analizar el archivo index.php.\n- Editar el código fuente para asegurar que las entradas son verificadas apropiadamente.\n     -En especial el parámetro \"email.php: id\".\n-Bloquear en el Firewall perimetral la dirección IP desde donde se recibió el ataque.",
                "risk" => "Acceder a la aplicación sin tener nombre de usuario ni contraseña.\nAveriguar el nombre de los campos.\nAveriguar el nombre de las tablas.\nAveriguar el contenido de los registros.\nAñadir nuevos usuarios.\nBorrar información de la base de datos.\nRobar información importante para la institución.\nProvocar una denegación de servicios.\nSuplantación de identidad.\nDivulgar información confidencial.",
                "reference" => "http://www.cvedetails.com/vulnerability-list/vendor_id-5603/product_id-9471/version_id-39008/Scriptphp-Annoncescripthp-2.0.html\nhttps://www.juniper.net/security/auto/vulnerabilities/vuln21514.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "CURRENT_EVENTS TDS Sutra - request in.cgi",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Identificar el equipo responsable del tráfico generado.\n-Actualizar el sistema operativo del equipo, así como las aplicaciones y navegadores web.\n-Deshabilitar la ejecución de scripts en los navegadores.\n-Analizar el equipo con un software Antivirus completamente actualizado, para descartar la presencia de Malware.",
                "risk" => "Redirigir las consultas hacia páginas Web no deseadas.\nExponer el equipo a una infección por malware.\nInstalación de programas dañinos sin el conocimiento del usuario.\nEjecución de scripts con el propósito de obtener información del equipo.\nRedirigir el tráfico hacia sitios inseguros donde un atacante puede robar la información transmitida.",
                "reference" => "http://www.symantec.com/security_response/attacksignatures/detail.jsp?asid=25812\nhttps://it.usu.edu/computer-security/internet-skeptic-blog/articleID=19429",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "APPS Eclectic Designs CascadianFAQ SQL Injection Attempt -- index.php catid UNION SELECT",
                "description" => "Una vulnerabilidad fue encontrada en Eclectic Designs CascadianFAQ 4.1 y clasificada como crítica que afecta a una función del archivo ”index.php”, a través de la manipulación del parámetro “catid” de un input que no ha sido validado correctamente, se puede explotar dicha vulnerabilidad mediante un ataque de SQL injection.\n\nEste ataque consiste en inyectar código SQL ajeno en una consulta ya programada, con el fin de alterar el funcionamiento de la base de datos. Estas alteraciones podrían producir fuga, modificación o borrado de la información en la base de datos.\n\nEste problema afecta a la versión 4.1 y anteriores.",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Identificar el equipo involucrado en el tráfico entrante.\n-Verificar que se trabaja con el gestor de contenido Eclectic Designs CascadianFAQ 4.1.\n-Analizar el archivo index.php.\n- Editar el código fuente para asegurar que las entradas son verificadas apropiadamente.\n     -En especial el parámetro \"catid\" y \"qid\".\n-Bloquear en el Firewall perimetral la dirección IP desde donde se recibió el ataque.",
                "risk" => "Acceder a la aplicación sin tener nombre de usuario ni contraseña.\nAveriguar el nombre de los campos.\nAveriguar el nombre de las tablas.\nAveriguar el contenido de los registros.\nAñadir nuevos usuarios.\nBorrar información de la base de datos.\nRobar información importante para la institución.\nProvocar una denegación de servicios.\nSuplantación de identidad.\nDivulgar información confidencial.",
                "reference" => "http://www.scip.ch/es/?vuldb.34755\nhttp://www.juniper.net/security/auto/vulnerabilities/vuln22314.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "APPS iWare Professional SQL Injection Attempt -- index.php D UNION SELECT",
                "description" => "Una vulnerabilidad fue encontrada en iWare Professional, la cual afecta a una función del archivo “index.php” través de la manipulación del parámetro “D” de un input que no ha sido correctamente validado, se puede explotar dicha vulnerabilidad mediante una ataque de SQL injection.\n\nEste ataque consiste en inyectar código SQL ajeno en una consulta ya programada, con el fin de alterar el funcionamiento de la base de datos. Estas alteraciones podrían producir fuga, modificación o borrado de la información en la base de datos.\n",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Identificar el equipo involucrado en el tráfico entrante.\n-Verificar que se trabaja con el gestor de contenido iWare.\n-Analizar el archivo index.php.\n- Editar el código fuente para asegurar que las entradas son verificadas apropiadamente.\n     -En especial el parámetro \"D\".\n-Bloquear en el Firewall perimetral la dirección IP desde donde se recibió el ataque.",
                "risk" => "Acceder a la aplicación sin tener nombre de usuario ni contraseña.\nAveriguar el nombre de los campos.\nAveriguar el nombre de las tablas.\nAveriguar el contenido de los registros.\nAñadir nuevos usuarios.\nBorrar información de la base de datos.\nRobar información importante para la institución.\nProvocar una denegación de servicios.\nSuplantación de identidad.\nDivulgar información confidencial.",
                "reference" => "http://www.scip.ch/es/?vuldb.33756\nhttps://www.juniper.net/security/auto/vulnerabilities/vuln21467.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "APPS Jetbox CMS SQL Injection Attempt -- index.php view UNION SELECT",
                "description" => "Una vulnerabilidad fue encontrada en JetBox CMS, la cual afecta a una función del archivo “index.php” a través de la manipulación del componente “login” de una entrada que no ha sido correctamente validada, se puede explotar dicha vulnerabilidad mediante un ataque de SQL injection.\nEste ataque consiste en inyectar código SQL ajeno en una consulta ya programada, con el fin de alterar el funcionamiento de la base de datos. Estas alteraciones podrían producir fuga, modificación o borrado de la información en la base de datos.\n\nEsta vulnerabilidad afecta a Jetbox CMS 2.1, otras versiones podrían presentar esta vulnerabilidad pero no han sido confirmadas.",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Identificar el equipo involucrado en el tráfico entrante.\n-Verificar que se trabaja con el gestor de contenido Jetbox.\n-Analizar el archivo index.php.\n- Editar el código fuente para asegurar que las entradas son verificadas apropiadamente.\n     -En especial los parámetros del \"login\"\n-Bloquear en el Firewall perimetral la dirección IP desde donde se recibió el ataque.",
                "risk" => "Acceder a la aplicación sin tener nombre de usuario ni contraseña.\nAveriguar el nombre de los campos.\nAveriguar el nombre de las tablas.\nAveriguar el contenido de los registros.\nAñadir nuevos usuarios.\nBorrar información de la base de datos.\nRobar información importante para la institución.\nProvocar una denegación de servicios.\nSuplantación de identidad.\nDivulgar información confidencial.",
                "reference" => "http://www.scip.ch/es/?vuldb.36894\nhttps://www.juniper.net/security/auto/vulnerabilities/vuln24095.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "APPS ScriptMagix Jokes SQL Injection Attempt -- index.php catid UNION SELECT",
                "description" => "Esta regla se presenta debido a la detención de Jokes, que es una aplicación que permite a los usuarios ver y calificar bromas.Esta aplicacion es desarrollada por ScriptMagix y se implementan en PHP .\n\nEstas aplicaciones son propensas a una vulnerabilidad de inyección SQL porque no logran sanear suficientemente los datos suministrados por el usuario en el parámetro ' catid ' de  ' index.php ' antes de utilizarlo en una consulta SQL.   La regla nos dice que se esta intentando explotar esta vulnerabilidad utilizando como parte de la consulta.\n\nLa explotación de esta vulnerabilidad podría permitir a un atacante remoto realizar la insercion de información dentro de una consulta a la base de datos , lo que resulta en la modificación de la lógica de consulta o realizar otros ataques .\n\nUn éxito de este exploit puede permitir a un atacante comprometer la aplicación , el acceso y modificación de datos y/o explotar vulnerabilidades latentes en la aplicación de base de datos subyacente.                                                                                                                              ",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Identificar el equipo involucrado en el tráfico entrante.\n-Verificar que se implementa ScriptMagix Jokes en sus versiones 2.0 o anterior.\n-Analizar el archivo index.php.\n- Editar el código fuente para asegurar que las entradas son verificadas apropiadamente.\n     -En especial el parámetro \"catid\".\n-Bloquear en el Firewall perimetral la dirección IP desde donde se recibió el ataque.",
                "risk" => "Acceder a la aplicación sin tener nombre de usuario ni contraseña.\nAveriguar el nombre de los campos.\nAveriguar el nombre de las tablas.\nAveriguar el contenido de los registros.\nAñadir nuevos usuarios.\nBorrar información de la base de datos.\nRobar información importante para la institución.\nProvocar una denegación de servicios.\nSuplantación de identidad.\nDivulgar información confidencial.",
                "reference" => "https://www.juniper.net/security/auto/vulnerabilities/vuln23015.html     \nhttps://www.exploit-db.com/exploits/3510/\nhttp://www.scip.ch/es/?vuldb.35793\nhttps://packetstormsecurity.com/files/55148/sa24595.txt\nhttp://web.ontuts.com/tutoriales/validar-y-sanear-datos-en-php/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "CWS Related Installer",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Identificar el equipo que genera el tráfico.\n-Analizar el equipo fuente de los mensajes con un antivirus completamente actualizado, para eliminar todo tipo de amenaza por infección de Malware.\n-Analizar el equipo fuente de los mensajes con un AntiSpyware completamente actualizado, para eliminar todo tipo de amenaza por infección de Spyware.",
                "risk" => "La presencia de un spyware en un equipo representa una alarmante posibilidad de fuga de información sensible.\nCapturan preferencias de navegación.\nPueden representar un robo de credenciales del usuario, códigos de seguridad, contraseñas.",
                "reference" => "https://www.snort.org/rule_docs/6481",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Autoit Windows Automation tool User-Agent in HTTP Request",
                "description" => "Esta regla se presenta debido a la detección de un agente en una solicitud HTTP, generado por la escritura de codigo en Autoit. AutoIt es un lenguaje de codificación que permite convertir archivos de texto en código a traves de secuencias de comandos simples. La ejecución de este codigo es bastante util para la automatización de multiples procesos, sin embargo se puede utilizar con fines maliciosos, generando la posibilidad de explotar multiples vulnerabilidades dentro de  Windows. ",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Identificar el equipo de origen de los paquetes.\n-Verificar que tenga instalado la paquetería AutoIt, de ser así validar en las políticas de uso de equipo de la institución que se permita la posesión y uso de este tipo de software.\n-En caso de ser negativo proceder a desinstalar dicha paquetería.\n-Analizar el equipo con un software Antivirus completamente actualizado, para descartar la presencia de Malware.\n-Detectar si la comunicación hacia el el servidor web está catalogada como un foco de distribución de malware. De ser así bloquear en el equipo el dominio en cuestión.",
                "risk" => "El uso de la herramienta podría estar relacionada con la creación de scripts con características similares a las de un malware, y poder propagarse internamente en la institución, con el propósito de robar información o de entorpecer las labores de los demás usuarios.",
                "reference" => "http://blog.trendmicro.com/trendlabs-security-intelligence/autoit-used-to-spread-malware-and-toolsets/    \nhttp://technotes.videreresearch.com/autoit-sample-code/autoit-http-post-request\nhttps://www.autoitscript.com/site/autoit/\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Autoit Windows Automation tool User-Agent in HTTP Request - Possibly Hostile",
                "description" => "Esta regla se presenta debido a la detección de un agente en una solicitud HTTP, generado por la escritura de codigo en Autoit. AutoIt es un lenguaje de codificación que permite convertir archivos de texto en código a traves de secuencias de comandos simples. La ejecución de este codigo es bastante util para la automatización de multiples procesos, sin embargo se puede utilizar con fines maliciosos, generando la posibilidad de explotar multiples vulnerabilidades dentro de  Windows. Debido a  que la interpretación de la solicitud ya se puede encontrar alguna instrucción maliciosa se cataloga como potencialmente dañina     ",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Identificar el equipo de origen de los paquetes.\n-Verificar que tenga instalado la paquetería AutoIt, de ser así validar en las políticas de uso de equipo de la institución que se permita la posesión y uso de este tipo de software.\n-En caso de ser negativo proceder a desinstalar dicha paquetería.\n-Analizar el equipo con un software Antivirus completamente actualizado, para descartar la presencia de Malware.\n-Detectar si la comunicación hacia el el servidor web está catalogada como un foco de distribución de malware. De ser así bloquear en el equipo el dominio en cuestión.",
                "risk" => "El uso de la herramienta podría estar relacionada con la creación de scripts con características similares a las de un malware, y poder propagarse internamente en la institución, con el propósito de robar información o de entorpecer las labores de los demás usuarios.",
                "reference" => "http://blog.trendmicro.com/trendlabs-security-intelligence/autoit-used-to-spread-malware-and-toolsets/    \nhttp://technotes.videreresearch.com/autoit-sample-code/autoit-http-post-request\nhttps://www.autoitscript.com/site/autoit/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Backdoor.Win32.Pushdo.s Checkin",
                "description" => "Esta regla se presenta debido a la detección de agentes en las cabeceras, contenido del paquete, la busqueda de directorios en la solicitud, la descarga de archivos ejecutables que son equivalentes por su valor obtenido en los algoritmos SHA1 o MD5. Este tipo de actividad está relacionada con el troyano Backdoor Win 32 Pushdo, el cual es un troyano que permite el acceso no autorizado y control de un equipo infectado, pudiendo ejecutar practicamente cualquier acción.  ",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Identificar el equipo de origen de los paquetes.\n-Revisar la existencia del archivo, C:\\documents and settings\\administrator\\pymqipomukvy.exe, indicador del posible contagio de Malware.\n-Proceder a eliminar el archivo mencionado en el punto anterior.\n-Analizar el equipo con un antivirus completamente actualizado, para eliminar todo tipo de amenaza por Malware.",
                "risk" => "Descargar y ejecutar archivos arbitrarios\nSubir archivos\nPropagarse a otros ordenadores utilizando diversos métodos de propagación\nEscuchar la entrada del teclado y robar datos sensibles\nModificar la configuración del sistema\nEjecutar o terminar aplicaciones\nBorrar archivos",
                "reference" => "https://lists.emergingthreats.net/pipermail/emerging-sigs/2013-May/021976.html   \nhttp://www.microsoft.com/security/portal/threat/encyclopedia/entry.aspx?Name=Backdoor%3AWin32%2FPushdo.A#tab=2",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Behavioral Unusual Port 135 traffic, Potential Scan or Infection",
                "description" => "El puerto 135 usualmente utilizado por el servicio RPC (Llamada a procedimiento remoto) protocolo usado para la comunican entre usuarios de forma remota.\n\nNormalmente este tipo de servicios son vulnerables antes escaneos o suelen aprovecharse de alguna falla para la ejecución de código dentro del sistema para así conseguir acceso no autorizado al servicio, lo que conlleva a que el atacante tenga control total sobre el equipo.\n\nEn este caso existen puertos que llegan a considerarse peligrosos de forma tal que pueden constituir una amenaza para el sistema si se encuentran abiertos si no se cuenta con un firewall seguro que sea capaz de proteger el equipo.\n",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Validar si las conexiones entre los equipos involucrados son legítimas de lo contrario:\n-Verificar si es necesario que los equipos con dirección IP destino tengan permitido o se encuentre dentro de sus funciones las conexiones por el puerto 135.\n-En caso de no requerir las conexiones entrantes se recomienda cerrar dicho puerto.\n      -Abrir el firewall de Windows -> Programas -> Windows firewall con seguridad avanzada -> Regla de entrada, desde aquí se podrá crear la regla para realizar el bloqueo.\n-En caso de que el servicio por el puerto 135 sea necesario, se recomienda el cumplimiento de las siguientes características de una contraseña segura: \n      -La contraseña debe constar de al menos 12 caracteres.\n      -Debe contener caracteres alfanuméricos.\n      -Debe contener caracteres especiales.\n      -Debe combinar mayúsculas y minúsculas.\n-Analizar al equipo identificado como origen, con un software antivirus  actualizado para descartar la presencia de algún malware que se encuentre realizando dicha actividad.",
                "risk" => "La vulnerabilidad del desbordamiento de búfer en el protocolo RCP, para provocar una falla y tener acceso al sistema.\nEjecutar código malicioso.\nProvocar una denegación de servicio (QoS).\nSi como control del equipo de forma remota.\nExpone el equipo a contagio por malware.\nSi el equipo está infectado, este puerto es usado para propagar la infección a través de la red.",
                "reference" => "https://technet.microsoft.com/es-es/library/cc732839(v=ws.10).aspx  \nhttp://www.vsantivirus.com/vul-rpc-dcom.htm\nhttp://ordenador.wingwit.com/Redes/other-computer-networking/78234.html#.VXmwtlKN1SQ",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "BingBar ToolBar User-Agent (BingBar)",
                "description" => "BingBar es una barra de herramientas del explorador que se instala adicionalmente con algún otro software o se puede descargar e instalar manualmente. Es conocido como un programa potencialmente indeseado (PUP por sus siglas en inglés) ya que modifica la configuración de los navegadores web. Este tipo de aplicaciones son usadas para recopilar información, así como los hábitos de navegación del usuario.\n\nLas conexiones que se realizan, se llevan a cabo desde la dirección IP origen hacia la dirección IP destino, las cuales pueden ser tanto direcciones IP privadas, como direcciones IP públicas.",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Identificar el equipo responsable, verificar que la barra de herramientas se encuentre instalada y proceder a la inmediata desinstalación.\n-Desinstalar los complementos generados en los navegadores web, usualmente dentro de la sección de plugins o en su defecto extensiones.\n-Analizar el equipo con un software Antivirus completamente actualizado, para descartar la presencia de Malware.",
                "risk" => "Entorpecer el trabajo de los usuarios.\nEl usuario puede ser víctima de phishing.\nRobo de contraseñas.\nPerdida de información sensible.\nAbre la puerta a infecciones de otro tipo de malware.\nUtiliza innecesariamente recursos del sistema, entorpeciendo el desempeño del mismo.",
                "reference" => "http://www.uninstallthat.com/uninstall-toolbars/bing-bar/\nhttp://malwaretips.com/blogs/search-with-bing-removal/\nhttp://malwaretips.com/blogs/search-with-bing-removal/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Behavioral Unusual Port 139 traffic, Potential Scan or Infection",
                "description" => "\nEl puerto 139 esta asociado al protocolo NetBIOS, este servicio es utilizado para la comunicación en una red local y es el protocolo que se encarga de compartir archivos he impresoras entre los equipos.\n\nNormalmente este tipo de vulnerabilidades relacionadas con este puerto llegan a ser peligrosos para el usuario ya que son capaces de comunicarse entre los equipos y compartir recursos en la red haciendo uso de distintas herramientas entre ellas metasploit (herramienta que proporciona información acerca de vulnerabilidades) o el radmin (software de control remoto)\n",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Validar que las conexiones entre los equipos involucrados sean legítimas.\n-Verificar si el equipo destino requiere o está dentro de sus funciones permitir las conexiones por el puerto 139, en caso de no ser necesaria la conexión se sugiere cerrar el puerto.\n-En caso de que el servicio por el puerto 139 sea necesario, se recomienda el cumplimiento de las siguientes características de una contraseña segura: \n     -La contraseña debe constar de al menos 12 caracteres.\n     -Debe contener caracteres alfanuméricos.\n     -Debe contener caracteres especiales.\n     -Debe combinar mayúsculas y minúsculas.\n-Identificar al equipo de origen y analizarlo por medio de un software antivirus actualizado para descartar la existencia de algún tipo de malware.",
                "risk" => "El puerto normalmente se ocupa por NetBios para intercambio de archivos, de no estar bien configurado representa una puerta abierta para ataques.\nExpone el equipo a contagio por malware.\nSi el equipo está infectado, este puerto es usado para propagar la infección a través de la red.",
                "reference" => "http://www.poralliresopla.com/2015/03/como-asegurar-windows-xp-cerrar-puertos-vulnerables.html\nhttp://kb.eset-la.com/esetkb/index?page=content&id=SOLN2907&querysource=external_es&locale=es_ES\nhttp://www.portalhacker.net/b2/entrar-pc-por-netbios/188/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Behavioral Unusual Port 1433 traffic, Potential Scan or Infection",
                "description" => "El puerto 1433 generalmente es utilizado para los servicios de Microsoft SQL Server. Dicho puerto permite al usuario comunicarse al servidor de base de datos SQL permitiendo ataques hacia el servidor.\n\nComunmente este tipo de ataques lo que hace es buscar vulnerabilidades en el sistema con el uso de herramientas adecuadas, en este caso el uso de un exploit y así poder inyectar código dentro del sistema y poder tener el control \n\n",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Validar que las conexiones entre los equipos involucrados sean legítimas.\n-Verificar si es necesario que los equipos tengan abierto el puerto 1433, de lo contrario, se sugiere cerrar el puerto.\n     -Bloquear el puerto en el firewall de Windows:\n          -Abrir el firewall de Windows -> Programas -> Windows firewall con seguridad avanzada -> Regla de entrada, desde aquí se podrá crear la regla para realizar el bloqueo.\n-Identificar los equipos relacionados en la comunicación y analizarlos por medio de un software antivirus actualizado para descartar la existencia de algún tipo de malware en el equipo.",
                "risk" => "El dejar expuestos estos puertos implica un gran riesgo, ya que son los puestos que ocupan los clientes para conectarse al servidor de base de datos SQL server.\nPuede provocar robo de información.\nFuga de información sensible.\nDenegación de servicios (QoS).\nExponen el equipo a contagio por malware.",
                "reference" => "http://panicoenlaxbox.blogspot.com/2012/02/basado-en-hechos-reales-como-proteger.html\nhttp://ciberentropia.blogspot.mx/2013/09/mssql-xpcmdshell-set.html\nhttp://www.speedguide.net/port.php?port=1433",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "BitTorrent DHT ping request",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Validar que el uso del software para clientes de redes P2P esté permitido en las políticas de uso de equipo de la institución.\n-De no ser permitidas estas aplicaciones se recomienda identificar el equipo donde se detectó el anuncio de un nodo P2P y proceder a la desinstalación inmediata del software cliente.\n-Analizar el equipo con un software Antivirus completamente actualizado, para descartar la presencia de Malware.\n-Bloquear desde el Firewall los puertos comunes de acceso a BitTorrent 6881 y 6889.\n-En casos de Firewalls de Nueva Generación, diseñar políticas que bloqueen el acceso a aplicaciones P2P e identifiquen a los usuarios que hagan uso de estos servicios de forma no autorizada.",
                "risk" => "Recepción de archivos con código malicioso.\nRecepción de archivos falsos.\nViolar la propiedad intelectual con archivos de contenido de dudosa procedencia.\nPerdida de información sensible.\nUso de recursos del sistema innecesario.\nSaturar el tráfico en la red.\nEl uso de estos programas aumenta la probabilidad de recibir ataques.",
                "reference" => "http://www.bittorrent.org/beps/bep_0005.html\nhttp://www.iss.net/security_center/reference/vuln/BitTorrent_DHT_Ping.htm\nhttps://www.udayton.edu/udit/accounts_access/p2p.php",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Behavioral Unusual Port 445 traffic, Potential Scan or Infection",
                "description" => "Se considera tráfico inusual hacia el puerto 445, ya que dicho puerto está reservado comúnmente para los servicios de Microsoft-DS, donde este servicio se emplea para la comunicación con la red local y para compartir archivos por la red.\n\nLos escaneos a dicho puerto, se emplean para obtener información con la que se pueden llegar a conocer vulnerabilidades existentes para después ser explotadas.\n\nLas conexiones se realizan entre los equipos con direcciones IP locales, que van de la dirección IP origen hacia la dirección IP destino.\n",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Validar que las conexiones entre los equipos involucrados sean legítimas.\n-Verificar que el equipo destino tiene dentro de sus funciones permitir las conexiones por el puerto 445, en caso de no ser necesaria la conexión se sugiere cerrar el puerto.\n     -Abrir el firewall de Windows -> Programas -> Windows firewall con seguridad avanzada -> Regla de entrada, desde aquí se podrá crear la regla para realizar el bloqueo.\n-Identificar el equipo de origen y realizar un análisis completo con un software antivirus actualizado en búsqueda de posibles infecciones por código malicioso",
                "risk" => "Dejar el puerto 445 abierto representa un riesgo ya que de ser comprometido por un usuario no autorizado, puede ocasionar propagación de Malware, acceso al equipo, fuga de información o acceso a diversos recursos en la red.",
                "reference" => "https://www.grc.com/port_445.htm\nhttp://www.speedguide.net/port.php?port=445\nhttp://www.seguridad.unam.mx/noticias/?noti=1401",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Behavioral Unusually fast Terminal Server Traffic, Potential Scan or Infection",
                "description" => "La detección de escaneos hacia direcciones IP privadas por el puerto 3389 por parte de direcciones IP públicas, se asociado a la aplicación de escritorio remoto del Sistema Operativo \"Windows\" que hace uso del protocolo RDP (Remote Desktop Protocol).\n\nRDP es un protocolo propietario desarrollado por Microsoft que permite la comunicación en la ejecución de una aplicación entre un terminal (mostrando la información procesada que recibe del servidor) y un servidor Windows (recibiendo la información dada por el usuario en el terminal mediante el ratón o el teclado).\n\nLa finalidad dentro del evento es el establecer conexión con el equipo bajo la dirección IP privada donde se intente explotar la vulnerabilidad conocida del protocolo RDP, realizando peticiones de conexión por el puerto 3389, hasta logra el acceso a dicho equipo.",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Validar que la comunicación entre los equipos involucrados sean legítimas.\n-Verificar el uso de cualquier tipo de software bajo el protocolo RDP.\n-En caso de existir dicho software, validar el uso de estas aplicaciones de este tipo en las políticas de uso de equipo de la institución.\n-De no ser permitidas estas aplicaciones se recomienda desinstalación inmediata de todo software que funcione sobre RDP.\n-Analizar los equipos con un software Antivirus completamente actualizado, para descartar la presencia de Malware.\n-De ser posible, resgringir el acceso a los servicios DRP únicamente a direcciones IP autorizadas para generar conexiones al equipo.",
                "risk" => "Un escaneo puede revelar información sensible acerca de los equipos de cómputo, como son datos del sistema operativo, así como puertos abiertos. Un atacante puede ocupar esta información para explotar las vulnerabilidades del sistema comprometiendo su información, pudiendo provocar una denegación de servicios o incluso el robo de información valiosa para la institución.\n\nAsí mismo, un usuario mal intencionado puede intentar ataques de diccionario o fuerza bruta para obtener acceso a los sistemas con servicio DRP expuesto; así como obtener información sobre los Dominios Windows registrados en uso.",
                "reference" => "https://support.microsoft.com/es-mx/kb/186607/es\nhttp://practicasintermedias2012usac.blogspot.mx/2012/11/remote-desktop-protocol.html\nhttp://marc.info/?l=bleeding-sigs&m=117858070509772",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Conficker.b Shellcode",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Buscar en los archivos del sistema alguno con extensión .dll, el nombre puede ser cualquiera, si no está seguro de la procedencia de dicho archivo eliminarlo.\n-Eliminar la entrada en el registro del sistema:\n     -HKCU\\Software\\Microsoft\\Windows\\CurrentVersion\\Run\n-Analizar el equipo fuente de los mensajes con un antivirus completamente actualizado, para eliminar todo tipo de amenaza por infección de Gusano.",
                "risk" => "Deshabilita los sistemas de seguridad en el equipo, lo cual lo deja expuesto a contagios de otros malware.\nPuede restaurar el sistema a un punto anterior, provocando perdida de configuración en el equipo.\nSe contagia a los demás equipos usando la red de datos, también puede contagiarse por los dispositivos extraíbles.\nDeshabilta cualquier antivirus que se encuentre instalado.\nCambia la configuración para que el usuario no pueda ver los archivos ocultos del sistema.\nPuede propagarse por los recursos en red, usando las credenciales del equipo infectado en el cual se encuentra.",
                "reference" => "http://www.microsoft.com/security/portal/threat/encyclopedia/entry.aspx?Name=Worm%3aWin32%2fConficker.B#tab=2",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "BitTorrent Announce",
                "description" => "Bittorrent es un protocolo utilizado para distribuir grandes archivos simultáneamente mediante conexiones P2P (Punto a Punto)._x000D_\n\nLas redes P2P (punto a punto) son aquellas en las que las computadoras están conectadas unas a otras a través de una red y donde se pueden compartir archivos directamente sin la necesidad de utilizar de forma forzosa un servidor dedicado, es decir, en una red P2P cada equipo puede cumplir como servidor y cliente al mismo tiempo._x000D_\n_x000D_\nLos anuncios son utilizados por los equipos para comunicar el estado de la transferencia de un archivo cuando la comunicación se da hacia un servidor dedicado, usualmente conocidos como “tracker de bittorrent”._x000D_\n _x000D_\nUn tracker puede utilizar anuncios para diversos fines, tales como difundir su URL, avisar del inicio o fin de una descarga, además el cliente puede enviar un anuncio al tracker comunicando que ha detenido la descarga.",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Validar que el uso del software para clientes de redes P2P esté permitido en las políticas de uso de equipo de la institución.\n-De no ser permitidas estas aplicaciones se recomienda identificar el equipo donde se detectó el anuncio de un nodo P2P y proceder a la desinstalación inmediata del software cliente.\n-Analizar el equipo con un software Antivirus completamente actualizado, para descartar la presencia de Malware.\n-Bloquear desde el Firewall los puertos comunes de acceso a BitTorrent 6881 y 6889.\n-En casos de Firewalls de Nueva Generación, diseñar políticas que bloqueen el acceso a aplicaciones P2P e identifiquen a los usuarios que hagan uso de estos servicios de forma no autorizada.",
                "risk" => "Recepción de archivos con código malicioso.\nRecepción de archivos falsos.\nViolar la propiedad intelectual con archivos de contenido de dudosa procedencia.\nPerdida de información sensible.\nUso de recursos del sistema innecesario.\nSaturar el tráfico en la red.\nEl uso de estos programas aumenta la probabilidad de recibir ataques.",
                "reference" => "http://www.bittorrent.org/beps/bep_0015.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "BitTorrent announce request",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Validar que el uso del software para clientes de redes P2P esté permitido en las políticas de uso de equipo de la institución.\n-De no ser permitidas estas aplicaciones se recomienda identificar el equipo donde se detectó el anuncio de un nodo P2P y proceder a la desinstalación inmediata del software cliente.\n-Analizar el equipo con un software Antivirus completamente actualizado, para descartar la presencia de Malware.\n-Bloquear desde el Firewall los puertos comunes de acceso a BitTorrent 6881 y 6889.\n-En casos de Firewalls de Nueva Generación, diseñar políticas que bloqueen el acceso a aplicaciones P2P e identifiquen a los usuarios que hagan uso de estos servicios de forma no autorizada.",
                "risk" => "Recepción de archivos con código malicioso.\nRecepción de archivos falsos.\nViolar la propiedad intelectual con archivos de contenido de dudosa procedencia.\nPerdida de información sensible.\nUso de recursos del sistema innecesario.\nSaturar el tráfico en la red.\nEl uso de estos programas aumenta la probabilidad de recibir ataques.",
                "reference" => "http://www.bittorrent.org/beps/bep_0015.html\nhttps://www.udayton.edu/udit/accounts_access/p2p.php",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "BitTorrent Traffic",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Validar que el uso del software para clientes de redes P2P esté permitido en las políticas de uso de equipo de la institución.\n-De no ser permitidas estas aplicaciones se recomienda identificar el equipo donde se detectó el anuncio de un nodo P2P y proceder a la desinstalación inmediata del software cliente.\n-Analizar el equipo con un software Antivirus completamente actualizado, para descartar la presencia de Malware.\n-Bloquear desde el Firewall los puertos comunes de acceso a BitTorrent 6881 y 6889.\n-En casos de Firewalls de Nueva Generación, diseñar políticas que bloqueen el acceso a aplicaciones P2P e identifiquen a los usuarios que hagan uso de estos servicios de forma no autorizada.",
                "risk" => "Recepción de archivos con código malicioso.\nRecepción de archivos falsos.\nViolar la propiedad intelectual con archivos de contenido de dudosa procedencia.\nPerdida de información sensible.\nUso de recursos del sistema innecesario.\nSaturar el tráfico en la red.\nEl uso de estos programas aumenta la probabilidad de recibir ataques.",
                "reference" => "http://www.protegetuinformacion.com/perfil_tema.php?id_perfil=2&id_tema=23",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Critroni Variant .onion Proxy Domain",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Identificar el equipo que genera las peticiones DNS.\n-Corroborar que el equipo cuenta con el software de Tor Browser.\n     -De ser así se procede a desinstalar la aplicación.\n-Analizar el equipo con un antivirus completamente actualizado, para eliminar todo tipo de amenaza por infección de Malware.\n-Se recomienda bloquear el dominio en el equipo mediante el Firewall de Windows o con la utilería Iptables para sistemas Linux.\n-De contar con un servidor de filtrado de contenido, bloquear los dominios identificados en estas peticiones.",
                "risk" => "El uso de este tipo de software puede generar fuga de información sensible, por ejemplo credenciales de acceso.\nSe puede tener acceso a las Cookies y obtener datos del usuario.\nTor facilita el acceso a sitios riesgosos, e infectar el equipo con Malware.\nEl acceso s a los dominos .onion puede poner en riesgo la información en el equipo, si un atacante detecta la actividad.",
                "reference" => "http://resources.infosecinstitute.com/hunting-malware-deep-web/\nhttps://tor2web.org/\nhttp://www.genbeta.com/buscadores/explora-las-paginas-onion-de-la-deep-web-con-el-buscador-onion-city",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Brontok User-Agent Detected (Brontok.A3 Browser)",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Habilitar un firewall en su ordenador.\n-Recibe las últimas actualizaciones de ordenador para todo el software instalado.\n-Utilice software antivirus completamente actualizado, para descartar la presencia de Malware.\n-Evitar la descarga de software de dudosa procedencia.\n-Revisar la existencia del siguiente archivo, de ser encontrado eliminarlo:\n     -%homepath%\\Start Menu\\Programs\\Startup\\Empty.pif\n-Revisar el registro del sistema en busca de los indicadores instalados por el gusano, y eliminar dichas entradas.\n     -HKEY_CURRENT_USER\\Software\\Microsoft\\Windows\\CurrentVersion\\Run\n          -Valor: \"Bron-Spizaetus\"\n     -HKEY_LOCAL_MACHINE\\Software\\Microsoft\\Windows\\CurrentVersion\\Run\n          -Valor: Shell \n     -HKEY_LOCAL_MACHINE\\Software\\Microsoft\\Windows NT\\CurrentVersion\\WinLogon\n          -Valor: AlternateShell\n     -HKEY_LOCAL_MACHINE\\SYSTEM\\CurrentControlSet\\Control\\SafeBoot \n          -Valor: \"AlternateShell\"=\"cmd.exe\"",
                "risk" => "Descargar y ejecutar archivos arbitrarios\nSubir archivos\nPropagarse a otros ordenadores utilizando diversos métodos de propagación\nEscuchar la entrada del teclado y robar datos sensibles\nModificar la configuración del sistema\nEjecutar o terminar aplicaciones\nBorrar archivos",
                "reference" => "https://www.microsoft.com/security/portal/threat/encyclopedia/entry.aspx?name=Win32%2fBrontok#tab=2",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Browser Search Bar User-Agent String (Babylon)",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Identificar el equipo responsable, verificar que la barra de herramientas se encuentre instalada y proceder a la inmediata desinstalación.\n-Desinstalar los complementos generados en los navegadores web, usualmente dentro de la sección de plugins o en su defecto extensiones.\n-Analizar el equipo con un software Antivirus completamente actualizado, para descartar la presencia de Malware.",
                "risk" => "Entorpecer el trabajo de los usuarios.\nEl usuario puede ser víctima de phishing.\nRobo de contraseñas.\nPerdida de información sensible.\nAbre la puerta a infecciones de otro tipo de malware.\nUtiliza innecesariamente recursos del sistema, entorpeciendo el desempeño del mismo.",
                "reference" => "http://www.pcrisk.es/guias-de-desinfeccion/6754-virus-babylon-toolbar-searchbabyloncom",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Casalemedia Spyware Reporting URL Visited 2",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Identificar el equipo responsable del tráfico.\n-Desinstalar las barras de herramientas desconocidas, así como los complementos sospechosos en los navegadores web, usualmente dentro de la sección de plugins o en su defecto extensiones.\n-Hacer una limpieza de las cookies de los exploradores Web.\n-Analizar el equipo con un software AntiSpyware completamente actualizado, para descartar la presencia de Spyware instalado en el equipo.",
                "risk" => "Entorpecer el trabajo de los usuarios.\nEl usuario puede ser víctima de phishing.\nRobo de contraseñas.\nPerdida de información sensible.\nAbre la puerta a infecciones de otro tipo de malware.\nUtiliza innecesariamente recursos del sistema, entorpeciendo el desempeño del mismo.",
                "reference" => "http://www.spyware-techie.com/casalemedia-removal-guide\nhttp://www.pandasecurity.com/mexico/homeusers/security-info/58343/information/Casalemedia",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Cleartext WordPress Login",
                "description" => null,
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n-Validar que la comunicación con el sitio web al que se hace la petición sea legítima.\n-De ser necesario ingresar a dicho sitio se recomienda solicitar al proveedor del servicio un canal seguro, para evitar que un atacante tenga acceso a la comunicación.\n-Fortalecer la seguridad en la contraseña:\n     -La contraseña debe constar de al menos 12 caracteres.\n     -Debe contener caracteres alfanuméricos.\n     -Debe contener caracteres especiales.\n     -Debe combinar mayúsculas y minúsculas.\n-Verificar que la aplicación Web este siendo expuesta a través de un puerto HTTPS.\n-Configurar el redireccionamiento de la aplicación Web para que únicamente sea accedida por el servicio seguro HTTPS.",
                "risk" => "Un atacante podría estar escuchando las transmisiones de red en ese momento y recolectar usuario y contraseña, para posteriormente realizar robo de información.\nEstas credenciales se podrían usar para borrar información o cambiar el contenido de la misma.\nSuplantación de identidad.\nFuga de información sensible.",
                "reference" => "https://hackertarget.com/attacking-wordpress/\nhttp://codex.wordpress.org/Hardening_WordPress",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "DNS Reply Sinkhole - Anubis - 195.22.26.192/26",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n\n• Realizar un análisis completo del equipo con dirección IP reportada, con un software antivirus actualizado, para descartar algún tipo de malware.\n• Bloquear el acceso al dominio reportado\n   o Desde el equipo, mediante el archivo hosts, esto varía de acuerdo al sistema operativo.\n   o En caso de contar con un servidor de filtrado de contenido web, bloquearlo.\n",
                "risk" => "Entrar en dominios maliciosos traen como consecuencia la descarga no autorizada de malware, spam, nos convierte en blacos fáciles para atacantes.",
                "reference" => "http://resources.infosecinstitute.com/dns-sinkhole/ \nhttp://linux.die.net/man/5/hosts \nhttp://www.vsantivirus.com/faq-hosts.htm\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "cmd.exe In URI - Possible Command Execution Attempt",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Identificar el equipo que esta involucrado en la comunicación.\n-Verificar que dicho equipo tiene habilitado el servicio Web y que esta publico en internet.\n     -Actualizar el sistema operativo con el que cuenta el servidor.\n     -Descargar e instalar los últimos parches para el sistema, así como para las aplicaciones existentes.\n     -Verificar que el método de procesamiento de la URL sea segura.\n     -Emplear un método confiable en el sitio Web para el envió de datos, evitar usar el método GET.\n     -Corroborar que el método para recibir datos y archivos en la aplicación Web valide el tipo de archivos que proporciona el usuario.\n-En caso de ser un servidor Web no público en internet.\n     -Identificar el equipo desde donde se realizó la comunicación.\n     -Verificar que el equipo se está ocupando de manera correcta.\n     -Analizar el equipo con un antivirus completamente actualizado, para eliminar todo tipo de amenaza por Gusano o Malware.\n-Realizar una verificación de código de las aplicaciones ejecutadas en ese servidor para validar que las entradas esten siendo sanitizadas de forma correcta para evitar inyección de código.",
                "risk" => "Fuga de información sensible.\nCambio en la configuración del servidor.\nDenegación de servicios (QoS).\nEjecución de código malicioso.\nRobo de información.",
                "reference" => "http://www.iss.net/security_center/advice/Intrusions/2000645/default.htm\nhttp://www.technicalinfo.net/papers/URLEmbeddedAttacks.html\nhttp://www.seguridad.unam.mx/documento/?id=17",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Common Adware Library ISX User Agent Detected",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Identificar el equipo responsable del tráfico, verificarla existencia de barras de herramientas se encuentre instalada y proceder a la inmediata desinstalación.\n-Desinstalar los complementos generados en los navegadores web, usualmente dentro de la sección de plugins o en su defecto extensiones.\n-Buscar en el equipo la libreria y eliminarla, usualmente se encuentra en la siguiente ruta:\n     -C: \\ Archivos de programa \\ pc performer \\ isxdl.dll\n-Analizar el equipo con un software Antivirus completamente actualizado, para descartar la presencia de Malware.",
                "risk" => "Entorpecer el trabajo de los usuarios.\nEl usuario puede ser víctima de phishing.\nRobo de contraseñas.\nPerdida de información sensible.\nAbre la puerta a infecciones de otro tipo de malware.\nUtiliza innecesariamente recursos del sistema, entorpeciendo el desempeño del mismo.",
                "reference" => "https://www.reasoncoresecurity.com/isxdl.dll-db6751d6fc8c7fde8727387fa851d54a6ae35dd2.aspx\nhttp://www.herdprotect.com/isxdl.dll-a101cb7676e3290bbe55896158e726a17b18d54d.aspx",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "COMMUNITY MISC Google Talk Logon",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Validar que el uso de la aplicación Google Talk esté permitida en las políticas de uso de equipo de la institución, en caso de no ser permitido el uso de este tipo de software se recomienda desinstalar el programa inmediatamente.",
                "risk" => "Fuga de información sensible.\nAcceso sin autorización a la red de la institución.",
                "reference" => "http://google.dirson.com/o.a/googletalk",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "CyberKit 2.2 Windows",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Identificar el equipo de origen de los paquetes y verificar que tenga instalado la paquetería Cyberkit, de ser así validar en las políticas de uso de equipo de la institución que se permita la posesión y uso de este tipo de software.\n            -De lo contrario proceder a desinstalar la aplicación del equipo.\n-Revisar la existencia del archivo, %Windir%\\system32\\drivers\\svchost.exe, indicador del posible contagio de gusano y eliminarlo.\n-Analizar el equipo con un antivirus completamente actualizado, para eliminar todo tipo de amenaza por Gusano o Malware.",
                "risk" => "Esta herramienta de red puede ayudar a una persona mal intencionada a escanear la red y detectar vulnerabilidades que posteriormente puede ocupar para realizar algún ataque.\nOtra posibilidad es un comportamiento extraño por presencia de un gusano el cual puede propagarse por la red local, y contagiar a los demás equipos de la red, pudiendo causar daños a la información de los equipos, asi como fuga de información sensible para la empresa.",
                "reference" => "http://www.snapfiles.com/get/cyberkit.html\nhttp://www.securityfocus.com/archive/129/334807/2003-08-19/2003-08-25/1\nhttp://www.symantec.com/region/mx/avcenter/data/la-w32.welchia.b.worm.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "CHAT Google Talk Logon",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n-Validar que el uso de la aplicación Google Talk esté permitida en las políticas de uso de equipo de la institución, en caso de no ser permitido el uso de este tipo de software se recomienda desinstalar el programa inmediatamente.\n-Bloquear desde el Firewall el uso de los puertos de Gtalk 5222 y 5223, así como el tráfico XMPP.",
                "risk" => "Fuga de información sensible.\nAcceso sin autorización a la red de la institución.",
                "reference" => "http://google.dirson.com/o.a/googletalk",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "CHAT IRC JOIN command",
                "description" => "\nCHAT IRC JOIN command\n\nIRC (Internet Relay Chat) es un protocolo de comunicación en tiempo real basado en texto, este tipo de chat permite la creación de canales para que su comunicación entre los usuarios sea más sencilla, la mayoría de los usuario de IRC requieren la utilización de comandos tal es el caso del comando \"JOIN\" el cual permite ingresar a un canal",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar si están permitidas este tipo de aplicaciones en las políticas de uso de equipo de cómputo y de uso de red.\n   o De estar permitidas, verificar si la actividad se encuentra dentro de las funciones del usuario.\n   o En caso de existir una política de restricción, identificar los equipos involucrados y  desinstalar cualquier aplicación no autorizada por la institución.\n• Analiza los equipos involucrados con un software antivirus actualizado para descartar la presencia de Malware debido a este tipo de aplicaciones. \n",
                "risk" => " Las vulnerabilidades detectadas permiten ejecutar cualquier comando en la máquina de la víctima, facilitando a un potencial atacante acceso total al sistema del usuario.",
                "reference" => "http://www.vsantivirus.com/kibuv-b.htm  \n\nhttp://unaaldia.hispasec.com/2001/03/graves-problemas-de-seguridad-en.html\n\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Detección de consultas a dominios dentro de blacklist .tk (Request to a Suspicious *.tk domain )",
                "description" => "La  regla detecta solicitudes buscando resolver dominio .TK, el cual es un dominio de geografia superior, referente a Tokelau, sin embargo el registro bajo este dominio es gratuito  y  debido a esto ha asendido el numero de registros en gran cantidad, es propenso al registro de sitios, o subdominios maliciosos, lo cual hace sospechosa la comunicación hacia esta denominación .  ",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Realizar un análisis completo de los equipos relacionados en el evento en búsqueda de Malware. \nBloquear el dominio reportado:\n   o En el archivo “hosts” del equipo reportado.\n   o En caso de contar con un servidor de filtrado de contenido web, bloquearlo.",
                "risk" => "El ingreso a dominios reportados en blacklist puede causar que el equipo se infecte con algún tipo de código malicioso comprometiendo así la seguridad de los recursos que maneja. Además de propicias fuga de información y denegación de servicio.",
                "reference" => "http://www.darkreading.com/risk/tk-is-growing-exponentially-to-become-the-largest-and-safest-country-code-domain-in-2012/d/d-id/1136864?\nhttp://www.welivesecurity.com/la-es/2011/05/03/el-dominio-tk-como-una-pequena-isla-es-el-centro-del-cibercrimen/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "CHAT IRC NICK command",
                "description" => "\nCHAT IRC NICK command\n\nIRC (Internet Relay Chat) es un protocolo de comunicación en tiempo real basado en texto, este tipo de chat permite la creación de canales para que su comunicación entre los usuarios sea más sencilla, la mayoría de los usuario de IRC requieren la utilización de comandos tal es el caso del comando \"NICK\" el cual permite cambiar el pseudónimo del usuario con el que se conocerá.\n",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar si están permitidas este tipo de aplicaciones en las políticas de uso de equipo de cómputo y de uso de red.\n   o De estar permitidas, verificar si la actividad se encuentra dentro de las funciones del usuario.\n   o En caso de existir una política de restricción, identificar los equipos involucrados y  desinstalar cualquier aplicación no autorizada por la institución.\n• Analiza los equipos involucrados con un software antivirus actualizado para descartar la presencia de Malware debido a este tipo de aplicaciones. \n",
                "risk" => " Las vulnerabilidades detectadas permiten ejecutar cualquier comando en la máquina de la víctima, facilitando a un potencial atacante acceso total al sistema del usuario.",
                "reference" => "\n\nhttp://www.irchelp.org/irchelp/irctutorial.html\nhttp://www.ircbeginner.com/ircinfo/m-commands.html \nhttp://www.vsantivirus.com/kibuv-b.htm  \nhttp://unaaldia.hispasec.com/2001/03/graves-problemas-de-seguridad-en.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "CHAT IRC USER command",
                "description" => "\nCHAT IRC USER command\n\n\nIRC (Internet Relay Chat) es un protocolo de comunicación en tiempo real basado en texto, este tipo de chat permite la creación de canales para que su comunicación entre los usuarios sea más sencilla, la mayoría de los usuario de IRC requieren la utilización de comandos tal es el caso del comando \"USER\" este comando se utiliza al inicio de una conexión para poder especificar el nombre de usuario, nombre del host, el nombre real etc.\n",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar si están permitidas este tipo de aplicaciones en las políticas de uso de equipo de cómputo y de uso de red.\n   o De estar permitidas, verificar si la actividad se encuentra dentro de las funciones del usuario.\n   o En caso de existir una política de restricción, identificar los equipos involucrados y  desinstalar cualquier aplicación no autorizada por la institución.\n• Analiza los equipos involucrados con un software antivirus actualizado para descartar la presencia de Malware debido a este tipo de aplicaciones. \n",
                "risk" => " Las vulnerabilidades detectadas permiten ejecutar cualquier comando en la máquina de la víctima, facilitando a un potencial atacante acceso total al sistema del usuario.",
                "reference" => "\nhttp://www.irchelp.org/irchelp/irctutorial.html\nhttp://www.ircbeginner.com/opvinfo/h-usermodes.html\nhttp://www.vsantivirus.com/kibuv-b.htm  \nhttp://unaaldia.hispasec.com/2001/03/graves-problemas-de-seguridad-en.html\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "CHAT MSN status change",
                "description" => "CHAT MSN status change\n\nMSN (Messenger) es un servicio de mensajería instantánea que permite la comunicación entre dos o más usuarios y entre sus usos está el poder chatear (intercambiar mensajes escritos en tiempo real), hablar o realizar videoconferencias.\n\n",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar las políticas de uso de la red y uso del equipo de cómputo.\n• Desinstalar la aplicación MSN ya que está descontinuada, al no tener soporte tiene numerosas vulnerabilidades.\n• Analizar el equipo con un software antivirus para descartar la presencia de Malware.",
                "risk" => "La aplicación MSN ya que está descontinuada, al no tener soporte tiene numerosas vulnerabilidades que pueden ser aprovechadas por los atacantes comprometiendo la seguridad del equipo.",
                "reference" => "http://hipertextual.com/2013/04/evolucion-de-msn-messenger\nhttp://www.seguridad.unam.mx/vulnerabilidadesDB/?vulne=5387\nhttps://technet.microsoft.com/en-us/library/security/ms05-022.aspx",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Outdated Windows Flash Version IE",
                "description" => null,
                "recommendation" => "\nSe recomienda llevar acabo las siguientes acciones:\n\nDescargar la versión más actual del complemento Adobe Flash Player, guardando el archivo en una ubicación local. \n\nLlevar a cabo la instalación en el equipo en modo administrador, para ello: \n     Dar clic derecho en el archivo guardado, seleccionando “Ejecutar como administrador”\n     Se iniciara el proceso de instalación, por lo cual, seguir las instrucciones del instalador que se muestren en pantalla.\n\nActualizar y aplicar los parches más recientes de todo el software así como del Sistema Operativo.",
                "risk" => "Explotación de vulnerabilidades conocidas.\nEscalación de privilegios y ejecución de código especialmente modificado.\n",
                "reference" => "https://www.adobe.com/support/flashplayer/downloads.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "DDoS Inbound Frequent Un-Authed MON_LIST Requests IMPL 0x03",
                "description" => "La regla detecta una solicitud no autentificada en la que posiblemente exista una dirección IP suplantada o generada, la cual busca recibir una respuesta amplificada de NTP.  El protocolo NTP  es propenso a los ataques de amplificación debido a su naturaleza ya que está en UDP simple y la respuestas generadas a un paquete retornara una respuesta larga. Eso hace que sea ideal como herramienta de DDoS .\nNTP contiene un comando llamado monlist (a veces MON_GETLIST ) que puede ser enviado a un servidor NTP para fines de monitoreo, el cual devuelve las direcciones de hasta los últimos 600 máquinas con las que el servidor NTP ha interactuado . Esta respuesta es mucho más grande que la solicitud enviada por lo que es ideal para un ataque de amplificación.                                                                                                                                                                                                 Al enviar el comando MON_GETLIST. El paquete de solicitud es de 234 bytes de longitud. La respuesta se divide en 10 paquetes por un total de 4.460 bytes . Eso es un factor de amplificación y  la respuesta se envía en muchos paquetes, un ataque con usando esto sería consumir una gran cantidad de ancho de banda y una alta tasa de paquetes. \n\n",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar la configuración del servidor NTP y aplicar las actualizaciones del Sistema Operativo.\n• Verificar si la comunicación es legítima y está permitida, en caso de no serlo se recomienda el bloqueo de la dirección IP involucrada en el Firewall Perimetral.\n• Verificar si se requiere tener habilitado el comando “monlist”, de no ser necesario, deshabilitarlo.",
                "risk" => "Normalmente provoca la pérdida de la conectividad de la red por el consumo del ancho de banda de la red de la víctima o sobrecarga de los recursos computacionales del sistema de la víctima.",
                "reference" => "https://blog.cloudflare.com/understanding-and-mitigating-ntp-based-ddos-attacks/    \nhttp://www.symantec.com/connect/blogs/hackers-spend-christmas-break-launching-large-scale-ntp-reflection-attacks\nhttps://nmap.org/nsedoc/scripts/ntp-monlist.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "DFind w00tw00t GET-Requests",
                "description" => "La regla detecta solicitudes sospechosas relacionadas con una herramienta, inicialmente la herramienta se conocia como \"Dfind Port Scanner\", sin embargo han surgido mas herramientas con este tipo de actividad, que realiza escaneos de vulnerabilidades web,  en los cuales la cadena  \"w00tw00\" se identifica como rastro.  ",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Actualizar y aplicar los parches de seguridad del Sistema Operativo así como de las aplicaciones que se utilizan.\n• Bloquear la dirección IP reportada en el equipo, ya sea por Iptables o en el firewall de Windows, dependiendo del Sistema Operativo.\n• Bloquear la IP reportada en el firewall perimetral.",
                "risk" => "Está herramienta es utilizada como un escaner de vulnerabilidades, las peticiones realizadas tienen como objetivo identificar la versión de la herramienta \"phpMyAdmin\", en caso de que este activa, para detectar vulnerabilidades conocidas de versiones anteriores de la misma y posteriormente explotarlas en una siguiente fase.",
                "reference" => "https://ma.ttias.be/the-infamous-w00tw00t-at-isc-sans-dfind-get-requests-in-your-access-logs/\nhttp://spamcleaner.org/en/misc/w00tw00t.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "DNS lookup for bridges.torproject.org IP lookup/Tor Usage check",
                "description" => "La regla se presenta debido a  solicitudes de dominio, hacia direccionamientos de TOR conocidos como \"bridges\"(puentes), los cuales se utilizan como un recurso alterno a las solititudes hacia nodos usuales de TOR, debido a que en su mayoria los nodos principales de TOR estan bien identificados y son bloqueados en diveros firewalls, estos direccionamientos se encuentran fuera de la lista principal de TOR y algunos son direccionamientos privados, debido a esto es casi imposible bloquearlos todos.",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar si el equipo relacionado con la dirección IP reportada tiene instalado algún programa para el uso de la red TOR.\n   o En caso de encontrarse algún programa de este tipo se recomienda desinstalarlo inmediatamente.\n• Verificar las configuraciones de red del equipo, en busca de algún cambio en los parámetros de Proxy definidos por la institución.\n• Bloquear el dominio reportado:\n   o En el archivo “hosts” del equipo reportado.\n   o En caso de contar con un servidor de filtrado de contenido web, bloquearlo.\n• Analizar el equipo relacionado con el evento con un software antivirus actualizado para descartar la presencia de Malware que realice las peticiones.\n",
                "risk" => "En los dominios de Tor, en esste caso \".onion\" se puede encontrar pornografía, manuales de guerrilla, hacer explosivos, procedimientos para envenenar, asesinar, ocultar rastros, hackear, narcotráfico, trata de blancas, sicarios, nazismo, venta de órganos, lavado de dinero, compra de artículos robados, pedofilia, etc. Dichos dominios son ilegales y pueden repercutir en pérdidas monetarias e inclusive carcel.",
                "reference" => "https://www.torproject.org/docs/bridges.html.en\nhttp://www.elconfidencial.com/tecnologia/2013-10-18/las-agencias-de-seguridad-le-declaran-la-guerra-al-navegador-anonimo-tor_42898/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "DNS named version attempt",
                "description" => "La detección de petición de conexión hacia la dirección IP privada es con el propósito de conocer información referente a la versión del servidor DNS, dicha petición se puede realizar desde equipos con direcciones IP privadas, como direcciones IP públicas. \n\nDonde un atacante podría obtener información sensible mediante el envío de consultas DNS especialmente diseñado para el  registro AUTHORS.BIND, podría obtener la versión de software BIND y el nombre de host del servidor DNS. Al conocer la versión del sistema del servidor DNS se puede buscar alguna vulnerabilidad conocida para para posteriormente ser explotada.  ",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar  si las conexiones son legítimas, en caso de no serlo se recomienda bloquear las  direcciones IP en el firewall perimetral.\n• Actualizar el sistema del servidor DNS. \n• Modificar los parámetros para mantener la seguridad en el servidor:\n   o Para que las consultas de este tipo no regresen la versión del servidor DNS, aplicar en el archivo named.conf\noptions[version “NONE”;} \n",
                "risk" => "Un atacante podría obtener información sensible mediante el envío de consultas DNS especialmente diseñado para el registro AUTHORS.BIND, podría obtener la versión de software BIND y el nombre de host del servidor DNS. Esta información podría ser útil en el lanzamiento de nuevos ataques.",
                "reference" => "http://www.ecured.cu/index.php/Servidores_Bind\nhttp://mysecurity.zyxel.com/mysecurity/jsp/policy.jsp?ID=1049888\nhttp://www.cisco.com/web/about/security/intelligence/dns-bcp.html\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "DNS Non-DNS or Non-Compliant DNS traffic on DNS port Opcode 6 or 7 set - Likely Kazy",
                "description" => "El troyano Kazy tiene como objetivo principal obtener datos bancarios como información de tarjeta de crédito, contraseñas,  etc. Los medios empleados para la infección son variados, e incluyen, entre otros, memorias USB, discos duros externos,  mensajes de correo electrónico con archivos adjuntos, descargas de Internet, transferencia de archivos a través de FTP, canales IRC, redes P2P, etc.\n\nSe puede identificar que dentro del tráfico de datos se simula la consultas DNS, lo que en realidad es tráfico de datos cifrado hacia los servidores de Command and Control del troyano Kazy. Este tráfico se realiza através del protocolo UDP utilizando el puerto 53, el cual es usado usualmente para consultas al servidor DNS.",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar que la comunicación sea legítima.\n• Eliminar el troyano por software:\n   o Con un software antivirus actualizado\n   o Con una herramienta especializada en la eliminación de malware.\n• Eliminar el Troyano manualmente :\n   o Finalizar el Proceso “conhostd.exe” del Administrador de Tareas.\n   o Eliminar las claves del registro:\n      - HKCU\\Software\\Microsoft\\Windows\\CurrentVersion\\Run\\Explore.exe\n      - HKCU\\Software\\Microsoft\\Windows\\CurrentVersion\\Run\\ Juschedg.exe\n",
                "risk" => "Acceso no autorizado a información sensible.\nRobo de contraseñas.",
                "reference" => "http://www.pandasecurity.com/usa-es/homeusers/security-info/224324/information/Kazy.C\nhttp://www.spywareremove.com/removekazytrojan.html\nhttp://www.symantec.com/security_response/writeup.jsp?docid=2010-022501-5526-99",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "DNS Non-DNS or Non-Compliant DNS traffic on DNS port Opcode 8 through 15 set - Likely Kazy",
                "description" => "La regla indica un comportamiento propio del troyano KAZY, el cual se caracteriza por cambiar la configuración predeterminada del sistema operativo, la configuración DNS, la configuración del navegador web, la configuración de registro y algunos archivos del sistema, lo cual puede ser la causa de estas anomalías en las peticiones.\n\n“Kazy” es un troyano, cuyo objetivo principal es obtener datos bancarios como la información de tarjeta de crédito, contraseñas, etc. No se propaga automáticamente por sus propios medios, sino que precisa de la intervención del usuario o atacante para su propagación.\n\nLos medios empleados para la infección son variados, e incluyen, entre otros, memorias USB, discos duros externos, mensajes de correo electrónico con archivos adjuntos, descargas de Internet, transferencia de archivos a través de FTP, canales IRC, redes P2P, etc.",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar que la comunicación sea legítima.\n• Eliminar el troyano por software:\n   o Con un software antivirus actualizado\n   o Con una herramienta especializada en la eliminación de malware.\n• Eliminar el Troyano manualmente :\n   o Finalizar el Proceso “conhostd.exe” del Administrador de Tareas.\n   o Eliminar las claves del registro:\n      - HKCU\\Software\\Microsoft\\Windows\\CurrentVersion\\Run\\Explore.exe\n      - HKCU\\Software\\Microsoft\\Windows\\CurrentVersion\\Run\\ Juschedg.exe\n",
                "risk" => "Acceso no autorizado a información sensible.\nRobo de contraseñas.",
                "reference" => "http://www.pandasecurity.com/usa-es/homeusers/security-info/224324/information/Kazy.C\nhttp://www.mcafee.com/threat-intelligence/malware/default.aspx?id=129876\nhttp://www.symantec.com/security_response/writeup.jsp?docid=2010-022501-5526-100",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "DNS Non-DNS or Non-Compliant DNS traffic on DNS port Reserved Bit Set - Likely Kazy",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar que la comunicación sea legítima.\n• Eliminar el troyano por software:\n   o Con un software antivirus actualizado\n   o Con una herramienta especializada en la eliminación de malware.\n• Eliminar el Troyano manualmente :\n   o Finalizar el Proceso “conhostd.exe” del Administrador de Tareas.\n   o Eliminar las claves del registro:\n      - HKCU\\Software\\Microsoft\\Windows\\CurrentVersion\\Run\\Explore.exe\n      - HKCU\\Software\\Microsoft\\Windows\\CurrentVersion\\Run\\ Juschedg.exe\n",
                "risk" => "Acceso no autorizado a información sensible.\nRobo de contraseñas.",
                "reference" => "http://www.symantec.com/security_response/writeup.jsp?docid=2010-022501-5526-101",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "DNS Query for Suspicious .co.cc Domain",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar si la comunicación es legítima.\n• Validar si el sitio se encuentra dentro de las políticas de navegación segura de la institución, en caso de no serlo: \n   o Realizar un análisis completo a los equipos relacionados en búsqueda de Malware con un software antivirus actualizado. \n   o Bloquear el dominio en el archivo “hosts” del equipo reportado.\n   o En caso de contar con un servidor de filtrado de contenido web, bloquearlo.",
                "risk" => "El ingreso a este tipo de dominios puede causar que el equipo se infecte con algún tipo de código malicioso comprometiendo así la seguridad de los recursos que maneja. Además de propicias fuga de información y denegación de servicio.",
                "reference" => "http://www.tecnologiadetuatu.elcorteingles.es/firewire/cuidado-con-algunos-dominios-cuando-navegues-por-internet/\nhttp://www.aeromental.com/2011/07/11/google-bloquea-11-millones-de-subdominios-co-cc-por-traer-malware/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "DNS Query for TOR Hidden Domain .onion Accessible Via TOR",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar si el equipo relacionado con la dirección IP reportada tiene instalado algún programa para el uso de la red TOR.\n   o En caso de encontrarse algún programa de este tipo se recomienda desinstalarlo inmediatamente.\n• Verificar las configuraciones de red del equipo, en busca de algún cambio en los parámetros de Proxy definidos por la institución.\n• Bloquear el dominio reportado:\n   o En el archivo “hosts” del equipo reportado.\n   o En caso de contar con un servidor de filtrado de contenido web, bloquearlo.\n• Analizar el equipo relacionado con el evento con un software antivirus actualizado para descartar la presencia de Malware que realice las peticiones.\n",
                "risk" => "En los dominios de Tor, en esste caso \".onion\" se puede encontrar pornografía, manuales de guerrilla, hacer explosivos, procedimientos para envenenar, asesinar, ocultar rastros, hackear, narcotráfico, trata de blancas, sicarios, nazismo, venta de órganos, lavado de dinero, compra de artículos robados, pedofilia, etc. Dichos dominios son ilegales y pueden repercutir en pérdidas monetarias e inclusive carcel.",
                "reference" => "http://www.elconfidencial.com/tecnologia/2013-10-18/las-agencias-de-seguridad-le-declaran-la-guerra-al-navegador-anonimo-tor_42898/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "DNS Query to .onion proxy Domain (onion.gq)",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar si el equipo relacionado con la dirección IP reportada tiene instalado algún programa para el uso de la red TOR.\n   o En caso de encontrarse algún programa de este tipo se recomienda desinstalarlo inmediatamente.\n• Verificar las configuraciones de red del equipo, en busca de algún cambio en los parámetros de Proxy definidos por la institución.\n• Bloquear el dominio reportado:\n   o En el archivo “hosts” del equipo reportado.\n   o En caso de contar con un servidor de filtrado de contenido web, bloquearlo.\n• Analizar el equipo relacionado con el evento con un software antivirus actualizado para descartar la presencia de Malware que realice las peticiones.\n",
                "risk" => "En los dominios de Tor, en esste caso \".onion\" se puede encontrar pornografía, manuales de guerrilla, hacer explosivos, procedimientos para envenenar, asesinar, ocultar rastros, hackear, narcotráfico, trata de blancas, sicarios, nazismo, venta de órganos, lavado de dinero, compra de artículos robados, pedofilia, etc. Dichos dominios son ilegales y pueden repercutir en pérdidas monetarias e inclusive carcel.",
                "reference" => "http://blog.segu-info.com.ar/2012/07/que-son-los-dominios-onion-y-como.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "DNS Query to .onion proxy Domain (tor2web)",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar si el equipo relacionado con la dirección IP reportada tiene instalado algún programa para el uso de la red TOR.\n   o En caso de encontrarse algún programa de este tipo se recomienda desinstalarlo inmediatamente.\n• Verificar las configuraciones de red del equipo, en busca de algún cambio en los parámetros de Proxy definidos por la institución.\n• Bloquear el dominio reportado:\n   o En el archivo “hosts” del equipo reportado.\n   o En caso de contar con un servidor de filtrado de contenido web, bloquearlo.\n• Analizar el equipo relacionado con el evento con un software antivirus actualizado para descartar la presencia de Malware que realice las peticiones.\n",
                "risk" => "En los dominios de Tor, en esste caso \".onion\" se puede encontrar pornografía, manuales de guerrilla, hacer explosivos, procedimientos para envenenar, asesinar, ocultar rastros, hackear, narcotráfico, trata de blancas, sicarios, nazismo, venta de órganos, lavado de dinero, compra de artículos robados, pedofilia, etc. Dichos dominios son ilegales y pueden repercutir en pérdidas monetarias e inclusive carcel.",
                "reference" => "http://blog.segu-info.com.ar/2012/07/que-son-los-dominios-onion-y-como.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "DNS Query to a *.pw domain - Likely Hostile",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar si la comunicación es legítima.\n• Validar si el sitio se encuentra dentro de las políticas de navegación segura de la institución, en caso de no serlo: \n   o Realizar un análisis completo a los equipos relacionados en búsqueda de Malware con un software antivirus actualizado. \n   o Bloquear el dominio en el archivo “hosts” del equipo reportado.\n   o En caso de contar con un servidor de filtrado de contenido web, bloquearlo.",
                "risk" => "El ingreso a este tipo de dominios puede causar que el equipo se infecte con algún tipo de código malicioso comprometiendo así la seguridad de los recursos que maneja. Además de propicias fuga de información y denegación de servicio.",
                "reference" => "http://blog.escanav.com/2013/05/04/the-professional-web/?lang=es",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "DNS Query to a .tk domain - Likely Hostile",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar si la comunicación es legítima.\n• Validar si el sitio se encuentra dentro de las políticas de navegación segura de la institución, en caso de no serlo: \n   o Realizar un análisis completo a los equipos relacionados en búsqueda de Malware con un software antivirus actualizado. \n   o Bloquear el dominio en el archivo “hosts” del equipo reportado.\n   o En caso de contar con un servidor de filtrado de contenido web, bloquearlo.",
                "risk" => "El ingreso a este tipo de dominios puede causar que el equipo se infecte con algún tipo de código malicioso comprometiendo así la seguridad de los recursos que maneja. Además de propicias fuga de información y denegación de servicio.",
                "reference" => "http://www.welivesecurity.com/la-es/2011/05/03/el-dominio-tk-como-una-pequena-isla-es-el-centro-del-cibercrimen/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "DNS Reply for unallocated address space - Potentially Malicious 1.1.1.0/24",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Realizar un análisis completo a los equipos relacionados en búsqueda de Malware con un software antivirus actualizado. \n• Bloquear el dominio en el archivo “hosts” del equipo reportado.\n• En caso de contar con un servidor de filtrado de contenido web, bloquearlo.",
                "risk" => "El ingreso dominios maliciosos puede causar que el equipo se infecte con algún tipo de código malicioso comprometiendo así la seguridad de los recursos que maneja. Además de propicias fuga de información y denegación de servicio.",
                "reference" => "http://www.securityartwork.es/2015/04/24/deteccion-de-dominios-dns-maliciosos-utilizados-por-apt/\nhttp://seguridadinformati.ca/articulos/malware",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "DNS Reply Sinkhole Microsoft NO-IP Domain",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n\n• Realizar un análisis completo del equipo con dirección IP reportada, con un software antivirus actualizado, para descartar algún tipo de malware.\n• Bloquear el acceso al dominio reportado\n   o Desde el equipo, mediante el archivo hosts, esto varía de acuerdo al sistema operativo.\n   o En caso de contar con un servidor de filtrado de contenido web, bloquearlo.\n",
                "risk" => "Entrar en dominios maliciosos traen como consecuencia la descarga no autorizada de malware, spam, nos convierte en blancos fáciles para atacantes.",
                "reference" => "http://resources.infosecinstitute.com/dns-sinkhole/\nhttp://linux.die.net/man/5/hosts \nhttp://www.vsantivirus.com/faq-hosts.htm\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Dorkbot GeoIP Lookup to wipmania",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Analizar el equipo relacionado en el evento con un software antivirus actualizado para descartar la existencia de malware.\n• Bloquear el dominio “wipmania”:\n   o En el archivo “hosts” del equipo reportado.\n   o En caso de contar con un servidor de filtrado de contenido web, bloquearlo.\n",
                "risk" => "Wipmania está relacionada con la distribuión regional de malware, específicamente botnes. \nLos delincuentes usan botnets para enviar mensajes de correo electrónico no deseados, propagar virus, atacar equipos y servidores y cometer otros tipos de delitos y fraudes.Si su equipo forma parte de una botnet, el equipo puede volverse más lento y puede estar ayudando a los delincuentes sin darse cuenta.",
                "reference" => "http://www.malware.unam.mx/en/content/malware-regional-sigue-propag%C3%A1ndose-por-medio-de-botnets\n\nhttp://www.malware.unam.mx/es/content/bot-alojado-en-el-servidor-de-descargas-hotfile\n\nhttps://www.microsoft.com/es-es/security/resources/botnet-whatis.aspx \n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "DOS Bittorrent User-Agent inbound - possible DDOS",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar las políticas de uso de la red y uso del equipo de cómputo.\n• Validar si el uso de software como aplicaciones P2P están dentro de las aplicaciones permitidas por la institución.\n   o En caso de no contar con dichas políticas, implementarlas.\n   o Si el uso de este tipo de aplicaciones no esté permitido, se sugiere localizar el equipos relacionado y desinstalar cualquier aplicación no autorizada por la institución.\n   o Restringir el acceso a  User-Agent \"Bittorrent\" en los servidores.\n• Analizar el equipo reportado con un software antivirus actualizado para descartar la presencia de Malware.\n• Implementar un firewall para aplicaciones web (WAF).\n• Configurar listas de acceso como mínimo en los routers de frontera, para de esta manera conseguir tener control sobre el flujo y tipo de tráfico que hay en la red.\n• Implementar TCP wrappers donde sea aplicable, lo que brinda la posibilidad de brindar acceso o negar acceso a los servicios con base en direcciones IP o nombres de dominio.",
                "risk" => "Normalmente este tipo de ataque provoca la pérdida de la conectividad de la red por el consumo del ancho de banda de la red de la víctima o sobrecarga de los recursos computacionales del sistema de la víctima.",
                "reference" => "http://www.abc.es/20101231/tecnologia/abci-bittorrent-posible-fuente-ataques-201012310942.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Double Encoded Characters in URI (../)",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Utilizar el envío de peticiones por el método Post siempre que sea posible.\n• Verificar los datos de entrada, es decir, validar las cadenas antes de enviarlos al servidor; tipo, longitud mínima y máxima, etc.\n• Realizar una decodificación independiente para la validación de datos.\n• Verificar que no se repitan los procesos de decodificación en la aplicación cliente, si los datos siguen codificados o contienen caracteres inaceptables, descartar la petición.\n",
                "risk" => "En este tipo de ataque vulneran los controles de seguridad que sólo decodifican una sola vez la entrada de usuario, ya que al codificar los saltos de directorio en hexadecimal dos veces se puede crearun bypass de los controles de seguridad y/o causar un comportamiento inesperado en la aplicación. Lo que le da al atacante acceso al sistema.",
                "reference" => "https://www.owasp.org/index.php/Double_Encoding\nhttp://www.technicalinfo.net/papers/URLEmbeddedAttacks.html\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Downadup/Conficker A or B Worm reporting",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Analizar el equipo con la dirección IP reportada, con un software antivirus actualizado para descartar algún malware.\n• Realizar una limpieza del registro de Windows, para eliminar entradas de registros de algún malware.\n• Identificar el archivo DLL relacionado con el malware Conficker, en caso de encontrar dicho archivo proceder a su eliminación.\n• Actualizar el Sistema Operativo para evitar la explotación de vulnerabilidades conocidas.\n• Bloquear la comunicación:\n   o Mediante el firewall de Windows.\n   o En caso de contar con un firewall perimetral, bloquearla.\n",
                "risk" => "Cuando ha infectado un computador, Conficker desactiva varios servicios, como Windows Automatic Update, Windows Security Center, Windows Defender y Windows Error Reporting. Luego se contacta con un servidor, donde recibe instrucciones posteriores sobre propagarse, recolectar información personal o descargar malware adicional en el computador víctima.",
                "reference" => "https://support.microsoft.com/es-es/kb/962007/es \n\nhttps://www.sans.org/security-resources/malwarefaq/conficker-worm.php\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Dropbox Client Broadcasting",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar las políticas de uso de la red y uso del equipo de cómputo.\n• Validar si el uso de software como Dropbox está dentro de las aplicaciones permitidas por la institución.\n   o En caso de no contar con dichas políticas, implementarlas.\n   o Si el uso de este tipo de aplicaciones no esté permitido, se sugiere localizar los equipos relacionados y desinstalar cualquier aplicación no autorizada por la institución.\n• Analizar el equipo reportado con un software antivirus actualizado para descartar la presencia de Malware.\n• Bloquear el puerto usado por Dropbox 17500.\n",
                "risk" => "El uso de este tipo aplicaciones puede provocar la fuga de información sensible y son foco de infección de malware.",
                "reference" => "http://www.forospyware.com/t490113.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Dropbox DNS Lookup - Possible Offsite File Backup in Use",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar las políticas de uso de la red y uso del equipo de cómputo.\n• Validar si el uso de software como Dropbox está dentro de las aplicaciones permitidas por la institución.\n   o En caso de no contar con dichas políticas, implementarlas.\n   o Si el uso de este tipo de aplicaciones no esté permitido, se sugiere localizar los equipos relacionados y desinstalar cualquier aplicación no autorizada por la institución.\n• Analizar el equipo reportado con un software antivirus actualizado para descartar la presencia de Malware.\n• Bloquear el puerto usado por Dropbox 17500.\n",
                "risk" => "El uso de este tipo aplicaciones puede provocar la fuga de información sensible y son foco de infección de malware.",
                "reference" => "http://www.forospyware.com/t490113.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "GPL EXPLOIT .cnf access",
                "description" => null,
                "recommendation" => "Validar las conexiones entre las direcciones IP relacionadas.\n\nActualizar el Sistema Operativo y las aplicaciones utilizadas en el servidor web.\n\nDeshabilitar el acceso al archive .cnf en el servidor web.",
                "risk" => "Provocar fuga de información, adquirir codigo malicioso, incluso acceso remoto sin autorización y funcionamiento incorrecto de los servidores involucrados.",
                "reference" => "https://exchange.xforce.ibmcloud.com/vulnerabilities/31644",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Dropbox.com Offsite File Backup in Use",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar las políticas de uso de la red y uso del equipo de cómputo.\n• Validar si el uso de software como Dropbox está dentro de las aplicaciones permitidas por la institución.\n   o En caso de no contar con dichas políticas, implementarlas.\n   o Si el uso de este tipo de aplicaciones no esté permitido, se sugiere localizar los equipos relacionados y desinstalar cualquier aplicación no autorizada por la institución.\n• Analizar el equipo reportado con un software antivirus actualizado para descartar la presencia de Malware.\n• Bloquear el puerto usado por Dropbox 17500.\n",
                "risk" => "El uso de este tipo aplicaciones puede provocar la fuga de información sensible y son foco de infección de malware.",
                "reference" => "http://www.forospyware.com/t490113.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Dshield Block Listed Source group 1",
                "description" => null,
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Analizar el equipo con dirección IP reportada con un software antivirus en busca de algún Malware.\n• Bloquear la comunicación con las direcciones IP públicas reportadas:\n   o De manera local, desde el archivo host del equipo.\n   o Desde el firewall perimetral.",
                "risk" => "Entrar en dominios maliciosos traen como consecuencia la descarga no autorizada de malware, spam, nos convierte en blancos fáciles para atacantes.",
                "reference" => "http://www.tecnologiadetuatu.elcorteingles.es/firewire/cuidado-con-algunos-dominios-cuando-navegues-por-internet/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "EXE or DLL Windows file download",
                "description" => "Se detectó la descarga de un archivo de tipo ejecutable para el sistema operativo Windows (.exe o .dll) el cual podría cambiar la configuración del sistema._x000D_\n_x000D_\nAlgunos malware podrían estar ocultos dentro de estos archivos e instalarse en el sistema operativo cuando sean ejecutados. Otro tipo del malware genera sus propios archivos .exe o .dll para llevar a cabo sus tareas._x000D_\n_x000D_\nSi el sitio web de donde se obtiene el archivo ejecutable no es de confianza, éste podría traer consecuencias como infecciones por varios tipos de malware, pérdida de información así como permitir intrusiones a la red.",
                "recommendation" => "Analizar con un software antivirus el equipo relacionado en buscas de archivos ejecutables que puedan causar mal funcionamiento.\n\nInstalar las últimas actualizaciones del sistema operativo.",
                "risk" => "Cambiar la configuracion y el correcto funcionamiento en el sistema operativo de lso equipos involucrados.",
                "reference" => "http://www.malware-traffic-analysis.net/2013/08/10/index.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Edonkey Connect Reply and Server List",
                "description" => "Se detecta el uso de “eDonkey”, el cual es una red de intercambio de archivos P2P (Peer To Peer) que facilita la descarga de diversos tipos de archivos, la cual puede ser usada en varios software de tipo P2P tales como: eMule, uTorrent, Ares, Bitorrent, Vuze, entre otros.\n\nEl uso de aplicaciones que usan redes P2P pone en riesgo la seguridad de la información en los equipos de cómputo, ya que puede provocar la fuga de información sensible y son foco de infección de malware, así como puede incurrir en una violación a las políticas internas por el uso indebido de software ajeno a la institución.  \n",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar las políticas de uso de la red y uso del equipo de cómputo.\n• Validar si el uso de software como aplicaciones P2P están dentro de las aplicaciones permitidas por la institución.\n   o En caso de no contar con dichas políticas, implementarlas.\n   o Si el uso de este tipo de aplicaciones no esté permitido, se sugiere localizar los equipos relacionados y desinstalar cualquier aplicación no autorizada por la institución.\n• Analizar el equipo reportado con un software antivirus actualizado para descartar la presencia de Malware.\n• Bloquear desde el Firewall el uso de puerto de eDonkey 4661 y 4665.\n",
                "risk" => "El uso de aplicaciones que utilizan redes P2P pone en riesgo la seguridad en los equipos de cómputo, ya que puede provocar fuga de información sensible, iniciar una denegación de servicios; además son foco de infección de malware.",
                "reference" => "https://forums.avg.com/es-es/avg-forums?sec=thread&act=show&id=5139\nhttps://en.wikibooks.org/wiki/The_World_of_Peer-to-Peer_(P2P)/Networks_and_Protocols/eDonkey\nhttp://www.hijosdigitales.es/2011/07/riesgos-al-compartir-por-redes-p2p/\nhttp://diarioti.com/empresas-en-peligro-por-intercambios-p2p/26082/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Edonkey Publicize File",
                "description" => "Se detecta tráfico procedente de la dirección IP origen hacia la dirección IP destino, donde se identifica una red de intercambio de datos P2P (Peer To Peer), la cual puede ser usada en varios programas de descargas de tipo P2P. Donde dichas redes son generalmente utilizadas para descargar y compartir distintos tipos de archivos.\n\nEl uso de aplicaciones que usan redes P2P pone en riesgo la seguridad de la información en los equipos de cómputo, ya que puede provocar la fuga de información sensible y son foco de infección de malware, así como puede incurrir en una violación a las políticas internas por el uso indebido de software ajeno a la institución.  \n\n\n",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar las políticas de uso de la red y uso del equipo de cómputo.\n• Validar si el uso de software como aplicaciones P2P están dentro de las aplicaciones permitidas por la institución.\n   o En caso de no contar con dichas políticas, implementarlas.\n   o Si el uso de este tipo de aplicaciones no esté permitido, se sugiere localizar los equipos relacionados y desinstalar cualquier aplicación no autorizada por la institución.\n• Analizar el equipo reportado con un software antivirus actualizado para descartar la presencia de Malware.\n• Bloquear desde el Firewall el uso de puerto de eDonkey 4661 y 4665.\n",
                "risk" => "El uso de aplicaciones que utilizan redes P2P pone en riesgo la seguridad en los equipos de cómputo, ya que puede provocar fuga de información sensible, iniciar una denegación de servicios; además son foco de infección de malware.",
                "reference" => "http://techterms.com/definition/p2p\nhttps://forums.avg.com/es-es/avg-forums?sec=thread&act=show&id=5139\nhttp://diarioti.com/empresas-en-peligro-por-intercambios-p2p/26082/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "ET POLICY iTunes User Agent",
                "description" => "\niTunes es una herramienta de reproduccion de multimedia, para el entretenimiento y compatibilidad con productos Apple. Sin embargo es potencialmente peligroso debido a que se han encontrado diversas vulnerabilidades, que permiten ingresar a la plataforma donde se encuentra el usuario, permitiendo el robo de información.\n\nOtra vulnerailidad importante se encontraba en el manejo de memoria de la Webkit (motor renderizado de código abierto), este tipo de software llego a ser utilizado para inyectar y ejecutar codigo a traves de paginas maliciosas creadas para tal efecto.\n",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar las políticas de uso de la red y uso del equipo de cómputo.\n• Validar si el uso de software como aplicaciones ITunes están dentro de las aplicaciones permitidas por la institución.\n   o En caso de no contar con dichas políticas, implementarlas.\n   o Si el uso de este tipo de aplicaciones no esté permitido, se sugiere localizar los equipos relacionados y desinstalar cualquier aplicación no autorizada por la institución.\n",
                "risk" => "Versiones desactualizadas de Itunes utilizan HTTP para la ventana de Itunes tutorials, lo que permite a atacantes man-in-the-middle falsificar contenido, tomando el control sobre el flujo del tráfico de la red, afectando principalmente la integridad del sistema.  ",
                "reference" => "https://www.apple.com/es/itunes/\nhttp://unaaldia.hispasec.com/2014/01/apple-soluciona-multiples.html\nhttps://www.incibe.es/vulnDetail/CERT/Alerta_Temprana/Actualidad_Vulnerabilidades/detalle_vulnerabilidad/CVE-2014-1242",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "eMule Kademlia Hello Request",
                "description" => "La detección de Red Kad que es una red de intercambio de archivos completamente descentralizado, el cual implementa el protocolo  P2P de superposición Kademlia. Esta red está apoyada por eMule, aMule y MLdonkey. Por lo que el uso del software, generalmente son utilizados para descargar y compartir archivos de distintos tipos.\n\nEl uso de aplicaciones que usan redes P2P pone en riesgo la seguridad de la información en los equipos de cómputo, ya que puede provocar la fuga de información sensible y son foco de infección de malware, así como puede incurrir en una violación a las políticas internas por el uso indebido de software ajeno a la institución.  ",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar las políticas de uso de la red y uso del equipo de cómputo.\n• Validar si el uso de software como aplicaciones P2P están dentro de las aplicaciones permitidas por la institución.\n   o En caso de no contar con dichas políticas, implementarlas.\n   o Si el uso de este tipo de aplicaciones no esté permitido, se sugiere localizar los equipos relacionados y desinstalar cualquier aplicación no autorizada por la institución.\n• Analizar el equipo reportado con un software antivirus actualizado para descartar la presencia de Malware.\n• Bloquear desde el Firewall los puertos usandos por eMUle 1563 y 3689.\n",
                "risk" => "El uso de aplicaciones que utilizan redes P2P pone en riesgo la seguridad en los equipos de cómputo, ya que puede provocar fuga de información sensible, iniciar una denegación de servicios; además son foco de infección de malware.",
                "reference" => "http://www.symantec.com/security_response/attacksignatures/detail.jsp?asid=21591\nhttp://www.net.t-labs.tu-berlin.de/~stefan/fi11.pdf\nhttp://diarioti.com/empresas-en-peligro-por-intercambios-p2p/26082/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Et malware",
                "description" => "Malware es la abreviatura de \"malicious software\" y son categorías que engloban al tipo de programa o código malicioso que normalmente trata de aprovechar las vulnerabilidades existentes en los sistemas. Sus principales funciones que tiene el Malware es dañar el equipo o causar el mal funcionamiento del equipo. Dentro de este tipo de programa podemos encontrar los términos como los virus, troyanos, gusanos, botnets etc.\n\nEl Malware llega a utilizar herramientas de comunicación para poder ser difundido a través de correo electrónico y mensajes instantáneos. También suele propagarse por medio de redes sociales, sitios fraudulentos, programas gratuitos que no se sabe su procedencia etc.\n",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Analizar el equipo con la dirección IP reportada, con un software antivirus actualizado para descartar algún malware.\n• Analizar el equipo con alguna herramienta especializada en la eliminación de Malware.\n• Realizar una limpieza del registro de Windows, para eliminar entradas de registros de algún malware.\n• Actualizar el Sistema Operativo para evitar la explotación de vulnerabilidades conocidas.",
                "risk" => "El malware es software malicioso creado con la intención de introducirse de forma subrepticia en los computadores y causar daño a su usuario o conseguir un beneficio económico a sus expensas.",
                "reference" => "http://us.norton.com/security_response/malware.jsp\nhttp://seguridadinformati.ca/articulos/malware",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Gamehouse.com Related Spyware User-Agent (Sprout Game)",
                "description" => null,
                "recommendation" => "Eliminar las siguientes entradas de registro creadas por el troyano:\n• HKEY_CURRENT_USER\\SOFTWARE\\GAMEHOUSE\\\n• HKEY_CURRENT_USER\\SOFTWARE\\GAMEHOUSE\\SHAPESHIFTER\\\n• HKEY_LOCAL_MACHINE\\SOFTWARE\\CLASSES\\.KEY\\\n• HKEY_LOCAL_MACHINE\\SOFTWARE\\GAMEHOUSE\\\n• HKEY_LOCAL_MACHINE\\SOFTWARE\\GAMEHOUSE\\SHAPE\\\n• HKEY_LOCAL_MACHINE\\SOFTWARE\\MICROSOFT\\WINDOWS\\CURRENTVERSION\\UNINSTALL\\SHAPE SHIFTER\\\n\nBloquear el acceso al sitio: gamehouse.com",
                "risk" => "Infeccion del equipo por algun malware obtenido del sitio. Modificando el correcto funcionamiento del equipo.",
                "reference" => "http://home.mcafee.com/virusinfo/virusprofile.aspx?key=683846",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "ET MALWARE MarketScore.com Spyware Proxied Traffic",
                "description" => "Una de las principales funciones del spyware es la de recopilar información de un equipo y después esta información transmitirla a una entidad externa sin el conocimiento o el consentimiento del usuario.\n\nTal es el caso del Marketsocore el cual actúa como un servicio proxy, conectándose a un equipo a través de un proxi remoto, este tipo de Spyware funciona como un servicio de \"acelerador de internet\", pero su verdadera  función era la de recopilar y analizar la información transmitida desde la computadora en la que se encuentra instalada extrayendo toda la información ya sea  bancaria, contraseñas y virtualmente toda la información personal y confidencial intercambiada entre el usuario y cualquier sitio web. \n",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar si el Malware MarketScore está instalado en el equipo, se ser así, desinstalarlo.\n• Analizar el equipo con un software antivirus actualizado en busca de Malware.\n• Verificar si el uso de Servidores Proxy externos está permitido por la institución.\n   o Si no está permitido, bloquear la dirección IP reportada en el firewall perimetral.\n• Validar que los parámetros de configuración Proxy del equipo sean los establecidos por a la institución.",
                "risk" => "El malware es software malicioso creado con la intención de introducirse de forma subrepticia en los computadores y causar daño a su usuario o conseguir un beneficio económico a sus expensas.",
                "reference" => "http://www.maestrosdelweb.com/spyware/\nhttp://www.spywareguide.com/product_show.php?id=488\nhttp://www.symantec.com/security_response/writeup.jsp?docid=2004-042117-5317-99",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "ET P2P Tor Get Status Request",
                "description" => "TOR son las siglas del nombre en inglés “The Onion Router”, que es un programa que permite a usuarios tener anonimato en sus actividades en línea. Básicamente usa varias computadoras localizadas en diversas partes del mundo, para dirigir el tráfico de Internet, haciendo virtualmente imposible la localización y rastreo de la actividad en Internet de un usuario.\n\nCabe señalar que cuando se accede a este software normalmente lo que hace es enviar peticiones hacia el dominio que se este accediendo en ese momento facilitando la descarga de algun malware o poniendo en riesgo algun tipo de informacion personal que se tenga en el equipo o la organizacion en la que se encuentre.\n",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar si el equipo relacionado con la dirección IP reportada tiene instalado algún programa para el uso de la red TOR.\n   o En caso de encontrarse algún programa de este tipo se recomienda desinstalarlo inmediatamente.\n• Verificar las configuraciones de red del equipo, en busca de algún cambio en los parámetros de Proxy definidos por la institución.\n• Bloquear el dominio reportado:\n   o En el archivo “hosts” del equipo reportado.\n   o En caso de contar con un servidor de filtrado de contenido web, bloquearlo.\n• Analizar el equipo relacionado con el evento con un software antivirus actualizado para descartar la presencia de Malware que realice las peticiones.\n",
                "risk" => "El uso de aplicaciones que utilizan redes P2P pone en riesgo la seguridad en los equipos de cómputo, ya que puede provocar fuga de información sensible, iniciar una denegación de servicios; además son foco de infección de malware",
                "reference" => "http://aprenderinternet.about.com/od/Glosario/g/Que-es-Tor.htm\nhttp://www.elconfidencial.com/tecnologia/2013-10-18/las-agencias-de-seguridad-le-declaran-la-guerra-al-navegador-anonimo-tor_42898/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "ET POLICY Microsoft Online Storage Client Hello TLSv1 Possible SkyDrive",
                "description" => "Esta regla se presenta debido a que se detecta una peticion de conexión web con una version no actualizada de TLS,  este tipó de peticion se relaciona con el servicio de almacenamiento de Microsoft Skydrive,  debido   la cadena \".storage.live.com\" dentro del contenido de la peticion, considerada una violacion de politica. ",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar las políticas de uso de la red y uso del equipo de cómputo.\n• Validar si el uso de software como aplicaciones OneDrive está dentro de las aplicaciones permitidas por la institución.\n   o En caso de no contar con dichas políticas, implementarlas.\n   o Si el uso de este tipo de aplicaciones no esté permitido, se sugiere localizar los equipos relacionados y desinstalar cualquier aplicación no autorizada por la institución.",
                "risk" => "Al utilizar almacenamiento en la nube por software de terceros, se expone la información confidencial de la institución, lo cual trae como consecuencia la fuga de información y posibles infiltraciones a las cuentas de almacenamientos en línea.",
                "reference" => "http://blog.segu-info.com.ar/2012/07/skydrive-cuando-tu-almacenamiento-no-es.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "ET WEB_CLIENT Hex Obfuscation of document.write % Encoding",
                "description" => "Se detectó un taque de inyección de código hexadecimal ofuscado, se basa en ocultar dentro del código HTML un script malicioso que se encarga de descargar e incluso ejecutarlo, y que  por lo general, es un troyano. Este script generalmente se encuentra “protegido” con una técnica que recibe el nombre de ofuscación.\nEsta técnica, busca dificultar la lectura y análisis del código haciendo que sea lo más ilegible posible para el usuario.",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar que la comunicación sea legítima.\n• En caso de no serlo:\n   o Utilizar herramientas de decodificación como “Hexdecoder” para verificar el código.\n   o En caso de ser código malicioso, bloquear la dirección IP reportada.\n• Implementar una aplicación WAF (Web Application Firewall) con la que se pueden identificar y bloquear ataques a servidores web.\n• Si se desea puede implementarse software propietario tipo “Website Antivirus” para reforzar la seguridad del equipo.\n",
                "risk" => "Las técnicas para ofuscar código, como ataque, se utilizan comúnmente para ocultar fragmentos de código que, de ser maliciosos, representa una gran amenaza para la institución, puede ser víctima de malware, redireccionamiento del tráfico de la red o inclusive convertirse en un bot. ",
                "reference" => "http://ddecode.com/hexdecoder/?results=010203192e803ce87b67a5bdb7dca655 \nhttps://sucuri.net/website-antivirus/signup \n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "ET SCAN DCERPC rpcmgmt ifids Unauthenticated BIND",
                "description" => "Esta regla se presenta debido a la falta de autentificacion en una peticion para ejecutar procedimientos remotos, al presentarse un BIND no autentificado, es decir, una peticion que se solicita para iniciar servicios de RPC, el cual al solocitar la respuesta del bind es la dirección IP con la que se busca comunicar y  verificar si el servicio esta disponible, debido a esto, se considera un escaneo  ya que la respuesta a este tipo de solicitudes muestra la dirección y disponibilidad de este servicio en un equipo. ",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Validar que la comunicación entre los equipos reportados sea legítima, en caso contrario se recomienda bloquear la comunicación hacia la dirección IP pública en el firewall perimetral. \n• Implementar un firewall para aplicaciones web (WAF).\n• Configurar listas de acceso como mínimo en los routers de frontera, para de esta manera conseguir tener control sobre el flujo y tipo de tráfico que hay en la red.\n• Cerrar los puertos de servicios innecesarios.\n• Implementar TCP wrappers donde sea aplicable, lo que brinda la posibilidad de brindar acceso o negar acceso a los servicios con base en direcciones IP o nombres de dominio.",
                "risk" => "Normalmente este tipo de ataque provoca la pérdida de la conectividad de la red por el consumo del ancho de banda de la red de la víctima o sobrecarga de los recursos computacionales del sistema de la víctima.",
                "reference" => "http://linux.die.net/man/8/rpcbind\nhttp://www.vsantivirus.com/20vul.htm",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "ET SCAN Nessus FTP Scan detected (ftp_anonymous.nasl)",
                "description" => "Esta regla se se presenta debido a que se presenta una solicitud FTP hacia el servicio de transferencia de archivos, de manera anonima, debido a que se permiten conexiones remotas anonimas hacia este servicio, se considera un escano debido a que es considerada actividad por parte de la herramienta de escaneo de vulnerabilidades \"Nessus\", al existir la extensión .nasl (Nessus Attack Scripting Language), dentro del paquete.   ",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Validar que la comunicación entre los equipos reportados sea legítima.\n• En caso contrario:\n   o Bloquear la comunicación hacia la dirección IP pública en el firewall perimetral. \n   o Restringir el acceso a clientes con User-Agent \"Nessus\" en los servidores\n• Implementar un firewall para aplicaciones web (WAF).\n",
                "risk" => "Nessus es una herramienta que detecta vulnerabilidades, usada por la institución, ayuda a corregir las vulnerabilidades del sistema, usadas por un atacante, dichas vulnerabilidades pueden ser analizadas y explotadas.",
                "reference" => "http://www.tenable.com/plugins/index.php?view=single&id=1007\nhttp://virtualblueness.net/nasl.html\nhttp://www.cisco.com/c/en/us/td/docs/ios/12_2/security/configuration/guide/fsecur_c/scfacls.html  ",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "ET SCAN NMAP -sA",
                "description" => "Nmap (“Network Mapper”) es una herramienta de código abierto utilizada para realizar auditorías y análisis de redes de datos. Se diseñó para escanear grandes redes de forma muy rápida, aunque también funciona correctamente en equipos individuales._x000D_\n_x000D_\nNmap puede brindar distintos tipos de información acerca del objetivo, por ejemplo, resolución inversa de DNS, tipo de dispositivo, el sistema operativo utilizado en el mismo o su dirección MAC._x000D_\n_x000D_\nAl utilizar Nmap con los parametros –sA, se le está indicando que realizará un escaneo en los conjuntos de reglas de un firewall dado, con la finalidad de determinar si realiza un análisis de los paquetes que viajan a través de él y conocer que puertos son filtrados y cuáles no.",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Validar que la comunicación entre los equipos reportados sea legítima, en caso contrario se recomienda bloquear la comunicación hacia la dirección IP pública en el firewall perimetral. \n• Implementar un firewall para aplicaciones web (WAF).\n• Configurar listas de acceso como mínimo en los routers de frontera, para de esta manera conseguir tener control sobre el flujo y tipo de tráfico que hay en la red.\n• Cerrar los puertos de servicios innecesarios.\n• Implementar TCP wrappers donde sea aplicable, lo que brinda la posibilidad de brindar acceso o negar acceso a los servicios con base en direcciones IP o nombres de dominio.",
                "risk" => "Se puede comprometer la seguridad del sistema al conocer las vulnerabilidades del mismo, los argumentos -sA permiten saber si la red está protegida por un firewall.",
                "reference" => "http://www.cisco.com/c/en/us/td/docs/ios/12_2/security/configuration/guide/fsecur_c/scfacls.html   \nhttp://rm-rf.es/nmap-linux-uso-ejemplos/\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "ET SCAN Tomcat Auth Brute Force attempt (admin)",
                "description" => "Se realizó un ataque de fuerza bruta en contra del usuario “administrador” en un equipo que utiliza el servidor web Apache-Tomcat. Dicho ataque utilizó la cabecera “Authenticate” del protocolo HTTP, la cual es utilizada como mecanismo de autenticación para controlar el acceso a páginas y a otros recursos._x000D_\n_x000D_\nFuerza bruta es un método que sirve para obtener acceso no autorizado a algún sistema, para lograr esto, se utiliza software especializado que se encarga de probar todas las posibles combinaciones de caracteres (o mediante un diccionario de contraseñas) hasta conseguir la contraseña correcta del usuario.",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar que la comunicación sea legítima.\n• Actualizar y aplicar parches de seguridad el servidor y al Sistema Operativo\n• Implementar herramientas que proveen seguridad adicional, por ejemplo el módulo “mod_evasive”.\n• Implementar una aplicación WAF (Web Application Firewall) con la que se pueden identificar y bloquear ataques a servidores web.\n• Reforzar la seguridad del equipo o equipos utilizando contraseñas robustas, para dificultar el acceso de equipos malintencionado.\n• Implementar un mecanismo de cifrado en los sistemas de autenticación de usuarios.\n• Cifrar la información sensible o transmitirla a través de un canal de comunicación seguro.\n• Bloquear las direcciones IP reportadas en el firewall.",
                "risk" => "Al sobrecargar al sistema con ataques de fuerza bruta (de diccionario) se puede encontrar las credenciales de acceso, además el servidor puede dejar de atender las peticiones legítimas y desbordarse debido a la sobrecarga de peticiones, causando un cese de funciones.",
                "reference" => "http://www.jsitech.com/linux/protegiendo-nuestro-servidor-web-de-ataques-ddos-y-fuerza-bruta-con-mod_evasive/\nhttps://www.owasp.org/index.php/Web_Application_Firewall\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "EXE IsDebuggerPresent (Used in Malware Anti-Debugging)",
                "description" => "Esta firma se presenta cuando se realiza una descarga de un archivo ejecutable que contiene la cadena \"IsDebuggerPresent\". Esta es una llamada al sistema de Windows que sirve para detectar si el programa está siendo ejecutado por un Depurador._x000D_\n_x000D_\nEsta llamada es empleada por los malware para eludir el ser examinados por algunos antivirus, ya que mediante el resultado de la llamada al sistema pueden tomar distintos caminos según sea el caso. Lo que se busca es evitar que un programa depurador analice el código del malware.",
                "recommendation" => "Analizar con un software antivirus el equipo relacionado en buscas de archivos ejecutables que puedan causar mal funcionamiento.\n\nInstalar las últimas actualizaciones del sistema operativo.",
                "risk" => "Causar funcionamiento inesperado en losequipos involucrados.",
                "reference" => "https://forum.avast.com/index.php?topic=137541.0\nhttp://www.malware-traffic-analysis.net/2013/09/28/index.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "ET SCAN Tomcat Auth Brute Force attempt (manager)",
                "description" => "Se realizó un ataque de fuerza bruta en contra del usuario “manager” en un equipo que utiliza el servidor web Apache-Tomcat. Dicho ataque utilizó la cabecera “Authenticate” del protocolo HTTP, la cual es utilizada como mecanismo de autenticación para controlar el acceso a páginas y a otros recursos._x000D_\n_x000D_\nFuerza bruta es un método que sirve para obtener acceso no autorizado a algún sistema, para lograr esto, se utiliza software especializado que se encarga de probar todas las posibles combinaciones de caracteres (o mediante un diccionario de contraseñas) hasta conseguir la contraseña correcta del usuario.",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar que la comunicación sea legítima.\n• Actualizar y aplicar parches de seguridad el servidor y al Sistema Operativo\n• Implementar herramientas que proveen seguridad adicional, por ejemplo el módulo “mod_evasive”.\n• Implementar una aplicación WAF (Web Application Firewall) con la que se pueden identificar y bloquear ataques a servidores web.\n• Reforzar la seguridad del equipo o equipos utilizando contraseñas robustas, para dificultar el acceso de equipos malintencionado.\n• Implementar un mecanismo de cifrado en los sistemas de autenticación de usuarios.\n• Cifrar la información sensible o transmitirla a través de un canal de comunicación seguro.\n• Bloquear las direcciones IP reportadas en el firewall.",
                "risk" => "Al sobrecargar al sistema con ataques de fuerza bruta (de diccionario) se puede encontrar las credenciales de acceso, además el servidor puede dejar de atender las peticiones legítimas y desbordarse debido a la sobrecarga de peticiones, causando un cese de funciones.",
                "reference" => "http://www.jsitech.com/linux/protegiendo-nuestro-servidor-web-de-ataques-ddos-y-fuerza-bruta-con-mod_evasive/ \nhttps://www.owasp.org/index.php/Web_Application_Firewall \n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "ET SCAN Tomcat Auth Brute Force attempt (tomcat)",
                "description" => "Se realizó un ataque de fuerza bruta en contra del usuario “tomcat\" en un equipo que utiliza el servidor web Apache-Tomcat. Dicho ataque utilizó la cabecera “Authenticate” del protocolo HTTP, la cual es utilizada como mecanismo de autenticación para controlar el acceso a páginas y a otros recursos._x000D_\n_x000D_\nFuerza bruta es un método que sirve para obtener acceso no autorizado a algún sistema, para lograr esto, se utiliza software especializado que se encarga de probar todas las posibles combinaciones de caracteres (o mediante un diccionario de contraseñas) hasta conseguir la contraseña correcta del usuario.",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar que la comunicación sea legítima.\n• Actualizar y aplicar parches de seguridad el servidor y al Sistema Operativo\n• Implementar herramientas que proveen seguridad adicional, por ejemplo el módulo “mod_evasive”.\n• Implementar una aplicación WAF (Web Application Firewall) con la que se pueden identificar y bloquear ataques a servidores web.\n• Reforzar la seguridad del equipo o equipos utilizando contraseñas robustas, para dificultar el acceso de equipos malintencionado.\n• Implementar un mecanismo de cifrado en los sistemas de autenticación de usuarios.\n• Cifrar la información sensible o transmitirla a través de un canal de comunicación seguro.\n• Bloquear las direcciones IP reportadas en el firewall.",
                "risk" => "Al sobrecargar al sistema con ataques de fuerza bruta (de diccionario) se puede encontrar las credenciales de acceso, además el servidor puede dejar de atender las peticiones legítimas y desbordarse debido a la sobrecarga de peticiones, causando un cese de funciones.",
                "reference" => "http://www.jsitech.com/linux/protegiendo-nuestro-servidor-web-de-ataques-ddos-y-fuerza-bruta-con-mod_evasive/\nhttps://www.owasp.org/index.php/Web_Application_Firewall\nhttps://www.mulesoft.com/tcat/tomcat-security ",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "ET SCAN Tomcat Web Application Manager scanning",
                "description" => "La actividad generada muestra un escaneo sobre una vulnerabilidad web, dicha vulnerabilidad intenta explotar el módulo Tomcat Manager, este módulo simplemente intenta iniciar sesión en una instancia de Tomcat Manager Aplicación, utilizando las credenciales de usuario.",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar que la comunicación sea legítima.\n• Actualizar y aplicar parches de seguridad el servidor y al Sistema Operativo\n• Implementar herramientas que proveen seguridad adicional, por ejemplo el módulo “mod_evasive”.\n• Implementar una aplicación WAF (Web Application Firewall) con la que se pueden identificar y bloquear ataques a servidores web.\n• Reforzar la seguridad del equipo o equipos utilizando contraseñas robustas, para dificultar el acceso de equipos malintencionado.\n• Implementar un mecanismo de cifrado en los sistemas de autenticación de usuarios.\n• Cifrar la información sensible o transmitirla a través de un canal de comunicación seguro.\n• Bloquear las direcciones IP reportadas en el firewall.",
                "risk" => " En el proceso de escaneo se pueden  encontrar los servidores web Tomcat con datos de usuario  y contraseña por lo tanto hay una alta probabilidad de que puedan ser comprometidos los servidores.",
                "reference" => "http://www.jsitech.com/linux/protegiendo-nuestro-servidor-web-de-ataques-ddos-y-fuerza-bruta-con-mod_evasive/\nhttps://www.owasp.org/index.php/Web_Application_Firewall\nhttps://www.mulesoft.com/tcat/tomcat-security ",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "ET USER_AGENTS MarketScore.com Spyware User Configuration and Setup Access",
                "description" => "MarketScore es considerado como un Spyware, usualmente se instala sin consentimiento del usuario a través de algún otro software o consultas a páginas potencialmente maliciosas. Cuando se instala se inicia un servicio de proxy, una vez que el servicio se ejecuta, todas las conexiones de Internet serán enviados a través del proxy de Marketscore (OSSProxy). Como todas las conexiones de Internet pasarán por el proxy de Marketscore, la información puede ser registrada y analizada por entidades o usuarios malintencionados por lo que ésto podría crear riesgos en la seguridad del usuario y de la institución.",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar si el Malware MarketScore está instalado en el equipo, se ser así, desinstalarlo.\n• Analizar el equipo con un software antivirus actualizado en busca de Malware.\n• Verificar si el uso de Servidores Proxy externos está permitido por la institución.\n   o Si no está permitido, bloquear la dirección IP reportada en el firewall perimetral.\n• Validar que los parámetros de configuración Proxy del equipo sean los establecidos por a la institución.\n",
                "risk" => "El malware es software malicioso creado con la intención de introducirse de forma subrepticia en los computadores y causar daño a su usuario o conseguir un beneficio económico a sus expensas.",
                "reference" => "http://seguridadinformati.ca/articulos/malware\nhttp://www.pandasecurity.com/homeusers/security-info/52230/MarketScore",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "GAMES Battle.net connection reset (possible IP-Ban)",
                "description" => null,
                "recommendation" => "Validar si el acceso a sitios de entretenimiento está definido dentro de las políticas de uso aceptable para los equipos de cómputo de la institución.\n\nBloquear el acceso al sitio: battle.net",
                "risk" => "Infeccion del equipo por algun malware obtenido del sitio. Modificando el correcto funcionamiento del equipo.",
                "reference" => "http://comments.gmane.org/gmane.comp.security.ids.snort.devel/4293\nhttp://seclists.org/snort/2010/q2/540",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "ET WEB_SERVER Tilde in URI, potential .php~ source disclosure vulnerability",
                "description" => "La actividad generada muestra intentos de acceso mediante la vulnerabilidad web que permite al atacante inyectar secuencias de comandos web o PHP de su elección a través del parámetro tilde “~”",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Validar si los equipos presentan cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Revisar las aplicaciones instaladas así como los procesos ejecutados en el equipo, analizando que solo se tengan en ejecución las aplicaciones y procesos esenciales para llevar a cabo las funciones normales del equipo.\n*Realizar el endurecimiento en la configuración de los servidores críticos (Hardening).\n*Validar que el servidor cuente únicamente con los puertos/servicios requeridos para su operación (por ejemplo si es el equipo será solo un servidor de impresión, no se necesitan servicios de ssh, telnet, remote desktop).\n*Antes de publicar algún servicio a internet asegurar la existencia y ejecución de procedimientos de endurecimiento (hardening) de configuraciones y la aplicación de guías correspondientes en seguridad de host y aplicativos web.",
                "risk" => "Divulgación de información a usuarios no autorizados.",
                "reference" => "https://www.cs.tut.fi/~jkorpela/tilde.html\nhttp://stackoverflow.com/questions/6252471/what-is-the-use-of-tilde-in-url",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "ET WEB_SERVER WEB-PHP phpinfo access",
                "description" => "Se detectaron peticiones que intentan explotar una vulnerabilidad encontrada en el software Invasion Board, el cual entre sus funciones permite crear foros o sitios web de manera sencilla._x000D_\nLa vulnerabilidad se da después de la instalación de Invasion Board el cual sugiere instalar phpinfo.php en el directorio web raíz del servidor, dicho programa es básicamente un archivo que contiene gran cantidad de información considerable sobre el servidor, entre otras cosas, contiene la versión del servidor, dirección IP, configuraciones básicas e incluso usuarios en el servidor._x000D_\nEsto supone un riesgo en la seguridad del equipo y la red en general, debido a que un atacante podría obtener acceso a dicho archivo y contar con información sensible de nuestro servidor, pudiendo obtener acceso al equipo o control total mediante herramientas de software especializadas._x000D_\n",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Actualizar la versión de php que se esté ejecutando en el servidor, así  como el Sistema Operativo.\n• Verificar si es indispensable para la institución el uso de phpinfo(), de no serlo se recomienda deshabilitar dicha función en el archivo php.ini\ndisable_functions = phpinfo\n• Implementar una aplicación WAF (Web Application Firewall) con la que se pueden identificar y bloquear estet tipo de ataques. ",
                "risk" => "Mediante el uso de la función phpinfo(),se puede obtener información sobre la configuración de PHP, como los valores de las directivas de PHP, extensiones cargadas y variables de entorno, que pueden ser usados por los atacantes para conocer las vulnerabilidades del sistema y poder explotarlas posteriormente.",
                "reference" => "https://www.owasp.org/index.php/Web_Application_Firewall\nhttp://www.desarrolloweb.com/articulos/desactivar-funciones-php.html\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "EVENTS TDS - in.php",
                "description" => "Se identificaron peticiones en las cuales se detectó el uso de exploit de TDS Sutra, el cual redirige el tráfico del navegador web hacia sitios con software malicioso. Dicho exploit está diseñado en código PHP por lo que no solo podría redirigir el tráfico sino que también puede realizar otras acciones como acceso o control total de equipo sin autorización o extracción de información sensible por lo que representa un riesgo en la seguridad del equipo._x000D_",
                "recommendation" => "Actualizar todos los complementos y aplicaciones utilizadas, así como el sistema operativo del equipo involucrado.\n\nVerificar la correcta configuración de los equipos y descartar alteraciones en el correcto funcionamiento.",
                "risk" => "Comprometer la información y seguridad de los servidores involucrados.",
                "reference" => "http://www.freetds.org/userguide/php.htm",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Facebook Chat using XMPP",
                "description" => "Facebook chat es una servicio de mensajería instantánea, del sitio de la red social Facebook, que provee comunicación por voz y texto. Utiliza el protocolo XMPP para realizar las comunicaciones.\nXMPP (Extensible Messaging and Presence Protocol) es un protocolo basado en XML, originalmente ideado para mensajería instantánea, requiere del puerto 5222 para realizar la comunicación, así como de cifrado TLS y autenticación SASL PLAIN.",
                "recommendation" => "Bloquear las conexiones hacia el Puerto 5222, utilizado por el protocolo XMPP\nPara Sistemas Operativos Windows:\n• Ingresar en el Panel de control. \n• En el cuadro de búsqueda, escriba firewall y, a continuación, haga clic en Firewall de Windows.\n• Ingresar en Configuración avanzada.\n• Ingresar en Nueva regla y seguir las instrucciones para agregar una regla.\n\nValidar si el acceso a redes sociales está definido dentro de las políticas de uso aceptable para los equipos de cómputo de la institución.",
                "risk" => "Infeccion por malware, acceso al equipo sin autorizacion por el uso de aplicaciones no aceptadas para el uso de la institucion.",
                "reference" => "http://xmpp.org/rfcs/rfc3920.html\nhttp://www.speedguide.net/port.php?port=5222",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "EVENTS VBSAutorun_VBS_Jenxcus Check-in UA",
                "description" => "Se detectaron peticiones con una cabecera User-Agent anormal, el User-Agent esta relacionado con el malware Jenxcus._x000D_\nJenxcus es considerado un worm debido a que tiene la capacidad de infectar otros dispositivos conectados en el equipo infectado. La infección puede ser mediante la ejecución manual del archivo infectado. También se encuentra en sitios web que realizan ataque del tipo Drive-By download, que permite instalar generalmente software malicioso al acceder a un sitio web sin autorización del usuario.\nEste worm puede robar información del equipo infectado, infectar el equipo con otro tipo de malware, recolectar información del usuario y enviarla a servidores C&C. Esto pone en riesgo la seguridad del equipo.",
                "recommendation" => "Buscar y eliminar alguno de los siguientes archivos relacionados con el Worm Jenxcus:\n• crypted.vbs\n• do.vbs\n• file.vbs\n• nj-worm.vbs\n• servieca.vbs\n• system32.vbs\n• Taakj2005.vbs\n• temp.vbs\n\nBuscar los siguientes registros relacionados con el Worm Jenxus y eliminarlos:\n• HKEY_USERS\\S-1-5[Varies]\\Software\\Microsoft\\Windows Script Host\n• HKEY_USERS\\S-1-5[Varies]\\Software\\Microsoft\\Windows Script Host\\Settings\n• HKLM\\Software\\Microsoft\\Windows\\CurrentVersion\\Run o HKCU\\Software\\Microsoft\\Windows\\CurrentVersion\\Run\nvalor: \" <nombre de archivo de malware> \", por ejemplo\"Serviecs.vbs\" \nDatos: \" <carpeta y nombre de archivo de malware> \", por ejemplo,\"%TEMP%\\Serviecs.vbs\"",
                "risk" => "Infección y propagación del malware hacia diversos sectores de la red, pudiendo presentarse fuga de informacion",
                "reference" => "http://www.microsoft.com/security/portal/threat/encyclopedia/entry.aspx?ThreatId=-2147283579&mstLocPickShow=False#tab=2\nhttp://home.mcafee.com/virusinfo/virusprofile.aspx?key=3320377",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "EXE File Uploaded - Hex Encoded",
                "description" => "Se detectaron peticiones en las cuales se identificó que se intenta cargar un archivo con formato EXE, formato estándar de archivos ejecutables en Sistemas Operativos Windows. El archivo que se intenta subir cuenta con características de un archivo codificado en formato hexadecimal._x000D_\nGeneralmente archivos en formato EXE que no contienen una firma del proveedor son usados para la distribución de malware. Esto supone un riesgo para el equipo involucrado ya que en caso de ser un malware podría verse afectado el correcto funcionamiento del equipo._x000D_",
                "recommendation" => "Revisar la configuración web de los servidores, con el fin de evitar algún ataque exitoso.\n\nImplementar una aplicación WAF para detectar y bloquear la subida de archivos maliciosos a servidores web.",
                "risk" => "Originar mal funcionamiento de los equipos involucrados a traves de archivos ejecutables que dañen el sistema operativo u otras aplicaciones.",
                "reference" => "http://revista.seguridad.unam.mx/numero-16/firewall-de-aplicaci%C3%B3n-web-parte-i",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "General MSN Chat Activity",
                "description" => null,
                "recommendation" => "Validar si el uso de aplicaciones de mensajería instantánea está definido dentro de las políticas de uso aceptable para los equipos de cómputo de la institución. En caso de no estar permitido se sugiere desinstalar dichas aplicaciones.",
                "risk" => "Provocar fuga de información, adquirir codigo malicioso.",
                "reference" => "http://www.eset-la.com/pdf/prensa/informe/amigo_falso_malware_mensajero.pdf\nhttp://www.rafayhackingarticles.net/2013/02/chat-malware-skype-and-msn-messenger.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "EXPLOIT ISAPI .ida access",
                "description" => "Esta firma detecta un intento de acceder a un IIS (Internet Information Server) a un archivo de Administración de Datos de Internet (.ida) o Internet Data Query (.idq). Este evento podría indicar el intento de un atacante para bloquear el servicio IIS o ejecutar código arbitrario en el sistema mediante la explotación de una condición de desbordamiento de búfer. Existe una vulnerabilidad de desbordamiento de búfer debido a una inadecuada comprobación en el filtro ISAPI .ida. Esto puede permitir la ejecución de comandos arbitrarios con privilegios de administrador en el servidor vulnerable. Se presenta en sistemas operativos Windows Server_x000D_\nEsta vulnerabilidad es explotable mediante el gusano \"Code Red\" y el gusano \"Code Red II\".",
                "recommendation" => "Validar el tráfico generado entre las direcciones IP.\n\nDesactivar los servicios que no son necesarios.\n\nHabilitar las siguientes comprobaciones en el servidor: \nHTTP_Code_Red \nHTTP_Code_Red_II \nHTTP_Code_Red_II_Plus \nHTTP_IIS_Index_Server_Overflow \nHTTP_IIS_Idq_Overflow \nHTTP_IIS_Ida_Overflow\n\nAplicar las últimas actualizaciones al sistema operativo y las aplicaciones utilizadas en el servidor.",
                "risk" => "Puede provocar fuga de informacion sensible, acceso al equipo de maanera remota por usuarios no autorizados.",
                "reference" => "http://www.iss.net/security_center/reference/vuln/HTTP_IIS_Index_Server_Overflow.htm\nhttps://www.sans.org/security-resources/malwarefaq/code-red.php",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Exploit Suspected PHP Injection Attack (cmd=)",
                "description" => "Esta firma nos indica que durante una solicitud al servidor web comprometido se detectó la cadena \"cmd=\" dentro de la URI de una solicitud GET. Esta cadena anexada a la solicitud permitiría poder ejecutar comandos de manera arbitraria de forma remota y sin la necesidad de tener que autenticarse._x000D_\nSe corre el riesgo de que algún atacante o entidad maliciosa tome el control total del servidor, se genere pérdida de información, se genere un ataque de denegación de servicios (DoS).",
                "recommendation" => "Verificar la configuración de los servidores web.\n\nImplementar una aplicación WAF para detectar y bloquear la subida de archivos maliciosos a servidores web.",
                "risk" => "Puede provocar fuga de informacion sensible, acceso al equipo de maanera remota por usuarios no autorizados.",
                "reference" => "http://revista.seguridad.unam.mx/numero-16/firewall-de-aplicaci%C3%B3n-web-parte-i",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "External IP Lookup Attempt To Wipmania",
                "description" => "Wipmania brinda un servicio gratuito de geolocalización que proporciona el país de la dirección IP que sea consultada.\nEste servicio es comúnmente usado por agentes maliciosos, (botnet) para obtener información de la localización de los bots que forman dicha red, para realizar ataques desde localizaciones específicas.",
                "recommendation" => "Bloquear el acceso al sitio: api.wipmania.com. El boqueo pude realizarse de manera local o en caso de contar con un servidor de filtrado e contenido web agregar una regla específica para dicho sitio.\nIr al archivo \"hosts\" que se encuentra en la dirección C:\\windows\\System32\\drivers\\etc ----> añadir en el archivo hosts 127.0.0.1 sitio_a_bloquear",
                "risk" => "Infeccion del equipo por algun malware obtenido del sitio. Modificando el correcto funcionamiento del equipo.",
                "reference" => "http://lavasoft.com/mylavasoft/malware-descriptions/blog/WormWin32Dorkbotcb53851f95\nhttp://stopmalvertising.com/rootkits/analysis-of-ngrbot.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "FOCA User-Agent",
                "description" => "FOCA es una herramienta para la realización de procesos de “fingerprinting” e “information gathering” en trabajos de auditoría web, esta herramienta no realiza solo la extracción de metadatos, sino que además realiza búsquedas de servidores, dominios, URL’s y documentos publicados, así como el descubrimiento de versiones de software en servidores y clientes.",
                "recommendation" => "Validar el uso de la herramienta FOCA, utilizada para el análisis de metadatos.\n\nEn caso de no utilizar dicha herramienta y tratarse de un equipo interno identificarlo y desinstalar dicha aplicación.\n\nValidar el tráfico generado por las direcciones IP.\n\nImplementar una aplicación WAF para detectar y bloquear la subida de archivos maliciosos a servidores web.",
                "risk" => "Reconocimento de la estrcutura de la red para detectar vulnerabilidades.",
                "reference" => "http://www.dragonjar.org/foca-herramienta-para-analisis-meta-datos.xhtml\nhttp://revista.seguridad.unam.mx/numero-16/firewall-de-aplicaci%C3%B3n-web-parte-i",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "FTP Login Successful",
                "description" => "(FTP) es un protocolo que sirve para transferir archivos a través de las redes de datos. Por lo general, FTP se usa para poner archivos a disposición de otras entidades (personas o procesos) para que puedan descargarlos\n Para acceder a los recursos en el servidor FTP, se debe tener un cliente FTP que inicie sesión en el servidor. El mensaje de “Login successfull” indica que un cliente ha establecido la comunicación con el servidor.",
                "recommendation" => "Verificar el acceso de usuarios que tienen acceso mediante FTP.\n\nEn caso de no validar el usuario, crear un control de acceso en el servidor FTP.\n\nImplementar SFTP para realizar transferencias de archivos de forma segura.",
                "risk" => "Acceso al equipo sin autorizacion, fuga de informacion sensible e incluso acceso a diversos recursos d ela red.",
                "reference" => "http://docs.oracle.com/cd/E24842_01/html/E22524/wuftp-43.html\nhttps://www.digitalocean.com/community/tutorials/how-to-use-sftp-to-securely-transfer-files-with-a-remote-server",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Fun Web Products Spyware User-Agent (FunWebProducts)",
                "description" => null,
                "recommendation" => "Eliminar las siguientes entradas de registro, para ver la lista completa ver referencias:\n• HKEY_LOCAL_MACHINE\\SOFTWARE\\FUNWEBPRODUCTS\\INSTALLER\\DIR = %PROGRAMFILES%\\FunWebProducts\\Installr\\\n• HKEY_LOCAL_MACHINE\\SOFTWARE\\FUNWEBPRODUCTS\\INSTALLER\\PL = 57\n• HKEY_LOCAL_MACHINE\\SOFTWARE\\FUNWEBPRODUCTS\\INSTALLER\\PLUGINPATH = %PROGRAMFILES%\\FunWebProducts\\Installr\\1.bin\\\n• HKEY_LOCAL_MACHINE\\SOFTWARE\\FUNWEBPRODUCTS\\INSTALLER\\SR = 48",
                "risk" => "Infección y propagación de malware hacia diversos sectores de la red, recopilacion de informacion del usuario mediante el uso de navegadores web.",
                "reference" => "http://home.mcafee.com/virusinfo/virusprofile.aspx?key=6837093\nhttp://www.securitystronghold.com/es/gates/funwebproducts.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Generic - POST To .php w/Extended ASCII Characters",
                "description" => null,
                "recommendation" => "Verificar el equipo con un software antivirus actualizado en busca de malware.\n\nEliminar los siguientes archivos y  entradas de registro relacionadas con el troyano TROJAN.GENERICKD.1855143_0DA84AD4EC:\n• %Documents and Settings%\\%current user%\\Local Settings\\Temp\\construability\\joes.vhd (5064 bytes)\n• %Documents and Settings%\\%current user%\\Local Settings\\Temp\\nsr2.tmp (4232 bytes)\n• %Documents and Settings%\\%current user%\\Local Settings\\Temp\\nst3.tmp\\kVVAwwztgyq.dll (2392 bytes)\n• [HKLM\\SOFTWARE\\Microsoft\\Cryptography\\RNG] \"Seed\" = \"8B 06 6D C6 95 94 15 6B 2F 5D 04 76 86 97 F3 8E\"\n• [HKCU\\Software\\Microsoft\\Windows\\CurrentVersion\\Explorer\\MountPoints2\\[c155cd73-744b-11e2-8294-806d6172696f}] \"BaseClass\" = \"Drive\"\n• [HKCU\\Software\\Microsoft\\Windows\\CurrentVersion\\Explorer\\MountPoints2\\[c155cd72-744b-11e2-8294-806d6172696f}] \"BaseClass\" = \"Drive\"\n• [HKCU\\Software\\Microsoft\\Windows\\CurrentVersion\\Explorer\\MountPoints2\\[b98117e8-75ca-11e2-81b2-000c293708fb}] \"BaseClass\" = \"Drive\"\n• [HKCU\\Software\\Microsoft\\Windows\\CurrentVersion\\Explorer\\MountPoints2\\[c155cd75-744b-11e2-8294-806d6172696f}] \"BaseClass\" = \"Drive\"",
                "risk" => "fuga de información, acceso remoto sin autorización y generar mal funcionamiento en los equipos asi como las distribucion de malware dentro de la red interna.",
                "reference" => "http://lavasoft.com/mylavasoft/malware-descriptions/blog/TrojanGenericKD18551430da84ad4ec\nhttp://malware-traffic-analysis.net/2014/01/26/index.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Generic Remote File Include Attempt (FTP)",
                "description" => null,
                "recommendation" => "Actualizar las aplicaciones y complementos utilizados en el servidor web proporcionados por el proveedor.\n\nImplementar una aplicación WAF para detectar y bloquear la subida de archivos maliciosos a servidores web.\n\nVerificar el acceso de usuarios que tienen acceso mediante FTP. En caso de no validar el usuario, crear un control de acceso en el servidor FTP.\n\nImplementar SFTP para realizar transferencias de archivos de forma segura.",
                "risk" => "fuga de información, acceso remoto sin autorización e incluso accesoa a diversos recursos de la red.",
                "reference" => "http://revista.seguridad.unam.mx/numero-16/firewall-de-aplicaci%C3%B3n-web-parte-\nhttp://docs.oracle.com/cd/E24842_01/html/E22524/wuftp-43.html\nhttps://www.digitalocean.com/community/tutorials/how-to-use-sftp-to-securely-transfer-files-with-a-remote-server",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Google Desktop User-Agent Detected",
                "description" => null,
                "recommendation" => "Validar si el uso de estas aplicaciones o complementos está definido dentro de las políticas de uso aceptable para los equipos de cómputo de la institución. En caso de no estar permitido proceder a su desinstalación.",
                "risk" => "Provocar fuga de información, adquirir codigo malicioso.",
                "reference" => "http://www.sanspantalones.com/2013/12/12/removing-googledesktopinstall-malwarevirus/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Google IM traffic Jabber client sign-on",
                "description" => null,
                "recommendation" => "Validar si el acceso a redes sociales está definido dentro de las políticas de uso aceptable para los equipos de cómputo de la institución.\n\nBloquear las conexiones hacia el Puerto 5222, utilizado por el protocolo XMPP\nPara Sistemas Operativos Windows:\n• Ingresar en el Panel de control. \n• En el cuadro de búsqueda, escriba firewall y, a continuación, haga clic en Firewall de Windows.\n• Ingresar en Configuración avanzada.\n• Ingresar en Nueva regla y seguir las instrucciones para agregar una regla.",
                "risk" => "Provocar fuga de información, adquirir codigo malicioso.",
                "reference" => "http://xmpp.org/rfcs/rfc3920.html\nhttp://www.speedguide.net/port.php?port=5222",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Google Talk (Jabber) Client Login",
                "description" => null,
                "recommendation" => "Validar si el acceso a redes sociales está definido dentro de las políticas de uso aceptable para los equipos de cómputo de la institución.\n\nBloquear las conexiones hacia el Puerto 5222, utilizado por el protocolo XMPP\nPara Sistemas Operativos Windows:\n• Ingresar en el Panel de control. \n• En el cuadro de búsqueda, escriba firewall y, a continuación, haga clic en Firewall de Windows.\n• Ingresar en Configuración avanzada.\n• Ingresar en Nueva regla y seguir las instrucciones para agregar una regla.",
                "risk" => "Provocar fuga de información, adquirir codigo malicioso.",
                "reference" => "http://xmpp.org/rfcs/rfc3920.html\nhttp://www.speedguide.net/port.php?port=5222",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Google Talk Logon",
                "description" => null,
                "recommendation" => "Validar si el acceso a redes sociales está definido dentro de las políticas de uso aceptable para los equipos de cómputo de la institución.\n\nBloquear las conexiones hacia el Puerto 5222, utilizado por el protocolo XMPP\nPara Sistemas Operativos Windows:\n• Ingresar en el Panel de control. \n• En el cuadro de búsqueda, escriba firewall y, a continuación, haga clic en Firewall de Windows.\n• Ingresar en Configuración avanzada.\n• Ingresar en Nueva regla y seguir las instrucciones para agregar una regla.",
                "risk" => "Provocar fuga de información, adquirir codigo malicioso.",
                "reference" => "http://xmpp.org/rfcs/rfc3920.html\nhttp://www.speedguide.net/port.php?port=5222",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Google Talk Version Check",
                "description" => null,
                "recommendation" => "Validar si el acceso a redes sociales está definido dentro de las políticas de uso aceptable para los equipos de cómputo de la institución.\n\nBloquear las conexiones hacia el Puerto 5222, utilizado por el protocolo XMPP\nPara Sistemas Operativos Windows:\n• Ingresar en el Panel de control. \n• En el cuadro de búsqueda, escriba firewall y, a continuación, haga clic en Firewall de Windows.\n• Ingresar en Configuración avanzada.\n• Ingresar en Nueva regla y seguir las instrucciones para agregar una regla.",
                "risk" => "Provocar fuga de información, adquirir codigo malicioso.",
                "reference" => "http://xmpp.org/rfcs/rfc3920.html\nhttp://www.speedguide.net/port.php?port=5222",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "GPL ICMP_INFO PING *NIX",
                "description" => null,
                "recommendation" => "Validar la conexión entre las direcciones IP\n\nEn caso de no requerir el uso del protocolo ICMP, se puede deshabilitar desde el firewall de Windows :\n• Abrir firewall \uF0E0 Ir a opciones avanzadas \uF0E0 Elegir ICMP \uF0E0 Deshabilitar el protocolo\n\nEn el caso de sistemas operativo Linux mediante la herramienta Iptables:\nSERVER_IP=\"x.x.x.x\"\n• iptables -A INPUT -p icmp --icmp-type 8 -s 0/0 -d \$SERVER_IP -m state --state NEW,ESTABLISHED,RELATED -j ACCEPT\n• iptables -A OUTPUT -p icmp --icmp-type 0 -s \$SERVER_IP -d 0/0 -m state --state ESTABLISHED,RELATED -j ACCEPT\n",
                "risk" => "Acceso al equipo sin autorizacion,  acceso a diversos recursos de la red.",
                "reference" => "https://technet.microsoft.com/en-us/library/cc786463(v=ws.10).aspx\nhttp://www.cyberciti.biz/tips/linux-iptables-9-allow-icmp-ping.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "GPL ICMP_INFO PING speedera",
                "description" => null,
                "recommendation" => "Verificar si se cuenta con servicios proporcionados por el proveedor speedera o se tiene comunicación con sitios relacionados con el proveedor.\n\nEn caso de no requerir el uso del protocolo ICMP, se puede deshabilitar desde el firewall de Windows :\n• Abrir firewall \uF0E0 Ir a opciones avanzadas \uF0E0 Elegir ICMP \uF0E0 Deshabilitar el protocolo\n\nEn el caso de sistemas operativo Linux mediante la herramienta Iptables:\nSERVER_IP=\"x.x.x.x\"\n• iptables -A INPUT -p icmp --icmp-type 8 -s 0/0 -d \$SERVER_IP -m state --state NEW,ESTABLISHED,RELATED -j ACCEPT\n• iptables -A OUTPUT -p icmp --icmp-type 0 -s \$SERVER_IP -d 0/0 -m state --state ESTABLISHED,RELATED -j ACCEPT",
                "risk" => "Acceso al equipo sin autorizacion,  acceso a diversos recursos de la red.",
                "reference" => "http://mysecurity.zyxel.com/mysecurity/jsp/policy.jsp?ID=1048899\nhttps://technet.microsoft.com/en-us/library/cc786463(v=ws.10).aspx\nhttp://www.cyberciti.biz/tips/linux-iptables-9-allow-icmp-ping.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "GPL NETBIOS SMB IPC$ unicode share access",
                "description" => null,
                "recommendation" => "Verificar que las conexiones entre las direcciones IP sean legítimas.\nEn caso de no reconocer dichas conexiones restringir el acceso mediante SMB, configurando el parámetro IPC$ en el archivo de configuración de SMB:\n\n[IPC$]\nhosts allow = x.x.x.x/x.x.x.x\nhosts deny = x.x.x.x/x",
                "risk" => "Acceso al equipo sin autorizacion,  acceso a diversos recursos de la red.",
                "reference" => "https://www.samba.org/samba/docs/man/Samba-HOWTO-Collection/securing-samba.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "GPL NETBIOS SMB repeated logon failure",
                "description" => null,
                "recommendation" => "Verificar que las conexiones entre las direcciones IP sean legítimas.\n\nEn caso de no requerir el uso de SMB para compartir archivos e impresoras, deshabilitar Netbios desde el adaptador de red:\n• Ir a Panel de control.\n• En red e Internet, haga clic en tareas y ver el estado de red.\n• Haga clic en Cambiar configuración del adaptador.\n• Haga clic en Conexión de área Local y, a continuación, haga clic en Propiedades.\n• En la lista esta conexión utiliza los siguientes elementos, haga doble clic en Protocolo de Internet versión 4 (TCP/IPv4), haga clic en Avanzadas y, a continuación, haga clic en la ficha WINS.\n• Deshabilitar Netbios.",
                "risk" => "Acceso al equipo sin autorizacion,  acceso a diversos recursos de la red y generar funcionamiento incorrecto en los equipos involucrados.",
                "reference" => "https://support.microsoft.com/es-es/kb/313314/es",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "GPL NETBIOS SMB Session Setup NTMLSSP unicode asn1 overflow attempt",
                "description" => null,
                "recommendation" => "Verificar que las conexiones entre las direcciones IP sean legítimas.\n\nEn caso de no requerir el uso de SMB para compartir archivos e impresoras, deshabilitar Netbios desde el adaptador de red:\n• Ir a Panel de control.\n• En red e Internet, haga clic en tareas y ver el estado de red.\n• Haga clic en Cambiar configuración del adaptador.\n• Haga clic en Conexión de área Local y, a continuación, haga clic en Propiedades.\n• En la lista esta conexión utiliza los siguientes elementos, haga doble clic en Protocolo de Internet versión 4 (TCP/IPv4), haga clic en Avanzadas y, a continuación, haga clic en la ficha WINS.\n• Deshabilitar Netbios.",
                "risk" => "Acceso al equipo sin autorizacion,  acceso a diversos recursos de la red y generar funcionamiento incorrecto en los equipos involucrados.",
                "reference" => "https://support.microsoft.com/es-es/kb/313314/es",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "GPL NETBIOS SMB-DS ADMIN$ unicode share access",
                "description" => null,
                "recommendation" => "Validar las conexiones entre las direcciones IP.\n\nComprobar que se encuentre deshabitada la función de administración remota mediante ADMIN$, para ello ingresar a la siguiente entrada de registro y verificar o asignar el valor de 1.\nHKEY_LOCAL_MACHINE\\SOFTWARE\\Microsoft\\Windows\\CurrentVersion\\Policies\\System. Create a DWORD value called LocalAccountTokenFilterPolicy",
                "risk" => "Acceso al equipo sin autorizacion,  acceso a diversos recursos de la red y generar funcionamiento incorrecto en los equipos involucrados.",
                "reference" => "http://support.adminarsenal.com/entries/20828513-Can-t-access-ADMIN-share-using-a-local-user-account",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "GPL NETBIOS SMB-DS IPC$ share access",
                "description" => null,
                "recommendation" => "Verificar que las conexiones entre las direcciones IP sean legítimas.\nEn caso de no reconocer dichas conexiones restringir el acceso mediante SMB, configurando el parámetro IPC$ en el archivo de configuración de SMB:\n\n[IPC$]\nhosts allow = x.x.x.x/x.x.x.x\nhosts deny = x.x.x.x/x\n",
                "risk" => "Acceso al equipo sin autorizacion,  acceso a diversos recursos de la red y generar funcionamiento incorrecto en los equipos involucrados.",
                "reference" => "https://www.samba.org/samba/docs/man/Samba-HOWTO-Collection/securing-samba.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "GPL NETBIOS SMB-DS IPC$ unicode share access",
                "description" => null,
                "recommendation" => "Verificar que las conexiones entre las direcciones IP sean legítimas.\nEn caso de no reconocer dichas conexiones restringir el acceso mediante SMB, configurando el parámetro IPC$ en el archivo de configuración de SMB:\n\n[IPC$]\nhosts allow = x.x.x.x/x.x.x.x\nhosts deny = x.x.x.x/x",
                "risk" => "Acceso al equipo sin autorizacion,  acceso a diversos recursos de la red y generar funcionamiento incorrecto en los equipos involucrados.",
                "reference" => "https://www.samba.org/samba/docs/man/Samba-HOWTO-Collection/securing-samba.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "GPL NETBIOS SMB-DS repeated logon failure",
                "description" => null,
                "recommendation" => "Verificar que las conexiones entre las direcciones IP sean legítimas.\n\nEn caso de no requerir el uso de SMB para compartir archivos e impresoras, deshabilitar Netbios desde el adaptador de red:\n• Ir a Panel de control.\n• En red e Internet, haga clic en tareas y ver el estado de red.\n• Haga clic en Cambiar configuración del adaptador.\n• Haga clic en Conexión de área Local y, a continuación, haga clic en Propiedades.\n• En la lista esta conexión utiliza los siguientes elementos, haga doble clic en Protocolo de Internet versión 4 (TCP/IPv4), haga clic en Avanzadas y, a continuación, haga clic en la ficha WINS.\n• Deshabilitar Netbios.",
                "risk" => "Acceso al equipo sin autorizacion,  acceso a diversos recursos de la red y generar funcionamiento incorrecto en los equipos involucrados.",
                "reference" => "https://support.microsoft.com/es-es/kb/313314/es",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "GPL SHELLCODE x86 0x90 NOOP unicode",
                "description" => null,
                "recommendation" => "Verificar que las conexiones entre las direcciones IP sean legítimas.\n\nRealizar una revisión manual de los equipos involucrados con las direcciones IP internas reportadas, en busca de probables programas maliciosos o no permitidos por la institución.",
                "risk" => "Infeccion de los equipos por software o codigo malicioso y posible fucionamiento incorrecto de los mismos.",
                "reference" => "http://www.ids-sax2.com/Policies/SHELLCODE_x86_0x90_unicode_NOOP.htm\nhttp://mysecurity.zyxel.com/mysecurity/jsp/policy.jsp?ID=1050733\nhttp://malware-traffic-analysis.net/2014/05/03/index.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "GPL SHELLCODE x86 inc ebx NOOP",
                "description" => null,
                "recommendation" => "Verificar que las conexiones entre las direcciones IP sean legítimas.\n\nRealizar una revisión manual de los equipos involucrados con las direcciones IP internas reportadas, en busca de probables programas maliciosos o no permitidos por la institución.",
                "risk" => "Infeccion de los equipos por software o codigo malicioso y posible fucionamiento incorrecto de los mismos.",
                "reference" => "https://defensepointsecurity.com/news/blog/280-indicators-of-exploitation-ms08-067\nhttp://security.stackexchange.com/questions/16111/snort-rules-question",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "HTTP POST Generic eval of base64_decode",
                "description" => null,
                "recommendation" => "Actualizar todos los complementos y aplicaciones utilizadas, así como el sistema operativo del equipo involucrado.\n\nImplementar una aplicación WAF para detectar y bloquear la subida de archivos maliciosos a servidores web.",
                "risk" => "Ingreso de codigo malicioso que afecte el funcionamiento de los equipos y propagandose por toda la red interna. Tambien pone en riesgo la información sensible para la institución debido a que el ingreso de codigo malicioso va dirigido a los servidores web o de base de datos.",
                "reference" => "http://revista.seguridad.unam.mx/numero-16/firewall-de-aplicaci%C3%B3n-web-parte-i",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "GPL TFTP GET passwd",
                "description" => null,
                "recommendation" => "Se recomienda el cumplimiento de las siguientes características de una contraseña segura: \n• La contraseña debe constar de al menos 12 caracteres.\n• Debe contener caracteres alfanuméricos.\n• Debe contener caracteres especiales.\n• Debe combinar mayúsculas y minúsculas.\n\nVerificar el acceso de usuarios o equipos que tienen acceso mediante TFTP. En caso de no permitir el intercambio de archivos mediante TFTP deshabilitarlo de la siguiente manera:\nIr a panel de control \uF0E0 Programas y características \uF0E0 Activar o desactivar las características de Windows \uF0E0 Desactivar la opción de “Cliente TFTP”\n\nImplementar SFTP para realizar transferencias de archivos de forma segura.",
                "risk" => "Obtención de las credenciales de acceso a diversos recursos de la institución que ponen en riesgo información sensible comprometiendo el correcto funcionamiento de los equipos y  la red en general.",
                "reference" => "http://revista.seguridad.unam.mx/numero-16/firewall-de-aplicaci%C3%B3n-web-parte-\nhttp://blogs.itpro.es/jioller/2011/02/21/instalacion-de-cliente-de-tftp-en-windows-7/\nhttps://www.digitalocean.com/community/tutorials/how-to-use-sftp-to-securely-transfer-files-with-a-remote-server",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "GPL WEB_SERVER 403 Forbidden",
                "description" => null,
                "recommendation" => "Verificar la correcta configuración del servidor web.\n\nComo medida preventiva verificar que todos los complementos y aplicaciones se encuentren en la versión más reciente proporcionada por el proveedor.",
                "risk" => "Posible deneagción de servicio hacia los servidores de la institución o acceso a ellos poniendo en riesgo la información o funcionamiento de los equipos.",
                "reference" => "http://www.checkupdown.com/status/E403.html\nhttps://www.astaro.org/gateway-products/network-protection-firewall-nat-qos-ips/18321-attack-responses-403-forbidden.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Havij SQL Injection Tool User-Agent Inbound",
                "description" => null,
                "recommendation" => "Validar si el uso de la herramienta Havij está permitida para la realización de pruebas. En caso de no estar permitida y tratarse de un equipo interno identificarlo y desinstalar dicha aplicación.\n\nVerificar la correcta configuración de los servidores involucrados.\n\nImplementar una aplicación WAF para detectar y bloquear la subida de archivos maliciosos a servidores web.",
                "risk" => "Fuga o modificacion de la informacion sensible para la institucion.",
                "reference" => "http://revista.seguridad.unam.mx/numero-16/firewall-de-aplicaci%C3%B3n-web-parte-i",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Hex Obfuscated JavaScript Heap Spray 41414141",
                "description" => null,
                "recommendation" => "Mantener actualizadas todas las aplicaciones y complementos utilizados en el servidor.\n\nImplementar una aplicación WAF para detectar y bloquear la subida de archivos maliciosos a servidores web.",
                "risk" => "Ingeso de codigo malicioso a la red interna provocando funcionamiento incorrecto y propagacion de malware.",
                "reference" => "http://revista.seguridad.unam.mx/numero-16/firewall-de-aplicaci%C3%B3n-web-parte-i",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Hiloti Style GET to PHP with invalid terse MSIE headers",
                "description" => null,
                "recommendation" => "Eliminar los siguientes procesos:\nregedit.exe:3680\n%original file name%.exe:3668\n\nEliminar las siguientes entradas de registro:\n• [HKCU\\Software\\Microsoft\\Windows\\CurrentVersion\\Run]\n\"HTTPFilter\" = \"%Documents and Settings%\\%current user%\\Local Settings\\HTTPFilter.exe\"\n• HKEY_LOCAL_MACHINE\\ SOFTWARE\\ Microsoft\\ Windows\\ CurrentVersion\\ Runrundll32.exe\n• HKEY_LOCAL_MACHINE\\SOFTWARE\\Microsoft\\Windows\\CurrentVersion\\Explorer\\Browser Helper Objects\\%CLSID aleatorio%\n• HKEY_CURRENT_USER\\Software\\Microsoft\\Windows\\CurrentVersion\\Explorer\\Browser Helper Objects\\%CLSID aleatorio%\n• HKEY_CURRENT_USER\\Software\\Mozilla\\Firefox\\Extensions\\sample@example.net",
                "risk" => "Ingreso de malware que afecta el funcionamiento del sistema operativo  y el desempeño optimo del equipo, ademas dicho malware puede propagarse en toda la red interna.",
                "reference" => "http://www.lavasoft.com/mylavasoft/malware-descriptions/blog/GenVariantKazy2903271206f7d359\nhttp://www.pandasecurity.com/mexico/homeusers/security-info/208237/information/Hiloti.A",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Http Client Body contains pass= in cleartext",
                "description" => null,
                "recommendation" => "Validar en las políticas de uso institucionales el acceso a los sitios reportados. En caso de estar permitidos Fortalecer la seguridad en la contraseña:\n• La contraseña debe constar de al menos 12 caracteres.\n• Debe contener caracteres alfanuméricos.\n• Debe contener caracteres especiales.\n• Debe combinar mayúsculas y minúsculas\n\nHabilitar SSL ó TLS en el servidor web.\nSi el servidor cuenta con Sistema Operativo Windows:\n• Obtener un certificado SSL siguiendo los pasos mostrados en el enlace [1]\n• Desde la consola de Administración del equipo, haga clic con el botón secundario del mouse en el que desea utilizar SSL y haga clic en Propiedades.\n• Haga clic en la ficha Sitio Web. En la sección Identificación del sitio Web, compruebe que en el campo Puerto SSL aparece el valor numérico 443.\n• Haga clic en Avanzadas. Deben aparecer dos campos. La dirección IP y el puerto del sitio Web deben aparecer en el campo Identidades múltiples para este sitio Web. En el campo Múltiples identidades SSL para este sitio Web, haga clic en Agregar si el puerto 443 no aparece en la lista. Seleccione la dirección IP del servidor y escriba el valor numérico 443 en el campo Puerto SSL. Haga clic en Aceptar.\n• El puerto 443 aparecerá habilitado, por lo que ya se pueden utilizar conexiones SSL.\n• Haga clic en la ficha Seguridad de directorios. En la sección Comunicaciones seguras, observe que la opción Modificar está disponible. Haga clic en Modificar.\n• Seleccione Requerir canal seguro (SSL). Clic en aceptar.\n\nSi el servidor cuenta con Sistema Operativo Linux:\n\n• Instalar las siguientes aplicaciones:\nyum install mod_ssl openssl\n• Generar del certificado.Primero generar la clave privada, elegimos algoritmo RSA y 1024 bits:\nopenssl genrsa -out ca.key 1024\n• Despues generar el CSR (Certificate Signing Request).\nopenssl req -new -key ca.key -out ca.csr\n• Finalmente, autofirmamos el certificado:\nopenssl x509 -req -days 365 -in ca.csr -signkey ca.key -out ca.crt\n• El siguiente paso es mover los ficheros de la firma que acabamos de generar a la ruta correcta.\nmv ca.crt /etc/pki/tls/certs\nmv ca.key /etc/pki/tls/private/ca.key\nmv ca.csr /etc/pki/tls/private/ca.csr\n• Por último se realiza la configuración en Apache. Editar el siguiente archivo: /etc/httpd/conf.d/ssl.conf.\n• Buscar las siguientes líneas y asignar los nombres de los certificados creados.\nSSLCertificateFile /etc/pki/tls/certs/ca.crt\nSSLCertificateKeyFile /etc/pki/tls/private/ca.key",
                "risk" => "Obtención de las credenciales de acceso a diversos recursos de la institución que ponen en riesgo información sensible comprometiendo el correcto funcionamiento de los equipos y  la red en general.",
                "reference" => "https://support.microsoft.com/es-mx/kb/298805/es\nhttps://support.microsoft.com/es-mx/kb/324069/es\nhttp://www.symantec.com/connect/articles/apache-2-ssltls-step-step-part-1\nhttp://www.linuxhispano.net/2011/02/21/configurar-soporte-https-en-apache/\nhttps://blogdeaitor.wordpress.com/2011/10/05/configurar-https-par-apache2-en-linux/\nhttp://www.alcancelibre.org/staticpages/index.php/como-apache-ssl",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Http Client Body contains passwd= in cleartext",
                "description" => null,
                "recommendation" => "Validar en las políticas de uso institucionales el acceso a los sitios reportados. En caso de estar permitidos Fortalecer la seguridad en la contraseña:\n• La contraseña debe constar de al menos 12 caracteres.\n• Debe contener caracteres alfanuméricos.\n• Debe contener caracteres especiales.\n• Debe combinar mayúsculas y minúsculas\n\nHabilitar SSL ó TLS en el servidor web.\nSi el servidor cuenta con Sistema Operativo Windows:\n• Obtener un certificado SSL siguiendo los pasos mostrados en el enlace [1]\n• Desde la consola de Administración del equipo, haga clic con el botón secundario del mouse en el que desea utilizar SSL y haga clic en Propiedades.\n• Haga clic en la ficha Sitio Web. En la sección Identificación del sitio Web, compruebe que en el campo Puerto SSL aparece el valor numérico 443.\n• Haga clic en Avanzadas. Deben aparecer dos campos. La dirección IP y el puerto del sitio Web deben aparecer en el campo Identidades múltiples para este sitio Web. En el campo Múltiples identidades SSL para este sitio Web, haga clic en Agregar si el puerto 443 no aparece en la lista. Seleccione la dirección IP del servidor y escriba el valor numérico 443 en el campo Puerto SSL. Haga clic en Aceptar.\n• El puerto 443 aparecerá habilitado, por lo que ya se pueden utilizar conexiones SSL.\n• Haga clic en la ficha Seguridad de directorios. En la sección Comunicaciones seguras, observe que la opción Modificar está disponible. Haga clic en Modificar.\n• Seleccione Requerir canal seguro (SSL). Clic en aceptar.\n\nSi el servidor cuenta con Sistema Operativo Linux:\n\n• Instalar las siguientes aplicaciones:\nyum install mod_ssl openssl\n• Generar del certificado.Primero generar la clave privada, elegimos algoritmo RSA y 1024 bits:\nopenssl genrsa -out ca.key 1024\n• Despues generar el CSR (Certificate Signing Request).\nopenssl req -new -key ca.key -out ca.csr\n• Finalmente, autofirmamos el certificado:\nopenssl x509 -req -days 365 -in ca.csr -signkey ca.key -out ca.crt\n• El siguiente paso es mover los ficheros de la firma que acabamos de generar a la ruta correcta.\nmv ca.crt /etc/pki/tls/certs\nmv ca.key /etc/pki/tls/private/ca.key\nmv ca.csr /etc/pki/tls/private/ca.csr\n• Por último se realiza la configuración en Apache. Editar el siguiente archivo: /etc/httpd/conf.d/ssl.conf.\n• Buscar las siguientes líneas y asignar los nombres de los certificados creados.\nSSLCertificateFile /etc/pki/tls/certs/ca.crt\nSSLCertificateKeyFile /etc/pki/tls/private/ca.key",
                "risk" => "Obtención de las credenciales de acceso a diversos recursos de la institución que ponen en riesgo información sensible comprometiendo el correcto funcionamiento de los equipos y  la red en general.",
                "reference" => "\nhttps://support.microsoft.com/es-mx/kb/298805/es\nhttps://support.microsoft.com/es-mx/kb/324069/es\nhttp://www.symantec.com/connect/articles/apache-2-ssltls-step-step-part-1\nhttp://www.linuxhispano.net/2011/02/21/configurar-soporte-https-en-apache/\nhttps://blogdeaitor.wordpress.com/2011/10/05/configurar-https-par-apache2-en-linux/\nhttp://www.alcancelibre.org/staticpages/index.php/como-apache-ssl",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Http Client Body contains pw= in cleartext",
                "description" => null,
                "recommendation" => "Validar en las políticas de uso institucionales el acceso a los sitios reportados. En caso de estar permitidos Fortalecer la seguridad en la contraseña:\n• La contraseña debe constar de al menos 12 caracteres.\n• Debe contener caracteres alfanuméricos.\n• Debe contener caracteres especiales.\n• Debe combinar mayúsculas y minúsculas\n\nHabilitar SSL ó TLS en el servidor web.\nSi el servidor cuenta con Sistema Operativo Windows:\n• Obtener un certificado SSL siguiendo los pasos mostrados en el enlace [1]\n• Desde la consola de Administración del equipo, haga clic con el botón secundario del mouse en el que desea utilizar SSL y haga clic en Propiedades.\n• Haga clic en la ficha Sitio Web. En la sección Identificación del sitio Web, compruebe que en el campo Puerto SSL aparece el valor numérico 443.\n• Haga clic en Avanzadas. Deben aparecer dos campos. La dirección IP y el puerto del sitio Web deben aparecer en el campo Identidades múltiples para este sitio Web. En el campo Múltiples identidades SSL para este sitio Web, haga clic en Agregar si el puerto 443 no aparece en la lista. Seleccione la dirección IP del servidor y escriba el valor numérico 443 en el campo Puerto SSL. Haga clic en Aceptar.\n• El puerto 443 aparecerá habilitado, por lo que ya se pueden utilizar conexiones SSL.\n• Haga clic en la ficha Seguridad de directorios. En la sección Comunicaciones seguras, observe que la opción Modificar está disponible. Haga clic en Modificar.\n• Seleccione Requerir canal seguro (SSL). Clic en aceptar.\n\nSi el servidor cuenta con Sistema Operativo Linux:\n\n• Instalar las siguientes aplicaciones:\nyum install mod_ssl openssl\n• Generar del certificado.Primero generar la clave privada, elegimos algoritmo RSA y 1024 bits:\nopenssl genrsa -out ca.key 1024\n• Despues generar el CSR (Certificate Signing Request).\nopenssl req -new -key ca.key -out ca.csr\n• Finalmente, autofirmamos el certificado:\nopenssl x509 -req -days 365 -in ca.csr -signkey ca.key -out ca.crt\n• El siguiente paso es mover los ficheros de la firma que acabamos de generar a la ruta correcta.\nmv ca.crt /etc/pki/tls/certs\nmv ca.key /etc/pki/tls/private/ca.key\nmv ca.csr /etc/pki/tls/private/ca.csr\n• Por último se realiza la configuración en Apache. Editar el siguiente archivo: /etc/httpd/conf.d/ssl.conf.\n• Buscar las siguientes líneas y asignar los nombres de los certificados creados.\nSSLCertificateFile /etc/pki/tls/certs/ca.crt\nSSLCertificateKeyFile /etc/pki/tls/private/ca.key\n",
                "risk" => "Obtención de las credenciales de acceso a diversos recursos de la institución que ponen en riesgo información sensible comprometiendo el correcto funcionamiento de los equipos y  la red en general.",
                "reference" => "https://support.microsoft.com/es-mx/kb/298805/es\nhttps://support.microsoft.com/es-mx/kb/324069/es\nhttp://www.symantec.com/connect/articles/apache-2-ssltls-step-step-part-1\nhttp://www.linuxhispano.net/2011/02/21/configurar-soporte-https-en-apache/\nhttps://blogdeaitor.wordpress.com/2011/10/05/configurar-https-par-apache2-en-linux/\nhttp://www.alcancelibre.org/staticpages/index.php/como-apache-ssl",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Http Client Body contains pwd= in cleartext",
                "description" => null,
                "recommendation" => "Validar en las políticas de uso institucionales el acceso a los sitios reportados. En caso de estar permitidos Fortalecer la seguridad en la contraseña:\n• La contraseña debe constar de al menos 12 caracteres.\n• Debe contener caracteres alfanuméricos.\n• Debe contener caracteres especiales.\n• Debe combinar mayúsculas y minúsculas\n\nHabilitar SSL ó TLS en el servidor web.\nSi el servidor cuenta con Sistema Operativo Windows:\n• Obtener un certificado SSL siguiendo los pasos mostrados en el enlace [1]\n• Desde la consola de Administración del equipo, haga clic con el botón secundario del mouse en el que desea utilizar SSL y haga clic en Propiedades.\n• Haga clic en la ficha Sitio Web. En la sección Identificación del sitio Web, compruebe que en el campo Puerto SSL aparece el valor numérico 443.\n• Haga clic en Avanzadas. Deben aparecer dos campos. La dirección IP y el puerto del sitio Web deben aparecer en el campo Identidades múltiples para este sitio Web. En el campo Múltiples identidades SSL para este sitio Web, haga clic en Agregar si el puerto 443 no aparece en la lista. Seleccione la dirección IP del servidor y escriba el valor numérico 443 en el campo Puerto SSL. Haga clic en Aceptar.\n• El puerto 443 aparecerá habilitado, por lo que ya se pueden utilizar conexiones SSL.\n• Haga clic en la ficha Seguridad de directorios. En la sección Comunicaciones seguras, observe que la opción Modificar está disponible. Haga clic en Modificar.\n• Seleccione Requerir canal seguro (SSL). Clic en aceptar.\n\nSi el servidor cuenta con Sistema Operativo Linux:\n\n• Instalar las siguientes aplicaciones:\nyum install mod_ssl openssl\n• Generar del certificado.Primero generar la clave privada, elegimos algoritmo RSA y 1024 bits:\nopenssl genrsa -out ca.key 1024\n• Despues generar el CSR (Certificate Signing Request).\nopenssl req -new -key ca.key -out ca.csr\n• Finalmente, autofirmamos el certificado:\nopenssl x509 -req -days 365 -in ca.csr -signkey ca.key -out ca.crt\n• El siguiente paso es mover los ficheros de la firma que acabamos de generar a la ruta correcta.\nmv ca.crt /etc/pki/tls/certs\nmv ca.key /etc/pki/tls/private/ca.key\nmv ca.csr /etc/pki/tls/private/ca.csr\n• Por último se realiza la configuración en Apache. Editar el siguiente archivo: /etc/httpd/conf.d/ssl.conf.\n• Buscar las siguientes líneas y asignar los nombres de los certificados creados.\nSSLCertificateFile /etc/pki/tls/certs/ca.crt\nSSLCertificateKeyFile /etc/pki/tls/private/ca.key",
                "risk" => "Obtención de las credenciales de acceso a diversos recursos de la institución que ponen en riesgo información sensible comprometiendo el correcto funcionamiento de los equipos y  la red en general.",
                "reference" => "https://support.microsoft.com/es-mx/kb/298805/es\nhttps://support.microsoft.com/es-mx/kb/324069/es\nhttp://www.symantec.com/connect/articles/apache-2-ssltls-step-step-part-1\nhttp://www.linuxhispano.net/2011/02/21/configurar-soporte-https-en-apache/\nhttps://blogdeaitor.wordpress.com/2011/10/05/configurar-https-par-apache2-en-linux/\nhttp://www.alcancelibre.org/staticpages/index.php/como-apache-ssl",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "HTTP Connection To DDNS Domain Zapto.org",
                "description" => null,
                "recommendation" => "Bloquear el acceso al sitio mencionado en la descripción desde el equipo mediante el archivo hosts de Windows:\nIr al archivo \"hosts\" que se encuentra en la dirección C:\\windows\\System32\\drivers\\etc ----> añadir en el archivo hosts 127.0.0.1 sitio_a_bloquear\nEliminar los complementos de los navegadores web:\n• Abrir un navegador web.\n• Ir a opciones o configuraciones y buscar el apartado de complementos o extensiones.\n• Desinstalar los complementos no deseados.",
                "risk" => "Adquirir codigo malicioso e incluso acceso remoto al equipo sin autorización esto como parte de una botnet.",
                "reference" => "http://norfipc.com/articulos/como-bloquear-impedir-acceso-paginas-sitios-web-internet.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "HTTP Request to .su TLD (Soviet Union) Often Malware Related",
                "description" => null,
                "recommendation" => "Bloquear el acceso al sitio mencionado en la descripción desde el equipo mediante el archivo hosts de Windows:\nIr al archivo \"hosts\" que se encuentra en la dirección C:\\windows\\System32\\drivers\\etc ----> añadir en el archivo hosts 127.0.0.1 sitio_a_bloquear\n\nSi el equipo cuenta con un sistema operativo Linux se puede bloquear el dominios de la siguiente manera:\n• mediante el comando \"gedit\" editar el archivo \"hosts\", ejemplo gedit /etc/hosts --> añadir en el archivo hosts, la siguiente línea 127.0.0.1 sitio_a_bloquear ---> y guardar los cambios",
                "risk" => "Adquirir codigo malicioso e incluso acceso remoto al equipo sin autorización esto como parte de una botnet.",
                "reference" => "http://norfipc.com/articulos/como-bloquear-impedir-acceso-paginas-sitios-web-internet.html\nhttp://www.todoprogramas.com/trucos/linux/comobloquearunsitiowebnodeseadoenubuntulinux",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "HTTP Request to a Suspicious *.tk domain",
                "description" => null,
                "recommendation" => "Bloquear el acceso al sitio mencionado en la descripción desde el equipo mediante el archivo hosts de Windows:\nIr al archivo \"hosts\" que se encuentra en la dirección C:\\windows\\System32\\drivers\\etc ----> añadir en el archivo hosts 127.0.0.1 sitio_a_bloquear\n\nSi el equipo cuenta con un sistema operativo Linux se puede bloquear el dominios de la siguiente manera:\n• mediante el comando \"gedit\" editar el archivo \"hosts\", ejemplo gedit /etc/hosts --> añadir en el archivo hosts, la siguiente línea 127.0.0.1 sitio_a_bloquear ---> y guardar los cambios",
                "risk" => "Adquirir codigo malicioso e incluso acceso remoto al equipo sin autorización esto como parte de una botnet.",
                "reference" => "http://norfipc.com/articulos/como-bloquear-impedir-acceso-paginas-sitios-web-internet.html\nhttp://www.todoprogramas.com/trucos/linux/comobloquearunsitiowebnodeseadoenubuntulinux/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "ICQ Login",
                "description" => null,
                "recommendation" => "Validar si el acceso a clientes de mensajería instantánea está definido dentro de las políticas de uso aceptable para los equipos de cómputo de la institución.\n\nEn caso de no estar permitido el uso de este tipo de aplicaciones, desinstalar de los equipos relacionados con las direcciones IP internas.\n\nBloquear las conexiones hacia los Puertos 4000 y 5190, utilizados por ICQ.\nPara Sistemas Operativos Windows:\n• Ingresar en el Panel de control. \n• En el cuadro de búsqueda, escriba firewall y, a continuación, haga clic en Firewall de Windows.\n• Ingresar en Configuración avanzada.\n• Ingresar en Nueva regla y seguir las instrucciones para agregar una regla.",
                "risk" => "Provocar fuga de información, adquirir codigo malicioso y acceso al equipo a traves del ingreso de malware que pueda provocar dicha condicion.",
                "reference" => "http://www.iana.org/assignments/service-names-port-numbers/service-names-port-numbers.xhtml?search=4000\nhttp://www.electrictoolbox.com/article/networking/open-firewall-msn-icq/\nhttp://windows.microsoft.com/es-mx/windows/open-port-windows-firewall#1TC=windows-7",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "IE Toolbar User-Agent (IEToolbar)",
                "description" => null,
                "recommendation" => "Eliminar los siguientes archivos creados por IEToolbar:\n• about.html\n• error.html\n• logos.bmp\n• nav.bmp\n• options.html\n• toolbar.crc\n• toolbar.dll\n• toolbar.inf\n\nEliminar las siguientes entradas de registro creadas por IEToolbar:\n• HKEY_CLASSES_ROOT\\CLSID\\[BECD7FB6-D67E-4104-A8AD-0DBC10251438}\n• HKEY_CLASSES_ROOT\\CLSID\\[7CBBB3F1-0E68-43FA-B034-4D3EC394D085}\n• HKEY_CLASSES_ROOT\\TypeLib\\[B36CB30A-6ED9-4C63-9A8A-7DE9FA234608}\n• HKEY_CLASSES_ROOT\\Interface\\[CABBB49A-4D7B-415B-8250-15C3B854E9FF}\n• HKEY_CLASSES_ROOT\\Softomate.IEToolbar\n• HKEY_CLASSES_ROOT\\Softomate.IEToolbar.1\n• HKEY_CLASSES_ROOT\\ToolbarToolbar5\n• HKEY_CLASSES_ROOT\\ToolbarToolbar5.1\n• HKEY_CURRENT_USER\\software\\Toolbar5\n• HKEY_CURRENT_USER\\software\\Toolbar5\\IEToolbar\n• HKEY_CURRENT_USER\\software\\Toolbar5\\IEToolbar.1\n• HKEY_CURRENT_USER\\Software\\Microsoft\\Internet Explorer\\MenuExt\\&SearchIt Toolbar Search\n• HKEY_LOCAL_MACHINE\\Software\\Microsoft\\Internet Explorer\\Toolbar\\[BECD7FB6-D67E-4104-A8AD-0DBC10251438}\n• HKEY_CURRENT_USER\\SOFTWARE\\Microsoft\\Internet Explorer\\Toolbar\\WebBrowser\\[BECD7FB6-D67E-4104-A8AD-0DBC10251438}\n• HKEY_CURRENT_USER\\SOFTWARE\\Microsoft\\Internet Explorer\\URLSearchHooks\\[BECD7FB6-D67E-4104-A8AD-0DBC10251438}\n• HKEY_LOCAL_MACHINE\\SOFTWARE\\Microsoft\\Windows\\CurrentVersion\\Uninstall\\ToolbarToolbar5IEToolbar",
                "risk" => "modificar configuraion del equipo, recopilar informacion de navegacion web del usuario e incluso fuga de información.",
                "reference" => "http://www.symantec.com/security_response/writeup.jsp?docid=2004-091011-3527-99&tabid=2",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "IIS 8.3 Filename With Wildcard (Possible File/Dir Bruteforce)",
                "description" => null,
                "recommendation" => "Se recomienda actualizar a la última versión de IIS 8.5 liberada por el fabricante.",
                "risk" => "Los riesgos que conlleva, es la detección de archivos y directorios que contengan nombres cortos a los cuales se puede tener acceso si autenticación.",
                "reference" => "http://soroush.secproject.com/downloadable/microsoft_iis_tilde_character_vulnerability_feature.pdf\nhttp://doc.emergingthreats.net/bin/view/Main/2015023",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Inbound PHP User-Agent",
                "description" => "Se detectaron peticiones que contienen en la cabecera User-Agent la cadena de texto PHP, esto significa el uso de librerías PHP por parte del usuario.  PHP es un lenguaje que nos permite realizar diversas actividades de manera sencilla; sin embargo, puede llegar a ser utilizada con fines de carácter malicioso ingresando código que permita a una persona obtener acceso al equipo y modificar o extraer la información sin autorización.\n\n",
                "recommendation" => "Se recomienda verificar que la versión de php sea la última liberada por el fabricante.",
                "risk" => "El riego que conlleva a no tener una versión actualizada de software, para en este caso de php es la ejecución de código arbitrario por parte de un atacante.",
                "reference" => "http://php.about.com/od/learnphp/p/http_user_agent.htm\nhttp://php.net/manual/es/security.database.sql-injection.php\nhttp://www.useragentstring.com/pages/PHP/\nhttp://php.about.com/od/learnphp/p/http_user_agent.htm\nhttp://www.deependresearch.org/2013/12/hey-zollard-leave-my-internet-of-things.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Incoming Basic Auth Base64 HTTP Password detected unencrypted",
                "description" => "En las peticiones se detectaron intentos de acceso y la cabecera \"Authorization: Basic\", que es usada como método de autenticación para enviar usuarios y contraseñas cifrados mediante el algoritmo Base64, este es un algoritmo débil y fácil de descifrar.\nEsto supone un riesgo de seguridad debido a que una persona puede tener acceso al tráfico y obtener las credenciales de acceso pudiendo ser de interés para la institución. En caso de tratarse de un servidor propio de la institución, se está comprometiendo la seguridad de todas las credenciales de acceso con las que se cuente en el servidor ya que todas estarán cifradas en Base64 y podrían ser obtenidas por una persona no autorizada.",
                "recommendation" => "Se recomienda implementar un sistema de cifrado, al igual se recomienda reforzar la seguridad mediante el uso de contraseñas robustas, para dificultar el acceso a usuarios malintencionados, se recomienda que las contraseñas cumplan con las siguientes características:\nContener 12 caracteres.\nUtilizar caracteres especiales.\nMezclar números, letras y caracteres.\nUtilizar letras mayúsculas y minúsculas",
                "risk" => "Un usuario mal intencionado podría obtener las credenciales de acceso en texto claro a sistemas de la organización y obtener información sensible de esta.",
                "reference" => "https://www.alienvault.com/forums/discussion/877/snort-et-policy-incoming-basic-auth-base64-http-password-detected-unencrypted\nhttp://tools.ietf.org/html/rfc2617\nhttp://www.pcdigital.org/encriptar-y-desencriptar-texto-en-base64/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Incoming Masscan detected",
                "description" => "Se identificó una serie de conexiones las cuales contienen en la cabecera User-Agent la cadena de texto “Masscan”, una herramienta utilizada para el escaneo de redes.\nMasscan es utilizado para escanear redes y encontrar vulnerabilidades en los puertos abiertos y así poder acceder de forma no autorizada al equipo; de ser comprometido, puede ocasionar propagación de Malware, fuga de información, acceso al equipo sin autorización y diversos recursos en la red.",
                "recommendation" => "Se recomienda llevar a cabo un análisis de los sistemas de la organización, para valorar qué servicios son necesarios que se encuentren abiertos, en caso de que no sea necesarios es recomendable cerrarlos.",
                "risk" => "Los servicios expuestos pueden ser puertas abiertas para atacantes, por lo que el riesgo de comprometer un equipo es alto.",
                "reference" => "https://github.com/robertdavidgraham/masscan/blob/master/doc/masscan.8.markdown",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "INFO GENERIC SUSPICIOUS POST to Dotted Quad with Fake Browser 1",
                "description" => "Se detectaron peticiones las cuales son consideradas anormales debido a que contiene un User-Agent anormal. Esto puede deberse a la propagación o infección de malware en el equipo involucrado. Esto representa un riesgo ya que de contar con un malware podría propagarse por la red e infectar otros equipos afectando el rendimiento del equipo o permitiendo actividades no autorizadas por el usuario.\n",
                "recommendation" => "Se recomienda verificar el equipo, para conocer si éste tiene algún PUP (Programas Potencialmente no deseados) en caso de que en el equipo se encuentre instalado algún PUP es recomendable eliminarlos utilizando herramientas como: Antivirus o Antimalware.",
                "risk" => "Los servicios expuestos pueden ser puertas abiertas para atacantes, por lo que el riesgo de comprometer un equipo es alto.\nEl riesgo que conlleva los programas PUP es la recopilación de datos de usuarios, así mismo como datos de navegación. Otro riesgo es la posible infección de malware ya que hace peticiones sin el consentimiento del usuario hacia sitios apócrifos donde es común encontrar código malicio, el cual puede colarse al equipo.",
                "reference" => "http://tools.ietf.org/html/rfc1945\n\nhttp://www.cibernetia.com/headers_manual/\n\nhttp://malware-traffic-analysis.net/2014/04/05/index.html\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "IRC - Channel JOIN on non-std port",
                "description" => "Se detectó el uso de una aplicación de tipo chat de mensajería instantánea que usa el protocolo IRC (Internet Relay Chat). Donde en la petición se identificó la cadena \"Channel\", la cual se utiliza como comando, desde un cliente hacia el servidor, para indicar el canal del cual se hará uso para realizar el intercambio de mensajes._x000D_\n_x000D_\nLas aplicaciones cliente más comunes del protocolo IRC son:_x000D_\n_x000D_\n     -BitchX_x000D_\n     -homer_x000D_\n     -IRC Ferret _x000D_\n     -Ircle_x000D_\n     -MacIRC_x000D_\n     -mIRC_x000D_\n     -Microsoft Comic chat _x000D_\n     -Pirch_x000D_\n     -Virc_x000D_\n     -Xircon",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar si están permitidas este tipo de aplicaciones en las políticas de uso de equipo de cómputo y de uso de red.\n   o De estar permitidas, verificar si la actividad se encuentra dentro de las funciones del usuario.\n   o En caso de existir una política de restricción, identificar los equipos involucrados y  desinstalar cualquier aplicación no autorizada por la institución.\n• Analiza los equipos involucrados con un software antivirus actualizado para descartar la presencia de Malware debido a este tipo de aplicaciones. ",
                "risk" => " Las vulnerabilidades detectadas permiten ejecutar cualquier comando en la máquina de la víctima, facilitando a un potencial atacante acceso total al sistema del usuario.",
                "reference" => "http://www.vsantivirus.com/kibuv-b.htm  \n\nhttp://unaaldia.hispasec.com/2001/03/graves-problemas-de-seguridad-en.html\n\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "IRC - Nick change on non-std port",
                "description" => "Se detectó el uso de una aplicación de tipo chat de mensajería instantánea que usa el protocolo IRC (Internet Relay Chat). Donde en la petición se identificó la cadena \"PRIVMSG\", la cual se utiliza como comando, desde un cliente hacia el servidor, para realizar una descarga de archivo, específicamente aquellos con extensión .(exe|tar|tgz|zip) los cuales pueden ser usados para cambiar la configuración del sistema así como instalar aplicaciones no permitidas._x000D_\n_x000D_\nLas aplicaciones cliente más comunes del protocolo IRC son:_x000D_\n_x000D_\n     -BitchX_x000D_\n     -homer_x000D_\n     -IRC Ferret _x000D_\n     -Ircle_x000D_\n     -MacIRC_x000D_\n     -mIRC_x000D_\n     -Microsoft Comic chat _x000D_\n     -Pirch_x000D_\n     -Virc_x000D_\n     -Xircon",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar si están permitidas este tipo de aplicaciones en las políticas de uso de equipo de cómputo y de uso de red.\n   o De estar permitidas, verificar si la actividad se encuentra dentro de las funciones del usuario.\n   o En caso de existir una política de restricción, identificar los equipos involucrados y  desinstalar cualquier aplicación no autorizada por la institución.\n• Analiza los equipos involucrados con un software antivirus actualizado para descartar la presencia de Malware debido a este tipo de aplicaciones. ",
                "risk" => " Las vulnerabilidades detectadas permiten ejecutar cualquier comando en la máquina de la víctima, facilitando a un potencial atacante acceso total al sistema del usuario.",
                "reference" => "http://www.vsantivirus.com/kibuv-b.htm  \n\nhttp://unaaldia.hispasec.com/2001/03/graves-problemas-de-seguridad-en.html\n\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Microsoft Online Storage Client Hello TLSv1 Possible SkyDrive (2)",
                "description" => "Skydrive era un servicio de alojamiento de archivos en la nube, también permite cargar, crear, modificar y compartir documentos directamente sobre el navegador web. Actualmente es conocido como OneDrive.",
                "recommendation" => "Validar que el uso de la aplicación SkyDrive se encuentra permitida dentro de la institución, en caso de no estar permitida se sugiere desinstalar la aplicación del equipo.",
                "risk" => "El uso de programas no permitidos por la institución conlleva una violación a las políticas de uso de software de la institución, la fuga de información sensible.    ",
                "reference" => "http://www.cvedetails.com/cve/CVE-2014-5998/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "IRC - PRIVMSG *.(exe|tar|tgz|zip) download command",
                "description" => "Se detectó el uso de una aplicación de tipo chat de mensajería instantánea que usa el protocolo IRC (Internet Relay Chat). Donde en la petición se identificó la cadena \"PRIVMSG\", la cual se utiliza como comando, desde un cliente hacia el servidor, para realizar una descarga de archivo, específicamente aquellos con extensión .(exe|tar|tgz|zip) los cuales pueden ser usados para cambiar la configuración del sistema así como instalar aplicaciones no permitidas._x000D_\n_x000D_\nLas aplicaciones cliente más comunes del protocolo IRC son:_x000D_\n_x000D_\n     -BitchX_x000D_\n     -homer_x000D_\n     -IRC Ferret _x000D_\n     -Ircle_x000D_\n     -MacIRC_x000D_\n     -mIRC_x000D_\n     -Microsoft Comic chat _x000D_\n     -Pirch_x000D_\n     -Virc_x000D_\n     -Xircon",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar si están permitidas este tipo de aplicaciones en las políticas de uso de equipo de cómputo y de uso de red.\n   o De estar permitidas, verificar si la actividad se encuentra dentro de las funciones del usuario.\n   o En caso de existir una política de restricción, identificar los equipos involucrados y  desinstalar cualquier aplicación no autorizada por la institución.\n• Analiza los equipos involucrados con un software antivirus actualizado para descartar la presencia de Malware debido a este tipo de aplicaciones. ",
                "risk" => " Las vulnerabilidades detectadas permiten ejecutar cualquier comando en la máquina de la víctima, facilitando a un potencial atacante acceso total al sistema del usuario.",
                "reference" => "http://www.vsantivirus.com/kibuv-b.htm  \n\nhttp://unaaldia.hispasec.com/2001/03/graves-problemas-de-seguridad-en.html\n\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Outgoing Basic Auth Base64 HTTP Password detected unencrypted",
                "description" => null,
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n\nUna manera efectiva de prevenir este tipo de problemas es usar TLS para proteger los contenidos enviados en las peticiones y respuestas en HTTP.\n\nMantener actualizado el navegador de su preferencia.",
                "risk" => "Robo de identidad y uso no autorizado de credenciales.\nPérdida o fuga de información.",
                "reference" => "http://www.sans.org/reading-room/whitepapers/auditing/base64-pwned-33759\nhttps://www.alienvault.com/forums/discussion/877/snort-et-policy-incoming-basic-auth-base64-http-password-detected-unencrypted",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "IRC PING command",
                "description" => "Se detectó el uso de una aplicación de tipo chat de mensajería instantánea que usa el protocolo IRC (Internet Relay Chat). Donde en la petición se identificó la cadena \"Ping\", la cual se utiliza como comando, desde un cliente hacia el servidor, para notificar a un usuario que se le ha mencionado, también funciona para hacer pruebas de latencia con un usuario en específico, con el fin de saber las conexiones que tiene activas._x000D_\n_x000D_\nLas aplicaciones cliente más comunes del protocolo IRC son:_x000D_\n_x000D_\n     -BitchX_x000D_\n     -homer_x000D_\n     -IRC Ferret _x000D_\n     -Ircle_x000D_\n     -MacIRC_x000D_\n     -mIRC_x000D_\n     -Microsoft Comic chat _x000D_\n     -Pirch_x000D_\n     -Virc_x000D_\n     -Xircon",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar si están permitidas este tipo de aplicaciones en las políticas de uso de equipo de cómputo y de uso de red.\n   o De estar permitidas, verificar si la actividad se encuentra dentro de las funciones del usuario.\n   o En caso de existir una política de restricción, identificar los equipos involucrados y  desinstalar cualquier aplicación no autorizada por la institución.\n• Analiza los equipos involucrados con un software antivirus actualizado para descartar la presencia de Malware debido a este tipo de aplicaciones. ",
                "risk" => " Las vulnerabilidades detectadas permiten ejecutar cualquier comando en la máquina de la víctima, facilitando a un potencial atacante acceso total al sistema del usuario.",
                "reference" => "http://www.vsantivirus.com/kibuv-b.htm  \n\nhttp://unaaldia.hispasec.com/2001/03/graves-problemas-de-seguridad-en.html\n\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "IRC PONG response",
                "description" => "El protocolo IRC es un protocolo de comunicación en tiempo real basado en texto, siendo el cliente más simple un programa capaz de conectarse a un servidor a través de un socket. Se ha desarrollado en sistemas que usan el protocolo de red TCP/IP, aunque no es imperativo que esta sea la única forma en que funcione._x000D_\nCualquier cliente que reciba un PING debe responder al servidor que envía el mensaje tan pronto como le sea posible con el mensaje PONG apropiado para indicar que está activo._x000D_",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar si están permitidas este tipo de aplicaciones en las políticas de uso de equipo de cómputo y de uso de red.\n   o De estar permitidas, verificar si la actividad se encuentra dentro de las funciones del usuario.\n   o En caso de existir una política de restricción, identificar los equipos involucrados y  desinstalar cualquier aplicación no autorizada por la institución.\n• Analiza los equipos involucrados con un software antivirus actualizado para descartar la presencia de Malware debido a este tipo de aplicaciones. ",
                "risk" => " Las vulnerabilidades detectadas permiten ejecutar cualquier comando en la máquina de la víctima, facilitando a un potencial atacante acceso total al sistema del usuario.",
                "reference" => "http://www.vsantivirus.com/kibuv-b.htm  \n\nhttp://unaaldia.hispasec.com/2001/03/graves-problemas-de-seguridad-en.html\n\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "iWare Professional SQL Injection Attempt",
                "description" => "iWare es un sistema de gestión de contenido, diseñado para crear páginas web, la cual contiene varias vulnerabilidades que pueden ser explotadas principalmente en ataques de tipo SQL injection._x000D_\n_x000D_\nEste ataque consiste en inyectar código SQL ajeno en una consulta ya programada, con el fin de alterar el funcionamiento de la base de datos. Estas alteraciones podrían producir fuga, modificación o pérdida de la información en la base de datos._x000D_",
                "recommendation" => "-Se recomienda hacer una santización del parámetro D en el archivo índex.php\n-Actualizar la versión de iWare a la más actual a fin de evitar esta y otras vulnerabilidades asociados a la versión iWare 5.4",
                "risk" => "Esto puede llevar a que una persona o entidad maliciosa aproveche esta vulnerabilidad para explotarla y producir fuga de información la cual representaría un riesgo para la organización.   ",
                "reference" => "https://www.juniper.net/security/auto/vulnerabilities/vuln21467.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "iWare Professional SQL Injection Attempt -- index.php D SELECT",
                "description" => "iWare es un sistema de gestión de contenido, diseñado para crear páginas web._x000D_\n_x000D_\nUna vulnerabilidad fue encontrada en iWare Professional, la cual afecta a una función del archivo “index.php” a través de la manipulación del parámetro “D” de una entrada que no ha sido correctamente validada, se puede explotar dicha vulnerabilidad mediante un ataque de SQL injection._x000D_\n_x000D_\nEste ataque consiste en inyectar código SQL ajeno en una consulta ya programada, con el fin de alterar el funcionamiento de la base de datos. Estas alteraciones podrían producir fuga, modificación o borrado de la información en la base de datos._x000D_",
                "recommendation" => "-Se recomienda hacer una santización del parámetro D en el archivo índex.php\n-Actualizar la versión de iWare a la más actual a fin de evitar esta y otras vulnerabilidades asociados a la versión iWare 5.4",
                "risk" => "Esto puede llevar a que una persona o entidad maliciosa aproveche esta vulnerabilidad para explotarla y producir fuga de información la cual representaría un riesgo para la organización.   ",
                "reference" => "https://www.juniper.net/security/auto/vulnerabilities/vuln21467.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Jabber/Google Talk Logon Succes",
                "description" => "Se refiere a un inicio de sesión exitoso, a pesar de que la firma dice que hace referencia a la aplicación de Google Talk, en realidad es un inicio de sesión exitoso a una aplicación por medio del protocolo XMPP, presumiblemente Hangouts.\nXMPP (Extensible Messaging and Presence Protocol) es un protocolo basado en XML, originalmente ideado para mensajería instantánea, requiere del puerto 5222 para realizar la comunicación, así como de cifrado TLS y autenticación SASL PLAIN._x000D_\nGoogle Talk era un cliente de mensajería instantánea y VoIP que utilizaba el protocolo Jabber/XMPP desarrollado por Google Inc. En 2013 fue sustituido por “Hangouts” también desarrollado por Google Inc._x000D_",
                "recommendation" => "Validar si el acceso a redes sociales está definido dentro de las políticas de uso aceptable para los equipos de cómputo de la institución.\n\nBloquear las conexiones hacia el Puerto 5222, utilizado por el protocolo XMPP\nPara Sistemas Operativos Windows:\n• Ingresar en el Panel de control. \n• En el cuadro de búsqueda, escriba firewall y, a continuación, haga clic en Firewall de Windows.\n• Ingresar en Configuración avanzada.\n• Ingresar en Nueva regla y seguir las instrucciones para agregar una regla.",
                "risk" => "El uso de programas de mensajería instantánea podría llevar a la fuga de información sensible.",
                "reference" => "http://xmpp.org/rfcs/rfc3920.html\nhttp://www.speedguide.net/port.php?port=5222",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Known Compromised or Hostile Host Traffic TCP group 4",
                "description" => "Se detectó tráfico inusual por parte de las direcciones IP públicas reportadas hacia las direcciones IP locales, a través del puerto 80. \nEste evento se considera como tráfico anormal principalmente porque las conexiones son dirigidas hacia direcciones IP internas en un lapso de tiempo muy corto, por lo que podría corresponder con actividad maliciosa por parte de dichas IP públicas.",
                "recommendation" => "Se recomienda verificar que las reglas de filtrado de contenido este correctamente aplicadas, ya que este indicador de compromiso indica que un equipo está intentando acceder o usar una aplicación no permitida por la organización.",
                "risk" => "El riesgo que conlleva el uso de programas o visitas a sitios no permitidos por la organización es la infección por malware y la propagación de éste a los sistemas de la organización.",
                "reference" => "https://forum.netfort.com/netfort/topics/ids-ruleset-thu-sep-18-16-59-46-ist-2014",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Jabber/Google Talk Outgoing Traffic",
                "description" => "Validar si el acceso a redes sociales está definido dentro de las políticas de uso aceptable para los equipos de cómputo de la institución._x000D_\n_x000D_\nBloquear las conexiones hacia el Puerto 5222, utilizado por el protocolo XMPP_x000D_\nPara Sistemas Operativos Windows:_x000D_\n• Ingresar en el Panel de control.\n• En el cuadro de búsqueda, escriba firewall y, a continuación, haga clic en Firewall de Windows._x000D_\n• Ingresar en Configuración avanzada._x000D_\n• Ingresar en Nueva regla y seguir las instrucciones para agregar una regla._x000D_",
                "recommendation" => "Validar si el acceso a redes sociales está definido dentro de las políticas de uso aceptable para los equipos de cómputo de la institución.\n\nBloquear las conexiones hacia el Puerto 5222, utilizado por el protocolo XMPP\nPara Sistemas Operativos Windows:\n• Ingresar en el Panel de control. \n• En el cuadro de búsqueda, escriba firewall y, a continuación, haga clic en Firewall de Windows.\n• Ingresar en Configuración avanzada.\n• Ingresar en Nueva regla y seguir las instrucciones para agregar una regla.\n",
                "risk" => "El uso de programas de mensajería instantánea podría llevar a la fuga de información sensible.",
                "reference" => "\nhttp://xmpp.org/rfcs/rfc3920.html\nhttp://www.speedguide.net/port.php?port=5222",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Java Archive Download By Vulnerable Client",
                "description" => "Se recomienda verificar que el equipo cuente con la última versión de java client liberada por parte del fabricante. Esto con la finalidad de eliminar huecos de seguridad que conlleva al tener versiones desactualizadas de este software.",
                "recommendation" => "Se recomienda verificar que el equipo cuenta con la última versión de java client liberada por parte del fabricante. Esto con la finalidad de eliminar huecos de seguridad que conlleva al tener versiones desactualizadas de este software.",
                "risk" => "El uso de software desactualizado conlleva a huecos de seguridad en/los sistemas informáticos para una organización, estos huecos pueden ser aprovechados por usuarios malintencionados logrando comprometer los equipos y el contenido de estos.",
                "reference" => "http://www.malware-traffic-analysis.net/2013/08/10/index.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Java Url Lib User Agent Web Crawl",
                "description" => "Se recomienda verificar que la versión de java y sus complementos sean las últimas liberadas por el fabricante.",
                "recommendation" => "Se recomienda verificar que la versión de java y sus complementos sean las últimas liberadas por el fabricante.",
                "risk" => "El riego que conlleva a no tener una versión actualizada de software, para en este caso de java es la ejecución de código arbitrario a por parte de un atacante.",
                "reference" => "https://code.google.com/p/crawler4j/\nhttps://en.wikipedia.org/wiki/Web_crawler",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Javadoc API Redirect CVE-2013-1571",
                "description" => "Se recomienda instalar el último parche liberado por Oracle para la versión de Java SE desde el sitio web:\nhttp://www.oracle.com/technetwork/topics/security/javacpujun2013-1899847.html",
                "recommendation" => "-Se recomienda instalar el último parche liberado por Oracle para la versión e Java SE desde el sitio Web: http://www.oracle.com/technetwork/topics/security/javacpujun2013-1899847.html",
                "risk" => "Los riesgos que conlleva a tener la versión de javadoc 7.0, un atacante podría inyectar código arbitrario y modificar páginas html, dando una mala imagen a la organización.",
                "reference" => "http://www.oracle.com/technetwork/topics/security/javacpujun2013-1899847.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "JCE Joomla Extension",
                "description" => "La actividad generada muestra intentos de explotar la vulnerabilidad del módulo JCE de la plataforma Joomla, que permite a un atacante subir archivos arbitrariamente de forma remota. \nUn atacante podría aprovechar la vulnerabilidad para cargar un script PHP malicioso, permitiendo al atacante ejecutar el código de forma remota en el sistema vulnerado. \nLa vulnerabilidad se encuentra en las versiones de JCE Joomla 1.5.71, 1.5.26 y 2.0.10.",
                "recommendation" => "Se recomienda verificar la versión del componente JCE para Joomla Extension, si la versión de JCE es inferior a la 2.3.2.1 se recomienda actualizar a la dicha versión o una superior liberada por parte del fabricante, esta acción mitigara los huecos de seguridad que versiones anteriores a la 2.3.2.1.",
                "risk" => "Los riesgos que conlleva tener una versión inferior de JCE a la 2.3.2.1, es la ejecución de código arbitrario por parte de un atacante.",
                "reference" => "https://www.exploit-db.com/exploits/17734/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "P2P BitTorrent announce request",
                "description" => null,
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n\nDesinstalar el software de la aplicación en los equipos de la red local.\n\nRealizar un análisis de los equipos con un software antivirus totalmente actualizado, en busca de malware.\n\nHabilitar o instalar un Firewall para la detección de tráfico inusual dentro de la red.\n\nBloquear el tráfico asociado a programas de intercambio de archivos P2P no aprobados en el perímetro de la red.",
                "risk" => "Instalación de código malicioso.\nFuga de información sensible.\nSusceptibilidad a ataques debido a la apertura de puertos que este tipo de software requiere.\nUna condición de denegación de servicios.\nConsumo de ancho de banda.",
                "reference" => "https://www.us-cert.gov/ncas/tips/ST05-007",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Joomla Component SQLi Attempt",
                "description" => "La actividad generada muestra intentos de explorar la vulnerabilidad en el módulo “com_artforms” para la plataforma Joomla, esta vulnerabilidad se aprovecha del parámetro “viewform” al realizar una consulta SQL y no se valida adecuadamente dicho parámetro, esto puede ser aprovechado por un atacante para manipular una consulta con el fin de alterar el funcionamiento de la base de datos.\nEsta alteración podría producir modificación y fuga de información en la base de datos.",
                "recommendation" => "Se recomienda verificar la versión del componente JCE para Joomla Extension, si la versión de JCE es inferior a la 2.3.2.1 se recomienda actualizar a la dicha versión o una superior liberada por parte del fabricante, esta acción mitigara los huecos de seguridad que versiones anteriores a la 2.3.2.1",
                "risk" => "Los riesgos que conlleva tener una versión inferior de JCE a la 2.3.2.1, es la ejecución de código arbitrario por parte de un atacante.",
                "reference" => "https://www.packtpub.com/books/content/preventing-sql-injection-attacks-your-joomla-websites",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Kaaza Media desktop p2pnetworking.exe Activity",
                "description" => "La actividad generada muestra la presencia del malware Kaaza Media el cual utiliza la tecnología P2P FastTack para su propagación.\nKaaza Media crea un icono en el escritorio llamado “Media Desktop” o “p2pnetworking”, que al ser ejecutado por el usuario modifica la configuración de los navegadores web generando publicidad, recopila información, así como hábitos de navegación del usuario. \nEl uso de aplicaciones que utilizan las redes P2P pone en riesgo la seguridad en los equipos de cómputo, ya que puede provocar fuga de información sensible, iniciar una Denegación de Servicios(DoS); además son foco de infección de malware.",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar las políticas de uso de la red y uso del equipo de cómputo.\n• Validar si el uso de software como aplicaciones P2P están dentro de las aplicaciones permitidas por la institución.\n   o En caso de no contar con dichas políticas, implementarlas.\n   o Si el uso de este tipo de aplicaciones no esté permitido, se sugiere localizar los equipos relacionados y desinstalar cualquier aplicación no autorizada por la institución.\n• Analizar el equipo reportado con un software antivirus actualizado para descartar la presencia de Malware.\n• Bloquear desde el Firewall el uso de puerto de Kazaa 1214.",
                "risk" => "El uso de este tipo de programas conlleva riesgos como la Infección por código malicioso y la propagación de este a nivel local",
                "reference" => "https://forums.avg.com/es-es/avg-forums?sec=thread&act=show&id=5139",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Known Tor Exit Node TCP Traffic group 87",
                "description" => "Esta firma se presenta debido a la comunicación establecida con direcciones IP identificadas como nodos de salida de TOR.\n\n",
                "recommendation" => "Se recomienda verificar que las reglas de filtrado de contenido este correctamente aplicadas, ya que este indicador de compromiso indica que un equipo está intentando acceder o usar una aplicación no permitida por la organización.",
                "risk" => "El riesgo que conlleva el uso de programas o visitas a sitios no permitidos por la organización es la infección por malware y la propagación de éste a los sistemas de la organización.",
                "reference" => "https://www.defcon.org/images/defcon-22/dc-22-presentations/Larsen-Vedaa/DEFCON-22-Mike-Larsen-Charlie-Vedaa-Impostor-Polluting-Tor-Metadata.pdf\nhttps://www.alienvault.com/forums/discussion/1799/snort-et-tor-known-tor-exit-node-udp-traffic-30",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Known Tor Relay/Router (Not Exit) Node TCP Traffic group 87",
                "description" => "Esta firma se presenta debido a la comunicación establecida con direcciones IP identificadas como nodos de TOR.\n\n\n",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar si el equipo relacionado con la dirección IP reportada tiene instalado algún programa para el uso de la red TOR.\n   o En caso de encontrarse algún programa de este tipo se recomienda desinstalarlo inmediatamente.\n• Verificar las configuraciones de red del equipo, en busca de algún cambio en los parámetros de Proxy definidos por la institución.\n• Bloquear el dominio reportado:\n   o En el archivo “hosts” del equipo reportado.\n   o En caso de contar con un servidor de filtrado de contenido web, bloquearlo.\n• Analizar el equipo relacionado con el evento con un software antivirus actualizado para descartar la presencia de Malware que realice las peticiones.",
                "risk" => "El riesgo que conlleva el uso de programas o visitas a sitios no permitidos por la organización es la infección por malware y la propagación de éste a los sistemas de la organización.",
                "reference" => "https://www.defcon.org/images/defcon-22/dc-22-presentations/Larsen-Vedaa/DEFCON-22-Mike-Larsen-Charlie-Vedaa-Impostor-Polluting-Tor-Metadata.pdf\nhttps://www.alienvault.com/forums/discussion/1799/snort-et-tor-known-tor-exit-node-udp-traffic-30",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Large DNS Query possible covert channel",
                "description" => "Este indicador se activa debido a que se presentan peticiones inusuales de Dominio (DNS), las cuales son peticiones extendidas o de longitud inusual, esto nos dice que es probable que exista comunicación encubierta por un túnel utilizando el servicio de Dominio, este tipo de comunicación permite transferir cualquier tipo de datos bajo este servicio.\n",
                "recommendation" => "Se recomienda verificar que el equipo cuente con software antivirus, antimalware, antispam, ya que el comportamiento y las consultas a dominios “.info” es un comportamiento muy poco común.",
                "risk" => "El riesgo que conlleva este comportamiento es el muy alto riego que el equipo contenga código malicioso y con ello se pueda dar fuga de información.",
                "reference" => "https://www.solutionary.com/resource-center/blog/2013/09/identifying-covert-channels-in-dns/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "LibSSH Based Frequent SSH Connections Likely BruteForce Attack!",
                "description" => "Este indicador se presenta debido a la existencia de peticiones frecuentes de autenticación como cliente sobre el servicio de Secure Shell (SSH), lo cual podría suponer un ataque de fuerza bruta.\n\n",
                "recommendation" => "Se recomienda revisar si el puerto 22 usado por el protocolo SSH es indispensable estar habilitado en el equipo, en caso de ser necesario se recomienda usar la versión 2 del protocolo SSH el cual maneja un algoritmo de cifrado más seguro.\nSe recomienda implementar un sistema de cifrado, al igual se recomienda reforzar la seguridad mediante el uso de contraseñas robustas, para dificultar el acceso a usuarios malintencionados, se recomienda que las contraseñas cumplan con las siguientes características:\n* Contener 12 caracteres.\n* Utilizar caracteres especiales.\n* Mezclar números, letras y caracteres.\n* Utilizar letras mayúsculas y minúsculas.",
                "risk" => "El uso de protocolos de conexión remota representa un hueco de seguridad si éste no se encuentra configurado de manera correcta. Es por ello que un atacante podría utilizar esta vía para poder tomar el control de un sistema y posteriormente utilizarlo como puente para atacar a la infraestructura de la organización.",
                "reference" => "http://www.securityweek.com/ddos-malware-linux-distributed-ssh-brute-force-attacks",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "LibSSH Based SSH Connection - Often used as a BruteForce Tool",
                "description" => "SSH es una herramienta que sirve para acceder de forma remota a un equipo a través de una red, dicho programa trabaja por el puerto 22 permitiendo manejar el equipo mediante consola, esta herramienta hace uso de librerías, en este caso libssh la cual es una biblioteca que la implementa el protocolo SSH, dichas librerías al igual que la herramienta SSH están expuestas a ataques haciendo que el servicio sea vulnerable a escaneos. _x000D_\n_x000D_\nUno de los principales objetivos de escaneos es identificar la versión que se encuentre instalada, esto es buscar algún exploit y con ello poder conseguir el acceso no autorizado al servicio, haciendo que el equipo al que se esté atacando sea vulnerable y el atacante tenga acceso total del equipo.\n_x000D_\n\n",
                "recommendation" => "Se recomienda revisar si el puerto 22 usado por el protocolo SSH es indispensable estar habilitado en el equipo, en caso de ser necesario se recomienda usar la versión 2 del protocolo SSH el cual maneja un algoritmo de cifrado más seguro.\nSe recomienda implementar un sistema de cifrado, al igual se recomienda reforzar la seguridad mediante el uso de contraseñas robustas, para dificultar el acceso a usuarios malintencionados, se recomienda que las contraseñas cumplan con las siguientes características:\n* Contener 12 caracteres.\n* Utilizar caracteres especiales.\n* Mezclar números, letras y caracteres.\n* Utilizar letras mayúsculas y minúsculas.",
                "risk" => "El uso de protocolos de conexión remota representa un hueco de seguridad si éste no se encuentra configurado de manera correcta. Es por ello que un atacante podría utilizar esta vía para poder tomar el control de un sistema y posteriormente utilizarlo como puente para atacar a la infraestructura de la organización.",
                "reference" => "https://www.libssh.org/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "LibSSH2 Based SSH Connection - Often used as a BruteForce Tool",
                "description" => "LibSSH2 es una biblioteca que la implementa el protocolo SSH2 herramienta que sirve para acceder de forma remota a un equipo a través de una red, el cual trabaja por el puerto 22 permitiendo manejar el equipo mediante consola. A pesar de que Libssh2 es una versión más segura termina estando expuesta a ataques en este caso sean escaneos desde otros equipos._x000D_\nUno de los principales objetivos de escaneos es identificar la versión que se encuentre instalada, esto es buscar algun exploit y con ello poder conseguir el acceso no autorizado al servicio, haciendo que el equipo al que se este atacando sea vulnerable y el atacante tenga acceso total del equipo. _x000D_\n\n",
                "recommendation" => "Se recomienda revisar si el puerto 22 usado por el protocolo SSH es indispensable estar habilitado en el equipo, en caso de ser necesario se recomienda implementar un sistema de cifrado, al igual se recomienda reforzar la seguridad mediante el uso de contraseñas robustas, para dificultar el acceso a usuarios malintencionados, se recomienda que las contraseñas cumplan con las siguientes características:\n* Contener 12 caracteres.\n* Utilizar caracteres especiales.\n* Mezclar números, letras y caracteres.\n* Utilizar letras mayúsculas y minúsculas.",
                "risk" => "El uso de protocolos de conexión remota representa un hueco de seguridad si éste no se encuentra configurado de manera correcta. Es por ello que un atacante podría utilizar esta vía para poder tomar el control de un sistema y posteriormente utilizarlo como puente para atacar a la infraestructura de la organización.",
                "reference" => "http://www.libssh2.org/\n\nhttps://kb.iu.edu/d/aelc\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "P2P Ares over UDP",
                "description" => null,
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n\nDesinstalar el software de la aplicación en los equipos de la red local.\n\nRealizar un análisis de los equipos con un software antivirus totalmente actualizado, en busca de malware.\n\nHabilitar o instalar un Firewall para la detección de tráfico inusual dentro de la red.\n\nBloquear el tráfico asociado a programas de intercambio de archivos P2P no aprobados en el perímetro de la red.",
                "risk" => "Instalación de código malicioso.\nFuga de información sensible.\nSusceptibilidad a ataques debido a la apertura de puertos que este tipo de software requiere.\nUna condición de denegación de servicios.\nConsumo de ancho de banda.",
                "reference" => "https://www.us-cert.gov/ncas/tips/ST05-007",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "libww-perl User-Agent",
                "description" => "libww es una biblioteca de cliente\\servidor de perl, usado como banco de pruebas para experimento de protocolos. Este tipo de API es muy común por los hacker, spammer o algún bot para poder realizar ataques a sitios web. _x000D_\n_x000D_\nRegularmente este tipo de ataques lo que hacen es atacar servidores mediante la instalación de alguna puerta trasera, el cual también puede hacer  solicitudes a sitios, los cuales pueden incluir código PHP ya alterado previamente haciendo al sitio vulnerable cambiando el curso de la ejecución._x000D_\n",
                "recommendation" => "Implementar una aplicación WAF (Web Application Firewall) con la que se pueden identificar y bloquear ataques a servidores web. \nBloquerar el agente \"libww-perl\" en el servidor apache añadiendo la siguiente línea al archivo .htaccess \nSetEnvIfNoCase User-Agent \"^ libwww-perl *\" block_bad_bots\nDeny from env = block_bad_bots",
                "risk" => "Esto puede llevar a que una persona o entidad maliciosa aproveche esta vulnerabilidad para explotarla y producir fuga de información la cual representaría un riesgo para la organización.  ",
                "reference" => "http://www.w3.org/Library/\nhttp://www.cyberciti.biz/tips/the-rise-of-bots-spammers-crack-attacks-and-libwww-perl.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Likely Malicious Request for /proc/self/environ",
                "description" => "Se detectó una serie de peticiones realizadas por la dirección IP pública, dichas peticiones realizan ataques LFI (Local File Inclusion), este tipo de ataques consiste en la llamada y/o lectura de archivos ya sean de la página o propios del Sistema Operativo, en este caso los ataques se realizaron contra la página con dirección IP denominada destino. _x000D_\n_x000D_\nEn estas peticiones los atacantes intentan llamar a \"proc/self/environ\", el cual es un archivo donde se almacenan las variables de entorno de Apache, si la explotación del ataque es exitosa podría dar lugar a la ejecución de código arbitrario del lado del servidor y del lado del cliente mediante javascript que podrían resultar en ataques de tipo Cross Site Scripting (XSS), Denegación de Servicio (DoS) o revelación de información sensible.\n",
                "recommendation" => "Implementar una aplicación WAF (Web Application Firewall) con la que se pueden identificar y bloquear ataques a servidores web. \nAñadir la siguiente línea al archivo .htaccess \nRewriteCond %[QUERY_STRING} proc\\/self\\/environ [OR]\nSi la aplicación utilizada como servidor se trata de Apache, se puede implementar un control de acceso utilizando el módulo mod_authz_host con la siguiente regla: Deny from ",
                "risk" => "Esto puede llevar a que una persona o entidad maliciosa aproveche esta vulnerabilidad para explotarla y producir fuga de información la cual representaría un riesgo para la organización, además de realizar ataques de denegación de servicio.",
                "reference" => "http://www.securityartwork.es/2010/12/22/recopilacion-local-file-inclusion-lfi/\n\nhttp://websecuritylog.blogspot.mx/2010/06/procselfenviron-injection.html\n\nhttp://httpd.apache.org/docs/2.0/es/env.html\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "MALWARE Adware.iBryte.B Install",
                "description" => "Se detectó actividad correspondiente al malware Adware.iBryte, el cual es de tipo adware que se instala en el navegador web con la finalidad de mostrar publicidad sin el consentimiento del usuario, bloquear la página de inicio de los navegadores con el objetivo de forzar ciertos buscadores que pueden ser peligrosos para el usuario.\n_x000D_El adware además de estar diseñado para la entrega de publicidad no solicitada, también intenta recopilar y enviar información sobre el equipo infectado a alguna máquina remota, tal como: el sistema operativo, la configuración del sistema, la versión de Microsoft y .NET Framework. Poniendo en riesgo la confidencialidad, la integridad y la disponibilidad del equipo\n_x000D_\n\n",
                "recommendation" => "Realizar un análisis del equipo involucrado con un software antivirus para descartar la existencia de algún tipo de malware en el equipo.                                                                                                                                                                     Eliminar los siguientes archivos:\n%AllUsersProfile%\\[random.exe\\\n%AllUsersProfile%\\Application Data\\\n%AllUsersProfile%\\random.exe\n%AppData%\\Roaming\\Microsoft\\Windows\\Templates\\random.exe\n%Temp%\\random.exe\n%AllUsersProfile%\\Application Data\\random\nAdemás de eliminar las siguientes entradas de  registro:\nHKEY_LOCAL_MACHINE\\SOFTWARE\\Microsoft\\Windows\\Current\\Version\\Run\\random.exe\"\nHKEY_CURRENT_USER\\AppEvents\\Schemes\\Apps\\Explorer\\Navigating\nHKCU\\Software\\Microsoft\\Windows\\CurrentVersion\\Internet\\Settings\\random\nHKCU\\SOFTWARE\\Microsoft\\Windows\\CurrentVersion\\Run \\Regedit32\nHKEY_CURRENT_USER\\Software\\Microsoft\\Windows\\CurrentVersion\\Internet Settings “CertificateRevocation” = 0\nHKEY_CURRENT_USER\\Software\\Microsoft\\Windows\\CurrentVersion\\Policies\\System “DisableTaskMgr” = 1\nHKEY_LOCAL_MACHINE\\SOFTWARE\\Microsoft\\Windows\\CurrentVersion\\run\\random                                                                                                                                                                                                                                                                                                                                                                                                   Se sugiere bloquear el acceso al dominio involucrado en el envento en el servidor de filtrado de contenido.",
                "risk" => "El riesgo que conlleva a la organización es la propagación del código malicioso  en el equipo y  la propagación de este a nivel local, afectación del rendimiento del o los equipos,  perdida o  fuga de  información.",
                "reference" => "http://www.virusradar.com/en/Win32_AdWare.iBryte.R/description\n\nhttp://www.avira.com/en/support-threats-summary/tid/8523/tlang/en\n\nhttp://www.forospyware.com/t247643.html\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "MALWARE Adware-Win32/EoRezo Reporting",
                "description" => "Se identificó actividad correspondiente al adware EoRezo, el cual tiene la principal función de mostrar publicidad sin el consentimiento del usuario. El adware se comunica constantemente al dominio \"ads.alpha00001.com\", a través del directorio \"/cgi-bin/advert/\", que es el posible controlador del adware._x000D_\n_x000D_\nEoRezo está catalogado como un programa potencialmente no deseado (PUP por sus siglas en inglés) ya que modifica la configuración de los navegadores web, recopila información, así como hábitos de navegación del usuario, etc. También se encarga de bloquear la página de inicio de los navegadores con el objetivo de forzar ciertos buscadores que pueden ser peligrosos para el usuario y pone en riesgo la integridad del equipo.\n\n",
                "recommendation" => "Realizar un análisis del equipo involucrado con un software antivirus para descartar la existencia de algún tipo de malware en el equipo.                                                                                                                                                                     Eliminar del equipo las siguientes entradas de registros:                                                                                                                                                                                                                                                                                                                                      HKLM\\SOFTWARE\\Classes\\EoEngineBHO.EOBHO.1\nHKLM\\SOFTWARE\\Classes\\EoEngineBHO.EOBHO\nHKLM\\SOFTWARE\\Classes\\CLSID\\[C10DC1F4-CCDF-4224-A24D-B23AFC3573C8\nHKLM\\SOFTWARE\\Classes\\AppID\\[AFBB7970-789A-4264-BA70-E8127DECE400}\nHKLM\\SOFTWARE\\Classes\\AppID\\EoEngineBHO.DLL\nHKLM\\Software\\EoRezo                                                                                                                                                                                                                                                                                                                                                                                                   Se sugiere bloquear el acceso al dominio involucrado en el envento en el servidor de filtrado de contenido.                                                                                                                                                                                                         ",
                "risk" => "El riesgo que conlleva a la organización es la propagación del código malicioso  en el equipo y  la propagación de este a nivel local, afectación del rendimiento del o los equipos,  perdida o  fuga de  información.",
                "reference" => "http://www.microsoft.com/security/portal/threat/encyclopedia/entry.aspx?Name=Adware:Win32/EoRezo\n\nhttp://www.anti-spyware-101.com/es/adwarewin32eorezo\n\nhttp://home.mcafee.com/virusinfo/virusprofile.aspx?key=1030273#none",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "NETBIOS SMB-DS IPC$ unicode share access",
                "description" => "Se refiere a peticiones a través del puerto 445, en la que se utiliza el protocolo SMB mediante una codificación en Unicode._x000D_\n_x000D_\nSMB es un protocolo utilizado para compartir recursos  en una red y consta de dos niveles de seguridad, un usuario y un share; que se trata de un recurso compartido, como puede ser un archivo, una carpeta o una impresora.",
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n- Bloquear el acceso a los puertos TCP y UDP 135 a 139 y 445 en la red, utilizando un firewall perimetral.\n- Utilizar el filtrado IPSec en cada host para restringir el acceso a SMB.\n- Deshabilitar NetBIOS y sustituirlo por NetBEUI.\n En Windows:\n \n      1. En el menú Inicio, haga clic con el botón secundario en Mi PC y en Administrar. \n      2. Expanda Herramientas del sistema y, a continuación, desactive la casilla de verificación Administrador de dispositivos.\n      3. Con el botón secundario, haga clic en Administrador de dispositivos, seleccione Ver y, a continuación, Mostrar dispositivos ocultos.\n     4. Expanda Controladores que no son Plug and Play.\n     5. Haga clic con el botón secundario en NetBios sobre TCP/IP y, a continuación, haga clic en Deshabilitar.\n\n- Desinstalar SMB\n     1. Ir a Inicio | Panel de control y hacer doble clic en el subprograma Conexiones de red.\n     2. Hacer clic en Conexión de área local y seleccione Propiedades.\n     3. Seleccione Cliente para redes Microsoft y haga clic en el botón Desinstalar.\n     4. Una vez finalizada la desinstalación, seleccione Compartir impresoras y archivos para redes Microsoft y haga clic en el botón Desinstalar.\n     5. Cierre todos los cuadros de diálogo y applets.\n\n- Prevenir las sesiones nulas de IPC modificando el registro 'RestrictAnonymous'\n\n NT4 Service Pack 3 de Microsoft proporciona una instalación del registro para evitar la fuga de información sensible a través de las sesiones nulas.\n\n                   \"HKLM\\SYSTEM\\CurrentControlSet\\Control\\LSA\\RestrictAnonymous\"\n\n      * RestrictAnonymous versión 2 puede bloquear una sesión nula por completo, pero puede causar problemas de conectividad con productos de terceros.\n      * RestrictAnonymous versión 1 no bloquea realmente las conexiones anónimas. Sin embargo, si impide la mayor parte de fuga de información durante la sesión nula, principalmente las cuentas de usuario y archivos compartidos.\n\n- Desactivar el intercambio automático de administrative share\n\n      Esto se puede lograr mediante el establecimiento de los valores en 0 de los siguientes registros:\n\n       HKLM\\SYSTEM\\CurrentControlSet\\Services\\LanManServer\\Parameters\\Auto         ShareServer (for Server version)\n       HKLM\\SYSTEM\\CurrentControlSet\\Services\\LanManServer\\Parameters\\Auto         ShareWks (for Professional version)\n\n       * Administrative share también se pueden eliminar manualmente por medio de los siguientes comandos:\n           net share ipc$ /delete\n           net share admin$ /delete\n           net share c$ /delete\n           net share d$ /delete",
                "risk" => "Los puertos NetBIOS son utilizados por el intercambio de archivos y aplicaciones de uso compartido de impresoras.\nLos usuarios de la red con sede fuera de la red acceden a estos servicios a través del puerto 139. \nLos atacantes suelen utilizarlo con regularidad y tratan de entrar en un servidor de archivos a través de este puerto. ",
                "reference" => "http://www.techrecom/blog/it-security/disable-netbios-and-smb-to-protect-public-web-servers-97871/\nhttps://support.microsoft.com/en-us/kb/314984",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "NETBIOS xp_reg* - registry access",
                "description" => null,
                "recommendation" => "Se recomienda llevar acabo las siguentes acciones:\n- Bloquear el acceso a los puertos TCP y UDP 135 a 139 y 445 en la red, utilizando un firewall perimetral.\n- Utilizar el filtrado IPSec en cada host para restringir el acceso a SMB.\n- Deshabilitar NetBIOS y sustituirlo por NetBEUI.\n En Windows:\n \n      1. En el menú Inicio, haga clic con el botón secundario en Mi PC y en Administrar. \n      2. Expanda Herramientas del sistema y, a continuación, desactive la casilla de verificación Administrador de dispositivos.\n      3. Con el botón secundario, haga clic en Administrador de dispositivos, seleccione Ver y, a continuación, Mostrar dispositivos ocultos.\n     4. Expanda Controladores que no son Plug and Play.\n     5. Haga clic con el botón secundario en NetBios sobre TCP/IP y, a continuación, haga clic en Deshabilitar.\n\n- Desinstalar SMB\n     1. Ir a Inicio | Panel de control y hacer doble clic en el subprograma Conexiones de red.\n     2. Hacer clic en Conexión de área local y seleccione Propiedades.\n     3. Seleccione Cliente para redes Microsoft y haga clic en el botón Desinstalar.\n     4. Una vez finalizada la desinstalación, seleccione Compartir impresoras y archivos para redes Microsoft y haga clic en el botón Desinstalar.\n     5. Cierre todos los cuadros de diálogo y applets.\n\n- Prevenir las sesiones nulas de IPC modificando el registro 'RestrictAnonymous'\n\n NT4 Service Pack 3 de Microsoft proporciona una instalación del registro para evitar la fuga de información sensible a través de las sesiones nulas.\n\n                   \"HKLM\\SYSTEM\\CurrentControlSet\\Control\\LSA\\RestrictAnonymous\"\n\n      * RestrictAnonymous versión 2 puede bloquear una sesión nula por completo, pero puede causar problemas de conectividad con productos de terceros.\n      * RestrictAnonymous versión 1 no bloquea realmente las conexiones anónimas. Sin embargo, si impide la mayor parte de fuga de información durante la sesión nula, principalmente las cuentas de usuario y archivos compartidos.\n\n\n- Desactivar el intercambio automático de administrative share\n\n      Esto se puede lograr mediante el establecimiento de los valores en 0 de los siguientes registros:\n\n       HKLM\\SYSTEM\\CurrentControlSet\\Services\\LanManServer\\Parameters\\Auto         ShareServer (for Server version)\n       HKLM\\SYSTEM\\CurrentControlSet\\Services\\LanManServer\\Parameters\\Auto         ShareWks (for Professional version)\n\n       * Administrative share también se pueden eliminar manualmente por medio de los siguientes comandos:\n           net share ipc$ /delete\n           net share admin$ /delete\n           net share c$ /delete\n           net share d$ /delete ",
                "risk" => "Los puertos NetBIOS son utilizados por el intercambio de archivos y aplicaciones de uso compartido de impresoras. \nLos usuarios de la red con sede fuera de la red acceden a estos servicios a través del puerto 139. \nLos atacantes suelen utilizarlo con regularidad y tratan de entrar en un servidor de archivos a través de este puerto. ",
                "reference" => "https://support.microsoft.com/en-us/kb/314053",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Malware Downloader.NSIS.Outbrowse.b",
                "description" => "El Adware “Downloader.NSIS.Outbrowse.b” se cataloga como un PUP (programa potencialmente no deseado por sus siglas en inglés). Un PUP es un programa que se instala sin el consentimiento del usuario y realiza acciones o tiene características que pueden minimizar el control del usuario sobre su privacidad, confidencialidad, uso de recursos del equipo, etc._x000D_\n_x000D_\nFunciona como una extensión para navegadores web, como Google Chrome, Mozilla Firefox e Internet Explorer y una vez en el equipo, modificará archivos de sistema, entradas del registro y la configuración de los navegadores web. También despliega publicidad no deseada en ventanas emergentes además de recopilar información y hábitos de navegación del usuario._x000D_\n_x000D_Este Adware puedes ser la puerta de entrada de Malware al equipo afectado.",
                "recommendation" => "Realizar un análisis del equipo involucrado con un software antivirus para descartar la existencia de algún tipo de malware en el equipo.                                                                                                                                                                      Se sugiere bloquear el acceso al dominio involucrado en el envento en el servidor de filtrado de contenido.                                                                                                                                                                                                                             Identificar el equipo relacionado en el incidente y desinstalar el software  Downloader.NSIS:\nInicio, Panel de control.\nDesinstalar un programa.\nSeleccionar Ponmocup.\nDar clic en el botón “Desinstalar”.                                                                                                                                                                                                                                                                                                                                                                                   Eliminar los complementos de los navegadores web:\nAbrir el navegador web.\nIr a opciones o configuraciones y buscar el apartado de complementos o extensiones.\nDesinstalar los complementos no deseados.",
                "risk" => "El riesgo que conlleva a la organización es la propagación del código malicioso  en el equipo y  la propagación de este a nivel local, afectación del rendimiento del o los equipos,  perdida o  fuga de  información.",
                "reference" => "http://home.mcafee.com/virusinfo/virusprofile.aspx?key=5931632",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "NETBIOS SMB-DS IPC$ share access",
                "description" => "Se refiere a peticiones a través del puerto 445, en la que se utiliza el protocolo SMB mediante una codificación en ASCII._x000D_\nSMB es un protocolo que permite compartir recursos en una red._x000D_\n_x000D_\nDicho protocolo opera directamente sobre TCP/IP, anteriormente necesitaba del protocolo Netbios para funcionar sobre TCP._x000D_\nLa autenticación de SMB se basa en dos niveles, el “usuario” y un “share”. El share (recurso a compartir) puede tratarse de un archivo, una carpeta una impresora, etcétera.",
                "recommendation" => "Validar que el equipo o equipos relacionados con el evento  requieren o está dentro de sus funciones permitir las conexiones por el puerto 445 , en caso de no ser necesaria la conexión se sugiere cerrar el puerto.",
                "risk" => "Los servicios expuestos pueden contar con  puertas abiertas y vulnerabilidades que podrían ser explotadas por atacantes, por lo que el riego de comprometer el equpo es alto",
                "reference" => "http://forums.windowsecurity.com/viewtopic.php?printertopic=1&t=17412&start=0&postdays=0&postorder=asc&vote=viewresult&sid=7a4cbf1566fb4fd387a5723563eebe9a",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "MALWARE Win32/BrowseFox.H Checkin 2",
                "description" => "BrowseFox.H se cataloga como un PUP (programa potencialmente no deseado por sus siglas en inglés). Un PUP es un programa que se instala sin el consentimiento del usuario y realiza acciones o tiene características que pueden minimizar el control del usuario sobre su privacidad, confidencialidad, uso de recursos del equipo, etc._x000D_\n\nBrowseFox.H tiene la capacidad de modificar la configuración de los navegadores web, recopilar información y hábitos de navegación del usuario, además de desplegar publicidad en ventanas emergentes basada en dicha información.\nTambién se encarga de bloquear la página de inicio de los navegadores con el objetivo de forzar el uso de ciertos buscadores que pueden ser peligrosos para el usuario.",
                "recommendation" => "Realizar un análisis del equipo involucrado con un software antivirus para descartar la existencia de algún tipo de malware en el equipo.                                                                                                                                                                      Se sugiere bloquear el acceso al dominio involucrado en el envento en el servidor de filtrado de contenido.                                                                                                                                                                                                                             Identificar el equipo relacionado en el incidente y desinstalar el software BrowseFox:\nInicio, Panel de control.\nDesinstalar un programa.\nSeleccionar Ponmocup.\nDar clic en el botón “Desinstalar”.                                                                                                                                                                                                                                                                                                                                                                                   Eliminar los complementos de los navegadores web:\nAbrir el navegador web.\nIr a opciones o configuraciones y buscar el apartado de complementos o extensiones.\nDesinstalar los complementos no deseados.",
                "risk" => "El riesgo que conlleva a la organización es la propagación del código malicioso  en el equipo y  la propagación de este a nivel local, afectación del rendimiento del o los equipos,  perdida o  fuga de  información.",
                "reference" => "http://deletemalware.blogspot.mx/2013/09/remove-browsefox-virus-removal-guide.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "MALWARE Win32/DealPly checkin",
                "description" => "DealPly es una extensión para navegadores web que sigue los hábitos de navegación web de un usuario y mostrará ofertas de cupones al acceder a sitios web de compras en línea (eBay, Amazon etc.). Aunque DealPly no es un virus o programa malicioso se le cataloga como un PUP (programa potencialmente no deseado por sus siglas en inglés)._x000D_\n_x000D_Un PUP es un programa que se instala sin el consentimiento del usuario y realiza acciones o tiene características que pueden minimizar el control del usuario sobre su privacidad, confidencialidad, uso de recursos del equipo, etc._x000D_\n_x000D_\nExisten varias formas en las que Dealply se puede instalar en el equipo del usuario:\n      • Descargando esta extensión desde su página de inicio siendo consciente de su instalación._x000D_\n      • Junto con otro programa gratuito u otros complementos para navegadores web, con frecuencia, sin el consentimiento del usuario.",
                "recommendation" => "Realizar un análisis del equipo involucrado con un software antivirus para descartar la existencia de algún tipo de malware en el equipo.                                                                                                                                                                      Se sugiere bloquear el acceso al dominio involucrado en el envento en el servidor de filtrado de contenido,",
                "risk" => "El riesgo que conlleva a la organización es la propagación del código malicioso  en el equipo y  la propagación de este a nivel local, afectación del rendimiento del o los equipos,  perdida o  fuga de  información.",
                "reference" => "http://malwarefixes.com/remove-softwarebundlerwin32dealply/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "MarketScore.com Spyware Proxied Traffic",
                "description" => "MarketScore es considerado como un Spyware, usualmente se instala sin consentimiento del usuario a través de algún otro software, por causa de algún malware presente en el equipo o consultas a páginas potencialmente maliciosas._x000D_\n_x000D_\nCuando se instala se inicia un servicio de proxy, una vez que el servicio se ejecuta, todas las conexiones de Internet son enviadas a través del proxy de Marketscore (OSSProxy). _x000D_\nComo todas las conexiones de Internet pasarán por dicho proxy, la información puede ser registrada y analizada por entidades o usuarios malintencionados, lo que representa un riesgo al equipo y a la seguridad de la información de los usuarios.",
                "recommendation" => "Validar que se encuentre instalado únicamente software permitido dentro de las políticas de uso aceptable para el equipo. \nAnalizar el equipo involucrado con un software antivirus actualizado para eliminar cualquier malware que se encuentre alojado en el equipo.                                                                                                                                                            Se sugiere bloquear el acceso al dominio involucrado en el envento en el servidor de filtrado de contenido.",
                "risk" => "El riesgo que conlleva a la organización es la propagación del código malicioso  en el equipo y  la propagación de este a nivel local, afectación del rendimiento del o los equipos,  perdida o  fuga de  información.",
                "reference" => "http://www.symantec.com/security_response/writeup.jsp?docid=2004-042117-5317-99",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "NgrBot IRC CnC Channel Join",
                "description" => null,
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\nNo ejecutar archivos de fuentes no fiables, como los descargados de redes de intercambio de archivos.\n\nRealizar un análisis de los dispositivos extraíbles con software antivirus totalmente actualizado o habilitar el modo de sólo lectura si la opción está disponible.\n\nLimitar el uso de recursos compartidos de la red. \n    En caso de no ser necesario deshabilitar esta opción. \n    En caso de que el intercambio de archivos sea esencial, se les debe asignar permisos de \"sólo   lectura\" cuando sea posible.\n\nRealizar el bloqueo de la comunicación en los dispositivos de seguridad perimetral Firewall.",
                "risk" => "Permite la exportación de discos o impresoras y otros recursos hacia personal no autorizado o que se encuentra fuera de la red.\nRobo de datos.\nÉsta infección de malware incluye otras infecciones de forma oculta lo que ocasiona que sea indetectable por un periodo de tiempo muy largo.",
                "reference" => "http://www.symantec.com/security_response/writeup.jsp?docid=2007-041117-2623-99&tabid=2",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "MarketScore.com Spyware User Configuration and Setup Access",
                "description" => "MarketScore es un spyware que recopila información de los usuarios, sus preferencias e intereses a través de su actividad en la red, para posteriormente enviar la información directamente o después de ser almacenada en el equipo._x000D_\n_x000D_\nEste malware usualmente se instala sin consentimiento del usuario. Además, MarketScore se registra como LSP (Layered Service Provider) ante Microsoft, con la finalidad de recoger los datos del usuario sobre su conexión, uso de Internet, páginas visitadas, inventario de las aplicaciones instaladas, etc.\nLa firma detecta, mediante el uso de la cabecera de User-agent, que se establece comunicación con proxy OSSProxy propio de Marketscore, que utiliza para recopilar dciha información._x000D_",
                "recommendation" => "Validar que se encuentre instalado únicamente software permitido dentro de las políticas de uso aceptable para el equipo. \nAnalizar el equipo involucrado con un software antivirus actualizado para eliminar cualquier malware que se encuentre alojado en el equipo.                                                                                                                                                            Se sugiere bloquear el acceso al dominio involucrado en el envento en el servidor de filtrado de contenido.",
                "risk" => "El riesgo que conlleva a la organización es la propagación del código malicioso  en el equipo y  la propagación de este a nivel local, afectación del rendimiento del o los equipos,  perdida o  fuga de  información.",
                "reference" => "http://www.pandasecurity.com/homeusers/security-info/52230/MarketScore",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Microsoft Remote Desktop (RDP) Syn then Reset 30 Second DoS Attempt",
                "description" => "RDP es un protocolo de escritorio remoto propietario de Microsoft. Un escritorio remoto es una tecnología que permite a un usuario trabajar en una computadora a través de su escritorio gráfico desde otro dispositivo remoto._x000D_\nEste servicio utiliza por defecto el puerto TCP 3389 en el servidor para recibir las peticiones.\nPara solicitar una conexión se utilizan los mensajes Syn (sincronización), si se realizan en lapsos cortos de tiempo, se podría ocasionar una condición de Denegación de Servicio(DoS) ya que se crean múltiples sesiones, esto puede agotar la memoria del sistema, provocando que el equipo servidor deje de responder._x000D_",
                "recommendation" => "Validar que el equipo o equipos relacionados con el evento  requieren o está dentro de sus funciones permitir las conexiones por el puerto 3389, en caso de no ser necesaria la conexión se sugiere cerrar el puerto.        Actualizar y aplicar los parches de seguridad de forma constante a los servicios utilizados en el equipo involucrado.   ",
                "risk" => "Los servicios expuestos pueden ser puertas abiertas para atacantes, por lo que el riesgo de comprometer un equipo es alto.",
                "reference" => "https://technet.microsoft.com/en-us/library/security/ms15-030.aspx",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Mozilla User-Agent (Mozilla/5.0) Inbound Likely Fake",
                "description" => "El User-Agent o Agente de usuario, es un parámetro del protocolo HTTP. Cuando un usuario accede a una página web, generalmente se envía una cadena de texto que identifica al agente de usuario ante el servidor. Este texto forma parte del pedido a través de HTTP, generalmente incluye información como el nombre de la aplicación, la versión, el sistema operativo y el idioma, su formato estándar se define en el RFC RFC2616._x000D_\nLa firma detecta un formato de Agente de Usuario que no sigue el formato estándar, lo que puede significar que sea producido por algún tipo de malware._x000D_",
                "recommendation" => "Verificar  que en el equipo relacionado se encuenten unicamente aplicaciones instaladas autorizadas por la institución, en caso contrario desinstalarlas.                                                                                                                     Analizar el equipo relacionado con un software antivirus totalmente actualizado, para descartar la existencia de algún malware en el equipo.\nActualizar y aplicar los parches más recientes del software, así como del Sistema Operativo y del explorador web del equipo relacionado.           ",
                "risk" => "El riesgo que conlleva a la organización es la propagación del código malicioso  en el equipo y  la propagación de este a nivel local, afectación del rendimiento del o los equipos,  perdida o  fuga de  información.",
                "reference" => "https://lists.emergingthreats.net/pipermail/emerging-sigs/2009-May/002553.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "MS Terminal Server User A Login, possible Morto inbound",
                "description" => "Se identificó tráfico inusual hacia los equipos con dirección IP local, a través del puerto 3389, el cual es utilizado por el protocolo RDP, en dicho tráfico se detectó la presencia del gusano Morto el cual se apoya del protocolo RDP para su propagación.\nMorto es un gusano que se propaga a través de las unidades extraíbles utilizando el protocolo de conexiones de escritorio remoto (RDP) para obtener acceso a los equipos que cuentan con contraseñas débiles, comprometiendo la seguridad del equipo infectado. También deshabilita aplicaciones de seguridad al ejecutarse localmente, lo cual deja a la red aún más vulnerable a otros tipos de ataque.",
                "recommendation" => "Realizar un análisis de los equipos involucrados con un software antivirus para descartar la existencia de algún tipo de malware que esté realizando dicha actividad.      Reforzar la seguridad del equipo involucrados con contraseñas robustas, para dificultar el acceso a los equipos, se recomienda que las contraseñas cumplan con las siguientes características:\n• Contener al menos 12 caracteres.\n• Utilizar caracteres especiales.\n• Mezclar números, letras y caracteres.\n• Utilizar letras mayúsculas y minúsculas.",
                "risk" => "Afectación del rendimiento del equipo, ataque por fuerza bruta,  robo de información, pérdida o fuga de información.",
                "reference" => "https://lists.emergingthreats.net/pipermail/emerging-sigs/2012-March/017895.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "NMAP -f -sS",
                "description" => null,
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n\nVerificar que el equipo de la red interna ejecute únicamente aquellas aplicaciones, procesos, servicios, etc. que sean indispensables para realizar sus tareas asignadas, por lo cual es necesario deshabilitar o desinstalar toda aplicación o configuración que no sea requerida para tales fines.\n\nValidar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no haya sido autorizados.\n\nMonitorear puertos abiertos y cerrar puertos innecesarios en cada uno de los equipos dentro de la red interna.\n\nRealizar el bloqueo de la comunicación en los dispositivos de seguridad perimetral Firewall con polìtica DROP para filtrar los escaneos realizados por NMAP.",
                "risk" => "Reconocimiento de puertos abiertos y filtrados.\nReconocimiento de las versiones de los servicios instalados en el equipo.\nDetección de vulnerabilidades dentro del equipo por medio del análisis de las versiones y servicios instalados en el equipo al que se le realizó el escaneo.",
                "reference" => "http://nmap.org/book/nmap-overview-and-demos.html\nhttp://www.dummies.com/how-to/content/prevent-network-hacking-with-port-scanners.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Muieblackcat scanner",
                "description" => "La actividad generada muestra escaneos de vulnerabilidad hacia los equipos con dirección IP interna, mediante el uso de la herramienta Muieblackcat.\nMuieblackcat es una herramienta que se caracteriza por ser parte de un bot, cuya función es detectar fallos en la configuración de los servidores y vulnerabilidades de código PHP. \nEl objetivo de los escaneos, consiste en encontrar una mala configuración dentro de la instalación de phpMyAdmin y aprovecharla para difundir contenido malicioso.",
                "recommendation" => "Actualizar y aplicar los parches de seguridad de forma constante a los servicios utilizados en el equipo involucrado.                                                                                                                                                                                                            Reforzar la seguridad del equipo utilizando contraseñas robustas, para dificultar el acceso de equipos malintencionados, se recomienda que las contraseñas cumplan con las siguientes características:\n• Contener al menos 12 caracteres.\n• Utilizar caracteres especiales.\n• Mezclar números, letras y caracteres.\n• Utilizar letras mayúsculas y minúsculas.",
                "risk" => "Esto puede llevar a que una persona o entidad maliciosa aproveche esta vulnerabilidad para explotarla y producir fuga de información la cual representaría un riesgo para la organización.   ",
                "reference" => "http://www.securityweek.com/hacked-mit-server-used-stage-attacks-scan-vulnerabilities",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Multiple MySQL Login Failures, Possible Brute Force Attempt",
                "description" => "Se detectaron diversas peticiones hacia el puerto 3306 de los equipo con dirección IP local reportada, este puerto es utilizado por la aplicación de bases de datos MySQL.\nLa actividad generada muestra intentos de inicio de sesión mediante ataques de fuerza bruta, al detectarse en las peticiones el mensaje de intento de inicio de sesión fallido.\nUn ataque de fuerza bruta se da cuando sin conocer las credenciales de acceso, se prueban todas las combinaciones posibles de para lograr ingresar en el sistema sin autorización.",
                "recommendation" => "Restringir los permisos de inicio de sesión de la base de datos utilizada por la aplicación web.                                                                                                                                                                                                                                                          Actualizar y aplicar los parches de seguridad de forma constante a los servicios utilizados en el equipo involucrado.                                                                                                                                                                                                            Reforzar la seguridad del equipo utilizando contraseñas robustas, para dificultar el acceso de equipos malintencionados, se recomienda que las contraseñas cumplan con las siguientes características:\n• Contener al menos 12 caracteres.\n• Utilizar caracteres especiales.\n• Mezclar números, letras y caracteres.\n• Utilizar letras mayúsculas y minúsculas.",
                "risk" => "La información sensible de la base de datos puede quedar expuesta al acceso, modificación o fuga de la información.",
                "reference" => "http://www.cs.virginia.edu/~csadmin/gen_support/brute_force.php",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "MultiPlug.J Checkin",
                "description" => "Se detectó la presencia del Adware Multiplug que se propaga a través de vistas a sitios web maliciosos o mediante la descarga de software ilegal. \nMultiplug es un programa potencialmente no deseado (PUP por siglas en inglés), dicho adware tiene la capacidad de mostrar anuncios, en los navegadores de Internet modificando las páginas de inicio o abriendo publicidad, instala adicionalmente su propia barra de herramientas. \nPor lo general este tipo de adware se instala sin conocimiento del usuario al momento de instalar algún otro software (normalmente a cambio de usar el software gratuito o como una opción de instalación predeterminada), generando fallas en el rendimiento del equipo infectado y son puertas traseras para algún tipo de malware.",
                "recommendation" => "Realizar un análisis del equipo involucrado con un software antivirus para descartar la existencia de algún tipo de malware en el equipo.                                                                                                                                                                     Eliminar del equipo las siguientes entradas de registro:                                                                                                                                                                                                                                                              HKCR\\KeePeer\\CLSID\\[2FB6CC18-5C3E-A17E-2DB7-34B250599632}\nKey: HKCR\\Interface\\[31E3BC75-2A09-4CFF-9C92-8D0ED8D1DC0F}\\TypeLib                                                                                                                                                                                                                                                                                                                       ",
                "risk" => "El riesgo que conlleva a la organización es la propagación del código malicioso  en el equipo y  la propagación de este a nivel local, afectación del rendimiento del o los equipos,  perdida o  fuga de  información.",
                "reference" => "http://www.virusradar.com/en/Win32_Adware.MultiPlug.J/description",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "MYSQL 4.1 brute force root login attempt",
                "description" => "Se detectó un ataque de fuerza bruta realizado hacia el puerto 3306 el cual corresponde al servicio de MySQL.  Un ataque de fuerza bruta se da cuando sin conocer las credenciales de acceso, se prueban todas las combinaciones posibles para lograr ingresar en el sistema sin autorización._x000D_\nSe observó en las peticiones que se intenta obtener las credenciales de acceso del usuario root el cual tiene control total en el Sistema Operativo. Esto representa un riesgo muy alto no solo del equipo sino de la red en general, ya que en caso de obtener las credenciales de dicho usuario, se tendría acceso al equipo involucrado pudiendo agregar, modificar o eliminar información sensible para la institución, acceder a otros equipos de la red o realizar otro tipo de ataque por ejemplo una denegación de servicios(DoS).\n\n",
                "recommendation" => "Restringir los permisos de inicio de sesión de la base de datos utilizada por la aplicación web.                                                                                                                                                                                                                                                          Actualizar y aplicar los parches de seguridad de forma constante a los servicios utilizados en el equipo involucrado.                                                                                                                                                                                                            Reforzar la seguridad del equipo utilizando contraseñas robustas, para dificultar el acceso de equipos malintencionados, se recomienda que las contraseñas cumplan con las siguientes características:\n• Contener al menos 12 caracteres.\n• Utilizar caracteres especiales.\n• Mezclar números, letras y caracteres.\n• Utilizar letras mayúsculas y minúsculas.",
                "risk" => "Esto puede llevar a que una persona o entidad maliciosa obtenga acceso  al servicio, robo  y modificación de  información sensible de la base de datos, denegación de servicio. ",
                "reference" => "http://www.scip.ch/es/?vuldb.21392\n\nhttp://cve.mitre.org/cgi-bin/cvename.cgi?name=CVE-2003-1480\n\nhttps://www.exploit-db.com/exploits/22565/\n\nhttp://www.breaknenter.org/2010/08/teaching-john-how-to-crack-mysql-passwords/\n\nhttp://www.win.tue.nl/~aeb/linux/hh/hh-4.html\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "MYSQL Benchmark Command in URI to Consume Server Resources",
                "description" => "Se detectaron peticiones las cuales usan el comando Benchmark para MySQL, el comando permite medir el rendimiento y carga del equipo en tiempo de ejecución. Este comando también consume recursos del equipo y puede ser usado para retrasar la ejecución de comandos, de tal manera que si se ejecuta un gran número de veces puede llegar a crear una condición de denegación de servicio(DoS).\n_x000D_\n",
                "recommendation" => "Actualizar y aplicar los parches de seguridad de forma constante a los servicios utilizados en el equipo involucrado.\nValidar que se encuentren habilitados unicamente los modulos necesarios para el correcto funcionamiento de la aplicacion de bases de datos.\nImplementar una aplicación WAF (Web Application Firewall) con la que se pueden identificar y bloquear ataques a servidores web ",
                "risk" => "Esto puede llevar a que una persona o entidad maliciosa aproveche esta vulnerabilidad para explotarla y producir fuga de información la cual representaría un riesgo para la organización.  ",
                "reference" => "http://dev.mysql.com/doc/refman/5.1/en/information-functions.html#function_benchmark\n\nhttps://www.owasp.org/index.php/Blind_SQL_Injection\n\nhttp://signatures.juniper.net/documentation/signatures/DB%3AMYSQL%3ABENCHMARK-DOS.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Nmap Scripting Engine User-Agent Detected (Nmap Scripting Engine)",
                "description" => null,
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n\nVerificar que el equipo de la red interna ejecute únicamente aquellas aplicaciones, procesos, servicios, etc. que sean indispensables para realizar sus tareas asignadas, por lo cual es necesario deshabilitar o desinstalar toda aplicación o configuración que no sea requerida para tales fines.\n\nValidar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no haya sido autorizados.\n\nMonitorear puertos abiertos y cerrar puertos innecesarios en cada uno de los equipos dentro de la red interna.\n\nRealizar el bloqueo de la comunicación en los dispositivos de seguridad perimetral Firewall con polìtica DROP para filtrar los escaneos realizados por NMAP.",
                "risk" => "Reconocimiento de puertos abiertos y filtrados.\nReconocimiento de las versiones de los servicios instalados en el equipo.\nDetección de vulnerabilidades dentro del equipo por medio del análisis de las versiones y servicios instalados en el equipo al que se le realizó el escaneo.",
                "reference" => "http://nmap.org/book/nmap-overview-and-demos.html\nhttp://www.dummies.com/how-to/content/prevent-network-hacking-with-port-scanners.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "MYSQL SELECT CONCAT SQL Injection Attemp",
                "description" => "Se detectaron peticiones que realizan un ataque del tipo SQL Injection utilizando el comando CONCAT que permite unir varios datos en una sola consulta. Un ataque SQL Injection consiste en utilizar vulnerabilidades en los sistemas para realizar cualquier consulta SQL sin que sea validada correctamente, lo que permite la ejecución de consultas de cualquier tipo sin autorización con el fin de alterar el funcionamiento normal del sistema.\nEn caso de tener éxito el ataque se puede tener acceso al sistema por completo y realizar modificación, ingreso, extracción o eliminación de datos sensibles para la institución.\n\n\n",
                "recommendation" => "Restringir los permisos de inicio de sesión de la base de datos utilizada por la aplicación web.                                                                                                                                                                                                                                                           Implementar una aplicación WAF (Web Application Firewall) con la que se pueden identificar y bloquear ataques a servidores web.                                                                                                                                                                               Bloquear la comunicación con la dirección IP pública en el firewall perimetral.",
                "risk" => "Esto puede llevar a que una persona o entidad maliciosa aproveche esta vulnerabilidad para explotarla y producir fuga de información la cual representaría un riesgo para la organización.  ",
                "reference" => "http://www.solingest.com/blog/la-funcion-concat-en-mysql\n\nhttp://www.easysoft.com/developer/sql-injection.html\n\nhttps://www.exploit-db.com/papers/13650/\n\nhttps://blog.sucuri.net/2014/10/website-attacks-sql-injection-and-the-threat-they-present.html\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "MYSQL SELECT CONCAT SQL Injection Attempt",
                "description" => "Se detectaron peticiones que realizan un ataque del tipo SQL Injection utilizando el comando CONCAT que permite unir varios datos en una sola consulta. [1]_x000D_\nUn ataque SQL Injection consiste en utilizar vulnerabilidades en los sistemas para realizar cualquier consulta SQL sin que sea validada correctamente, lo que permite la ejecución de consultas de cualquier tipo sin autorización con el fin de alterar el funcionamiento normal del sistema. [2] [3]_x000D_\nEn caso de tener éxito el ataque se puede tener acceso al sistema por completo y realizar modificación, ingreso, extracción o eliminación de datos sensibles para la institución. [4]_x000D_\n_x000D_\n\n",
                "recommendation" => "Restringir los permisos de inicio de sesión de la base de datos utilizada por la aplicación web.                                                                                                                                                                                                                                                           Implementar una aplicación WAF (Web Application Firewall) con la que se pueden identificar y bloquear ataques a servidores web                                                                                                                                                                                Bloquear la comunicación con la dirección IP pública en el firewall perimetral.",
                "risk" => "Esto puede llevar a que una persona o entidad maliciosa aproveche esta vulnerabilidad para explotarla y producir fuga de información la cual representaría un riesgo para la organización.  ",
                "reference" => "[1] http://www.solingest.com/blog/la-funcion-concat-en-mysql\n\n[2] http://www.easysoft.com/developer/sql-injection.html\n\n[3] https://www.exploit-db.com/papers/13650/\n\n[4] https://blog.sucuri.net/2014/10/website-attacks-sql-injection-and-the-threat-they-present.html\n\n\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "NETBIOS Microsoft SRV2.SYS SMB Negotiate ProcessID Function Table Dereference",
                "description" => "Esta firma nos indica el intento de provocar un error de desbordamiento de memoria en el protocolo SMBv2 implementado en srv2.sys en los sistemas de Windows vista, Windows server 2008 y Windows 7 RC._x000D_\n\nPermite que un atacante de manera remota ejecute código arbitrario o cause una denegacion de servicios (DoS), poniendo un caracter & (ampersand) en la cabecera de un paquete NEGOTIATE PROTOCOL REQUEST, lo cual desencadena un intento por eliminar la referencia a una posición de memoria._x000D_\n_x000D_\nSMB es un protocolo utilizado para compartir recursos en una red y consta de dos niveles de seguridad, un usuario y un share; que se trata de un recurso compartido, como puede ser un archivo, una carpeta o una impresora.",
                "recommendation" => "Mantener actualizado el software tanto de las aplicaciones como del Sistema Operativo, para evitar y corregir vulnerabilidades.                                                                                                                                                                                Validar que el equipo o equipos relacionados con el evento  requieren o está dentro de sus funciones permitir las conexiones por el puerto 445 , en caso de no ser necesaria la conexión se sugiere cerrar el puerto.",
                "risk" => "Los servicios expuestos pueden contar con  puertas abiertas y vulnerabilidades que podrían ser explotadas por atacantes, por lo que el riego de comprometer el equpo es alto",
                "reference" => "http://www.rapid7.com/db/modules/exploit/windows/smb/ms09_050_smb2_negotiate_func_index",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "NETBIOS SMB Session Setup NTMLSSP unicode asn1 overflow attempt",
                "description" => "El protocolo SMB permite diferentes mecanismos de autenticación para iniciar una sesión, entre ellos el protocolo NTLMSSP._x000D_\n_x000D_\nLos sistemas operativos de Microsoft: Windows NT, Windows 2000, Windows XP, y Windows Server 2003 presentan una vulnerabilidad en la biblioteca ASN.1 implementada por Microssft. _x000D_\nDicha biblioteca es utilizada para estandarizar los datos que se intercambian entre múltiples plataformas, sin embargo, un atacante podría enviar una petición de autenticación especialmente diseñada para generar un desbordamiento de memoria y así poder ejecutar comandos con privilegios del sistema de forma arbitraria_x000D_.\n\nSMB es un protocolo utilizado para compartir recursos  en una red y consta de dos niveles de seguridad, un usuario y un share; que se trata de un recurso compartido, como puede ser un archivo, una carpeta o una impresora.",
                "recommendation" => "Validar que el equipo o equipos relacionados con el evento  requieren o está dentro de sus funciones permitir las conexiones por el puerto 139 , en caso de no ser necesaria la conexión se sugiere cerrar el puerto.",
                "risk" => "Los servicios expuestos pueden contar con  puertas abiertas y vulnerabilidades que podrían ser explotadas por atacantes, por lo que el riego de comprometer el equpo es alto",
                "reference" => "https://lists.emergingthreats.net/pipermail/emerging-sigs/2012-November/020893.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "P2P Ares traffic",
                "description" => null,
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n\nDesinstalar el software de la aplicación en los equipos de la red local.\n\nRealizar un análisis de los equipos con un software antivirus totalmente actualizado, en busca de malware.\n\nHabilitar o instalar un Firewall para la detección de tráfico inusual dentro de la red.\n\nBloquear el tráfico asociado a programas de intercambio de archivos P2P no aprobados en el perímetro de la red.",
                "risk" => "Instalación de código malicioso.\nFuga de información sensible.\nSusceptibilidad a ataques debido a la apertura de puertos que este tipo de software requiere.\nUna condición de denegación de servicios.\nConsumo de ancho de banda.",
                "reference" => "https://www.us-cert.gov/ncas/tips/ST05-007",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "NMAP -sS window 1024",
                "description" => null,
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n\nVerificar que el equipo de la red interna ejecute únicamente aquellas aplicaciones, procesos, servicios, etc. que sean indispensables para realizar sus tareas asignadas, por lo cual es necesario deshabilitar o desinstalar toda aplicación o configuración que no sea requerida para tales fines.\n\nValidar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no haya sido autorizados.\n\nMonitorear puertos abiertos y cerrar puertos innecesarios en cada uno de los equipos dentro de la red interna.\n\nRealizar el bloqueo de la comunicación en los dispositivos de seguridad perimetral Firewall con polìtica DROP para filtrar los escaneos realizados por NMAP.",
                "risk" => "Reconocimiento de puertos abiertos y filtrados.\nReconocimiento de las versiones de los servicios instalados en el equipo.\nDetección de vulnerabilidades dentro del equipo por medio del análisis de las versiones y servicios instalados en el equipo al que se le realizó el escaneo.",
                "reference" => "http://nmap.org/book/nmap-overview-and-demos.html\nhttp://www.dummies.com/how-to/content/prevent-network-hacking-with-port-scanners.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "NMAP -sS window 2048",
                "description" => null,
                "recommendation" => "\nSe recomienda llevar acabo las siguientes acciones:\n\nVerificar que el equipo de la red interna ejecute únicamente aquellas aplicaciones, procesos, servicios, etc. que sean indispensables para realizar sus tareas asignadas, por lo cual es necesario deshabilitar o desinstalar toda aplicación o configuración que no sea requerida para tales fines.\n\nValidar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no haya sido autorizados.\n\nMonitorear puertos abiertos y cerrar puertos innecesarios en cada uno de los equipos dentro de la red interna.\n\nRealizar el bloqueo de la comunicación en los dispositivos de seguridad perimetral Firewall con polìtica DROP para filtrar los escaneos realizados por NMAP.",
                "risk" => "Reconocimiento de puertos abiertos y filtrados.\nReconocimiento de las versiones de los servicios instalados en el equipo.\nDetección de vulnerabilidades dentro del equipo por medio del análisis de las versiones y servicios instalados en el equipo al que se le realizó el escaneo.",
                "reference" => "http://nmap.org/book/nmap-overview-and-demos.html\nhttp://www.dummies.com/how-to/content/prevent-network-hacking-with-port-scanners.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "NMAP -sS window 3072",
                "description" => null,
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n\nVerificar que el equipo de la red interna ejecute únicamente aquellas aplicaciones, procesos, servicios, etc. que sean indispensables para realizar sus tareas asignadas, por lo cual es necesario deshabilitar o desinstalar toda aplicación o configuración que no sea requerida para tales fines.\n\nValidar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no haya sido autorizados.\n\nMonitorear puertos abiertos y cerrar puertos innecesarios en cada uno de los equipos dentro de la red interna.\n\nRealizar el bloqueo de la comunicación en los dispositivos de seguridad perimetral Firewall con polìtica DROP para filtrar los escaneos realizados por NMAP.",
                "risk" => "Reconocimiento de puertos abiertos y filtrados.\nReconocimiento de las versiones de los servicios instalados en el equipo.\nDetección de vulnerabilidades dentro del equipo por medio del análisis de las versiones y servicios instalados en el equipo al que se le realizó el escaneo.",
                "reference" => "http://nmap.org/book/nmap-overview-and-demos.html\nhttp://www.dummies.com/how-to/content/prevent-network-hacking-with-port-scanners.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "NMAP -sS window 4096",
                "description" => null,
                "recommendation" => "\nSe recomienda llevar acabo las siguientes acciones:\n\nVerificar que el equipo de la red interna ejecute únicamente aquellas aplicaciones, procesos, servicios, etc. que sean indispensables para realizar sus tareas asignadas, por lo cual es necesario deshabilitar o desinstalar toda aplicación o configuración que no sea requerida para tales fines.\n\nValidar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no haya sido autorizados.\n\nMonitorear puertos abiertos y cerrar puertos innecesarios en cada uno de los equipos dentro de la red interna.\n\nRealizar el bloqueo de la comunicación en los dispositivos de seguridad perimetral Firewall con polìtica DROP para filtrar los escaneos realizados por NMAP.",
                "risk" => "Reconocimiento de puertos abiertos y filtrados.\nReconocimiento de las versiones de los servicios instalados en el equipo.\nDetección de vulnerabilidades dentro del equipo por medio del análisis de las versiones y servicios instalados en el equipo al que se le realizó el escaneo.",
                "reference" => "http://nmap.org/book/nmap-overview-and-demos.html\nhttp://www.dummies.com/how-to/content/prevent-network-hacking-with-port-scanners.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Non-Allowed Host Tried to Connect to MySQL Server",
                "description" => null,
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n\nEstablecer en la tabla de permisos dentro del sistema de control de acceso de MySQL , el nivel de accesos para cada usuario en la base de datos.\n\nEstablecer contraseñas seguras:\n    La contraseña debe constar de al menos 12 caracteres.\n    Debe contener caracteres alfanuméricos.\n    Debe contener caracteres especiales.\n    Debe combinar mayúsculas y minúsculas.\n\nComprobar los permisos en los archivos de configuración.\n\nCifrar las transmisiones cliente-servidor mediante herramientas como OpenSSH.\n\nDesactivar el acceso remoto, esto se logra al iniciar el servidor con la opción --skip-networking.",
                "risk" => "Acceder a la aplicación sin tener nombre de usuario ni contraseña.\nAveriguar el nombre de los campos.\nAveriguar el nombre de las tablas.\nAveriguar el contenido de los registros.\nAñadir nuevos usuarios.\nBorrar información de la base de datos.\nRobar información importante para la institución.\nProvocar una denegación de servicios.\nSuplantación de identidad.\nDivulgar información confidencial.",
                "reference" => "http://www.symantec.com/security_response/writeup.jsp?docid=2007-041117-2623-99&tabid=2",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "NTP DDoS Inbound Frequent Un-Authed MON_LIST Requests IMPL 0x02",
                "description" => null,
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n\n Deshabilitar la funcionalidad monlist dentro del servidor NTP.\n\nActualizar a la versión 4.2.7 de NTP o superior.\n\n    Si la actualización no es posible:\n\n     Verificar si las respuestas a monlist están habilitadas:\n\n                ntpq -c rv\n                ntpdc -c sysinfo\n                ntpdc -n -c monlist\n\nSi la respuesta es positiva, el servidor es vulnerable y  por su configuración es susceptible de amplificar respuestas. Para corregir el problema pueden seguir lo siguiente:\n\n    Desactivar las consultas de monitorización, o restringir su acceso, en la configuración ntp.conf:\n\n    Desactivar monitor:  disable monitor\n\nComo alternativa, si se pretende mantener la monitorización,  puede restringirse su uso a redes internas:\n      restrict default noquery\n      restrict localhost\n      restrict 192.168.0.0 netmask 255.255.0.0\n      restrict 192.168.1.27",
                "risk" => "Los servidores NTP que se encuentran públicamente accesibles pueden ser objeto de abuso para inundar un sistema de destino con  tráfico UDP y causar una condición de denegación de servicios. \nCambios en la configuración del servidor.",
                "reference" => "https://www.incibe.es/blogs/post/Seguridad/BlogSeguridad/Articulo_y_comentarios/Ataques_DoS_NTP",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "NTP DDoS Inbound Frequent Un-Authed MON_LIST Requests IMPL 0x03",
                "description" => null,
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n\n Deshabilitar la funcionalidad monlist dentro del servidor NTP.\n\nActualizar a la versión 4.2.7 de NTP o superior.\n\n    Si la actualización no es posible:\n\n     Verificar si las respuestas a monlist están habilitadas:\n\n                ntpq -c rv\n                ntpdc -c sysinfo\n                ntpdc -n -c monlist\n\nSi la respuesta es positiva, el servidor es vulnerable y  por su configuración es susceptible de amplificar respuestas. Para corregir el problema pueden seguir lo siguiente:\n\n    Desactivar las consultas de monitorización, o restringir su acceso, en la configuración ntp.conf:\n\n    Desactivar monitor:  disable monitor\n\nComo alternativa, si se pretende mantener la monitorización,  puede restringirse su uso a redes internas:\n      restrict default noquery\n      restrict localhost\n      restrict 192.168.0.0 netmask 255.255.0.0\n      restrict 192.168.1.27\nReferencia: https://www.incibe.es/blogs/post/Seguridad/BlogSeguridad/Articulo_y_comentarios/Ataques_DoS_NTP",
                "risk" => "Los servidores NTP que se encuentran públicamente accesibles pueden ser objeto de abuso para inundar un sistema de destino con  tráfico UDP y causar una condición de denegación de servicios. \nCambio en la configuración del servidor.",
                "reference" => "http://www.stateoftheinternet.com/faq-best-practices-ddos-prevention-how-to-prevent-ddos.html\nhttp://www.esecurityplanet.com/network-security/5-tips-for-fighting-ddos-attacks.html\nhttps://blog.cloudflare.com/technical-details-behind-a-400gbps-ntp-amplification-ddos-attack/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Numerical .cn Domain Likely Malware Related",
                "description" => null,
                "recommendation" => "\nSe recomienda llevar acabo las siguientes acciones:\n\nAnalizar el equipo con un software antivirus para descartar la presencia de malware.\n\nBloquear el dominio en el filtrado de contenido.\n\nDescargar los parches de seguridad.\n\nRestrinja el acceso a sitios web sospechosos.\n\niptables -A OUTPUT -p tcp -d www.facebook.com -j DROP\niptables -A OUTPUT -p tcp -d facebook.com -j DROP\n\nRealizar respaldos de la información sensible de los equipos en la red interna.\n\nUtilice contraseñas seguras:\n   Al menos 16 caracteres.\n   Caracteres alfanuméricos.\n   Incluir letras mayúsculas y minúsculas.\n   Incluir caracteres especiales.",
                "risk" => "Realizar consultas a sitios que son foco de infección puede causar la propagación de malware dentro de la red interna y compremeter toda o parte de la  red.\nLos atacantes pueden tener acceso al sistema de archivos y causar pérdida o fuga de información sensible, así mismo permite obtener contraseñas o escalar privilegios.\nRedirigir las consultas hacia páginas Web no deseadas.\nExponer el equipo a una infección por malware.\nInstalación de programas dañinos sin el conocimiento del usuario.\nEjecución de scripts con el propósito de obtener información del equipo.\nRedirigir el tráfico hacia sitios inseguros donde un atacante puede robar la información transmitida.",
                "reference" => "https://www.ccn-cert.cni.es/publico/seriesCCN-STIC/series/800-Esquema_Nacional_de_Seguridad/812-Seguridad_en_Entornos_y_Aplicaciones_Web/812-Entornos_y_aplicaciones_web-oct11.pdf\nhttps://seguinfo.wordpress.com/2012/06/06/estrategias-basicas-para-mitigar-una-ciberintrusion/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "onion.cab .onion Proxy DNS lookup",
                "description" => null,
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n\nAnalizar el equipo con un software antivirus para descartar la presencia de malware.\n\nBloquear el dominio en el filtrado de contenido.\n\nDescargar los parches de seguridad.\n\nRestrinja el acceso a sitios web sospechosos.\n\niptables -A OUTPUT -p tcp -d www.facebook.com -j DROP\niptables -A OUTPUT -p tcp -d facebook.com -j DROP\n\nRealizar respaldos de la información sensible de los equipos en la red interna.\n\nUtilice contraseñas seguras:\n   Al menos 16 caracteres.\n   Caracteres alfanuméricos.\n   Incluir letras mayúsculas y minúsculas.\n   Incluir caracteres especiales.",
                "risk" => "Realizar consultas a sitios que son foco de infección puede causar la propagación de malware dentro de la red interna y compremeter toda o parte de la  red.\nLos atacantes pueden tener acceso al sistema de archivos y causar pérdida o fuga de información sensible, así mismo permite obtener contraseñas o escalar privilegios.\nRedirigir las consultas hacia páginas Web no deseadas.\nExponer el equipo a una infección por malware.\nInstalación de programas dañinos sin el conocimiento del usuario.\nEjecución de scripts con el propósito de obtener información del equipo.\nRedirigir el tráfico hacia sitios inseguros donde un atacante puede robar la información transmitida.",
                "reference" => "https://www.ccn-cert.cni.es/publico/seriesCCN-STIC/series/800-Esquema_Nacional_de_Seguridad/812-Seguridad_en_Entornos_y_Aplicaciones_Web/812-Entornos_y_aplicaciones_web-oct11.pdf\nhttps://seguinfo.wordpress.com/2012/06/06/estrategias-basicas-para-mitigar-una-ciberintrusion/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Onmouseover= in URI - Likely Cross Site Scripting Attempt",
                "description" => null,
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n\n- Utilizar un navegador que no permita scripting del lado del cliente.\n- Asegurarse de que todos los contenidos que se entregan al cliente sean verificados contra una especificación de contenido aceptable.\n- Asegurarse de que todos los contenidos procedentes del cliente están utilizando la misma codificación; si no, la aplicación del lado del servidor debe canonizar los datos antes de aplicar cualquier filtrado.\n- Realizar la validación de entrada para todo el contenido remoto y el contenido generado por el usuario.\n- Realizar la validación de salida de todo el contenido remoto.\n- Desactivar lenguajes de scripting como JavaScript en el navegador.\nAplicación: Aplicación de parches de software. Hay muchos tipos de ataque de XSS en el lado del cliente y el servidor. Muchas vulnerabilidades se fijan en los Service Packs de navegador, servidores web, y se conectan en las tecnologías, mantenerse al día sobre la liberación de parches que se ocupan de las contramedidas XSS mitiga esto.\n\nReferencia: https://capec.mitre.org/data/definitions/244.html",
                "risk" => "La integridad de los datos puede verse comprometida.\nLas cookies se pueden establecer y leer.\nLa entrada del usuario puede ser interceptada.\nScripts maliciosos pueden ser ejecutados por el cliente en el contexto de una fuente de confianza.",
                "reference" => "https://www.owasp.org/index.php/Cross-site_Scripting_(XSS)",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "P2P BitTorrent - Torrent File Downloaded",
                "description" => null,
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n\nDesinstalar el software de la aplicación en los equipos de la red local.\n\nRealizar un análisis de los equipos con un software antivirus totalmente actualizado, en busca de malware.\n\nHabilitar o instalar un Firewall para la detección de tráfico inusual dentro de la red.\n\nBloquear el tráfico asociado a programas de intercambio de archivos P2P no aprobados en el perímetro de la red.",
                "risk" => "Instalación de código malicioso.\nFuga de información sensible.\nSusceptibilidad a ataques debido a la apertura de puertos que este tipo de software requiere.\nUna condición de denegación de servicios.\nConsumo de ancho de banda.",
                "reference" => "https://www.us-cert.gov/ncas/tips/ST05-007",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "OpenCandy Adware Checkin",
                "description" => null,
                "recommendation" => "\nSe recomienda llevar a cabo las siguientes acciones:\n\nVerificar si se encuentra instalado en el equipo el Adware OpenCandy, en caso de \nser así, desinstalarlo:\n      Iniciar el equipo en modo seguro.\n      Ir a panel de control --> Agregar o quitar programas --> Eliminar \nOpenCandy.\n\nEliminar los complementos de los navegadores web.\n       Abrir un navegador web.\n       Ir a opciones o configuraciones y buscar el apartado de complementos o extensiones.\n       Desinstalar los complementos no deseados.\n\nRealizar un análisis completo del equipo con un software antivirus actualizado, para descartar la presencia de malware debido al dominio.\n\nSi se cuenta con un servidor para filtrado de contenido, bloquear la navegación hacia \nel sitio.\n       De lo contrario bloquear dicho dominio en el archivo “hosts” del equipo.",
                "risk" => " Se trata de anuncios que aparecen de repente en pantalla incluso aunque no se esté navegando por Internet. Algunas empresas ofrecen software \"gratuito\" a cambio de publicidad que aparece en pantalla. Así es como\nhacen dinero.\nCuando un equipo dentro de la red es comprometido es un foco de infección por lo que puede resultar en la propagación de malware o incluso ser utilizado como una botnet.\nEl atacante puede obtener información sensible o causar su pérdida.\nEscalación de privilegios.",
                "reference" => "http://www.avgthreatlabs.com/es-es/virus-and-malware-information/info/opencandy/\nhttp://www.techsupportalert.com/content/controversial-advertising-program-now-being-embedded-more-software.htm",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "OpenSource Guestbook SQL Injection Attempt -- email.php id SELECT",
                "description" => null,
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n\n- Mejorara las formas de autenticación: cuando se realiza la autenticación mediante un formulario web, es probable que las credenciales de usuario se comparan con una base de datos que contiene todos los nombres de usuario y contraseñas (o, mejor, los hashes de contraseñas).\n- Los motores de búsqueda: la cadena enviada por el usuario podría utilizarse en una consulta SQL que extrae todos los registros relevantes de una base de datos.\n- Sitios de comercio electrónico: los productos y sus características (precio, descripción, disponibilidad, etc.) es muy probable que se almacena en una base de datos.\n\nEl programador tiene que hacer una lista de todos los campos de entrada cuyos valores podrían ser utilizados en la elaboración de una consulta SQL, incluyendo los campos ocultos de peticiones POST y luego ponerlos a prueba por separado, tratando de interferir con la consulta y generar un error. Considere también las cabeceras HTTP y Cookies.",
                "risk" => "La plataforma afectada puede ser:\n\nLenguaje: SQL\nPlataforma: Cualquiera (requiere de interacción con una base de datos SQL).\n\nLa inyección SQL se ha convertido en un problema común con sitios web que cuentan con base de datos. La falla es fácilmente detectada y fácilmente explotada, y como tal, cualquier sitio o paquete de software con incluso una mínima base de usuario es propenso a ser objeto de un intento de ataque de este tipo. Esencialmente, el ataque es llevado a cabo mediante la colocación de un meta carácter en los datos de entrada para colocar comandos SQL en el plano de control, el cual antes no existía. Este error depende del hecho de que SQL no hace real distinción entre los planos de datos y los de control.",
                "reference" => "http://www.admin-magazine.com/Articles/Uncovering-SQL-Injections\nhttps://www.owasp.org/index.php/SQL_Injection",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "OpenSource Guestbook SQL Injection Attempt -- email.php id UNION SELECT",
                "description" => null,
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n\n- Mejorara las formas de autenticación: cuando se realiza la autenticación mediante un formulario web, es probable que las credenciales de usuario se comparan con una base de datos que contiene todos los nombres de usuario y contraseñas (o, mejor, los hashes de contraseñas).\n- Los motores de búsqueda: la cadena enviada por el usuario podría utilizarse en una consulta SQL que extrae todos los registros relevantes de una base de datos.\n- Sitios de comercio electrónico: los productos y sus características (precio, descripción, disponibilidad, etc.) es muy probable que se almacena en una base de datos.\n\nEl programador tiene que hacer una lista de todos los campos de entrada cuyos valores podrían ser utilizados en la elaboración de una consulta SQL, incluyendo los campos ocultos de peticiones POST y luego ponerlos a prueba por separado, tratando de interferir con la consulta y generar un error. Considere también las cabeceras HTTP y Cookies.",
                "risk" => "La plataforma afectada puede ser:\n\nLenguaje: SQL\nPlataforma: Cualquiera (requiere de interacción con una base de datos SQL).\n\nLa inyección SQL se ha convertido en un problema común con sitios web que cuentan con base de datos. La falla es fácilmente detectada y fácilmente explotada, y como tal, cualquier sitio o paquete de software con incluso una mínima base de usuario es propenso a ser objeto de un intento de ataque de este tipo. Esencialmente, el ataque es llevado a cabo mediante la colocación de un meta carácter en los datos de entrada para colocar comandos SQL en el plano de control, el cual antes no existía. Este error depende del hecho de que SQL no hace real distinción entre los planos de datos y los de control.",
                "reference" => "http://www.admin-magazine.com/Articles/Uncovering-SQL-Injections\nhttps://www.owasp.org/index.php/SQL_Injection",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Outbound MSSQL Connection to Standard port (1433)",
                "description" => null,
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:  \n\n- Validar que las conexiones entre los equipos involucrados sean legítimas.\n- Verificar si el equipo con de la red interna requiere o está dentro de sus funciones permitir las conexiones por el puerto 1433, en caso de no ser necesaria la conexión se sugiere cerrar el puerto.\n                       Abrir el firewall de Windows -> Programas -> Windows firewall con seguridad avanzada -> Regla de entrada, desde aquí se podrá crear la regla para realizar el bloqueo. \n- Identificar el equipo de origen y analizarlo por medio de un software antivirus actualizado para descartar la existencia de algún tipo de malware que esté realizando la actividad.\n- En caso de que el equipo cuente con una aplicación de Base de Datos, se recomienda mantener actualizado el software tanto de aplicaciones como del Sistema Operativo.\n- Utilizar contraseñas seguras:\n           Al menos 16 caracteres.\n          Caracteres alfanuméricos.\n          Incluir letras mayúsculas y minúsculas.\n          Incluir caracteres especiales.",
                "risk" => "Propagación de malware.\nReinicio del equipo. \nEl sistema responde de manera lenta o incluso no inicia el SO. \nPérdida o eliminación de archivos sin autorización del usuario.\nPublicidad o ventanas emergentes con contenido inapropiado.\nRobo de contraseñas.",
                "reference" => "https://books.google.com.mx/books?id=K8XdRni4t94C&pg=PA148&lpg=PA148&dq=riesgos+del+puerto+1433&source=bl&ots=Ph3CqCPRiA&sig=y6TKZ6zREN56yD51D9_HXfhhqEE&hl=es&sa=X&ei=s9GBVZqwOYXhoATH-Zm4Ag&ved=0CBwQ6AEwAA#v=onepage&q=riesgos%20del%20puerto%201433&f=false",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Outbound Multiple Non-SMTP Server Emails",
                "description" => null,
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n\n- Validar si hubo algún tipo de solicitud que justifique el envío de un correo electrónico.\n- Mantener a los equipos locales con las últimas actualizaciones disponibles.",
                "risk" => "Puede considerarse SPAM y ser penalizado por ello.\nFuga de información sensible.\nRobo de contraseñas.\nSuplantación de identidad.",
                "reference" => "http://www.xequte.com/support/maillistking/spamissues.html\nhttps://documentation.cpanel.net/display/CKB/How+to+Prevent+Email+Abuse\nhttp://serverfault.com/questions/48428/how-to-send-emails-and-avoid-them-being-classified-as-spam",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "P2P Bittorrent P2P Client User-Agent (uTorrent)",
                "description" => null,
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n\nDesinstalar el software de la aplicación en los equipos de la red local.\n\nRealizar un análisis de los equipos con un software antivirus totalmente actualizado, en busca de malware.\n\nHabilitar o instalar un Firewall para la detección de tráfico inusual dentro de la red.\n\nBloquear el tráfico asociado a programas de intercambio de archivos P2P no aprobados en el perímetro de la red.",
                "risk" => "Instalación de código malicioso.\nFuga de información sensible.\nSusceptibilidad a ataques debido a la apertura de puertos que este tipo de software requiere.\nUna condición de denegación de servicios.\nConsumo de ancho de banda.",
                "reference" => "https://www.us-cert.gov/ncas/tips/ST05-007",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "P2P BitTorrent peer sync",
                "description" => null,
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n\nDesinstalar el software de la aplicación en los equipos de la red local.\n\nRealizar un análisis de los equipos con un software antivirus totalmente actualizado, en busca de malware.\n\nHabilitar o instalar un Firewall para la detección de tráfico inusual dentro de la red.\n\nBloquear el tráfico asociado a programas de intercambio de archivos P2P no aprobados en el perímetro de la red.",
                "risk" => "Instalación de código malicioso.\nFuga de información sensible.\nSusceptibilidad a ataques debido a la apertura de puertos que este tipo de software requiere.\nUna condición de denegación de servicios.\nConsumo de ancho de banda.",
                "reference" => "https://www.us-cert.gov/ncas/tips/ST05-007",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "P2P BTWebClient UA uTorrent in use",
                "description" => null,
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n\nDesinstalar el software de la aplicación en los equipos de la red local.\n\nRealizar un análisis de los equipos con un software antivirus totalmente actualizado, en busca de malware.\n\nHabilitar o instalar un Firewall para la detección de tráfico inusual dentro de la red.\n\nBloquear el tráfico asociado a programas de intercambio de archivos P2P no aprobados en el perímetro de la red.",
                "risk" => "Instalación de código malicioso.\nFuga de información sensible.\nSusceptibilidad a ataques debido a la apertura de puertos que este tipo de software requiere.\nUna condición de denegación de servicios.\nConsumo de ancho de banda.",
                "reference" => "https://www.us-cert.gov/ncas/tips/ST05-007",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "P2P Edonkey Connect Reply and Server List",
                "description" => "Se detectó el uso de “eDonkey”, el cual es una red de intercambio de archivos P2P (Peer To Peer) que facilita la descarga de diversos tipos de archivos, la cual puede ser usada en varios software de tipo P2P tales como: eMule, uTorrent, Ares, Bitorrent, Vuze, entre otros._x000D_\nEl uso de aplicaciones que utilizan redes P2P pone en riesgo la seguridad de la información en los equipos de cómputo, ya que puede provocar la fuga de información sensible y son foco de infección de malware, así como puede incurrir en \n",
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n\nDesinstalar el software de la aplicación en los equipos de la red local.\n\nRealizar un análisis de los equipos con un software antivirus totalmente actualizado, en busca de malware.\n\nHabilitar o instalar un Firewall para la detección de tráfico inusual dentro de la red.\n\nBloquear el tráfico asociado a programas de intercambio de archivos P2P no aprobados en el perímetro de la red.",
                "risk" => "Instalación de código malicioso.\nFuga de información sensible.\nSusceptibilidad a ataques debido a la apertura de puertos que este tipo de software requiere.\nUna condición de denegación de servicios.\nConsumo de ancho de banda.",
                "reference" => "https://forums.avg.com/es-es/avg-forums?sec=thread&act=show&id=5139\n\nhttps://en.wikibooks.org/wiki/The_World_of_Peer-to-Peer_(P2P)/Networks_and_Protocols/eDonkey\n\nhttp://www.hijosdigitales.es/2011/07/riesgos-al-compartir-por-redes-p2p/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "P2P Edonkey Connect Request",
                "description" => "Se detectó tráfico procedente de la dirección IP origen hacia la dirección IP destino, donde se identifica una red de intercambio de datos P2P (Peer To Peer), la cual puede ser utilizada en varios programas de descargas de tipo P2P. Donde dichas redes son generalmente utilizadas para descargar y compartir distintos tipos de archivos._x000D_\nEl uso de aplicaciones que utilizan redes P2P pone en riesgo la seguridad de la información en los equipos de cómputo, ya que puede provocar la fuga de información sensible y son foco de infección de malware, así como puede incurrir en una violación a las políticas internas por el uso indebido de software ajeno a la institución._x000D_\n\n",
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n\nDesinstalar el software de la aplicación en los equipos de la red local.\n\nRealizar un análisis de los equipos con un software antivirus totalmente actualizado, en busca de malware.\n\nHabilitar o instalar un Firewall para la detección de tráfico inusual dentro de la red.\n\nBloquear el tráfico asociado a programas de intercambio de archivos P2P no aprobados en el perímetro de la red.",
                "risk" => "Instalación de código malicioso.\nFuga de información sensible.\nSusceptibilidad a ataques debido a la apertura de puertos que este tipo de software requiere.\nUna condición de denegación de servicios.\nConsumo de ancho de banda.",
                "reference" => "http://techterms.com/definition/p2p\n\nhttps://forums.avg.com/es-es/avg-forums?sec=thread&act=show&id=5139",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "P2P Edonkey Search Reply",
                "description" => "Esta firma se presenta debido a la detección de respuestas de búsqueda hacia la red descentralizada ed2k o edonkey, la cual es un proyecto por parte de emule de redes bajo el protocolo P2P, para la compartición de archivos.\n\n",
                "recommendation" => "\nSe recomienda llevar acabo las siguientes acciones:\n\nDesinstalar el software de la aplicación en los equipos de la red local.\n\nRealizar un análisis de los equipos con un software antivirus totalmente actualizado, en busca de malware.\n\nHabilitar o instalar un Firewall para la detección de tráfico inusual dentro de la red.\n\nBloquear el tráfico asociado a programas de intercambio de archivos P2P no aprobados en el perímetro de la red.",
                "risk" => "Instalación de código malicioso.\nFuga de información sensible.\nSusceptibilidad a ataques debido a la apertura de puertos que este tipo de software requiere.\nUna condición de denegación de servicios.\nConsumo de ancho de banda.",
                "reference" => "http://www.emule-project.net/home/perl/general.cgi?l=1\nhttp://www.symantec.com/connect/articles/identifying-p2p-users-using-traffic-analysis",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "P2P Edonkey Search Request (any type file)",
                "description" => "Esta firma se presenta debido a la detección de peticiones de búsqueda de cualquier archivo hacia la red descentralizada ed2k o edonkey, la cual es un proyecto por parte de emule de redes bajo el protocolo P2P, para la compartición de archivos.\n",
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n\nDesinstalar el software de la aplicación en los equipos de la red local.\n\nRealizar un análisis de los equipos con un software antivirus totalmente actualizado, en busca de malware.\n\nHabilitar o instalar un Firewall para la detección de tráfico inusual dentro de la red.\n\nBloquear el tráfico asociado a programas de intercambio de archivos P2P no aprobados en el perímetro de la red.",
                "risk" => "Instalación de código malicioso.\nFuga de información sensible.\nSusceptibilidad a ataques debido a la apertura de puertos que este tipo de software requiere.\nUna condición de denegación de servicios.\nConsumo de ancho de banda.",
                "reference" => "http://www.emule-project.net/home/perl/general.cgi?l=1\nhttp://www.symantec.com/connect/articles/identifying-p2p-users-using-traffic-analysis",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "P2P Edonkey Search Request (search by name)",
                "description" => "Esta firma se presenta debido a la detección de peticiones de búsqueda especifica hacia la red descentralizada ed2k o edonkey, la cual es un proyecto por parte de emule de redes bajo el protocolo P2P, para la compartición de archivos.\n",
                "recommendation" => "\nSe recomienda llevar acabo las siguientes acciones:\n\nDesinstalar el software de la aplicación en los equipos de la red local.\n\nRealizar un análisis de los equipos con un software antivirus totalmente actualizado, en busca de malware.\n\nHabilitar o instalar un Firewall para la detección de tráfico inusual dentro de la red.\n\nBloquear el tráfico asociado a programas de intercambio de archivos P2P no aprobados en el perímetro de la red.",
                "risk" => "Instalación de código malicioso.\nFuga de información sensible.\nSusceptibilidad a ataques debido a la apertura de puertos que este tipo de software requiere.\nUna condición de denegación de servicios.\nConsumo de ancho de banda.",
                "reference" => "Referencia:\nhttp://www.emule-project.net/home/perl/general.cgi?l=1\nhttp://www.symantec.com/connect/articles/identifying-p2p-users-using-traffic-analysis",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "P2P Edonkey Search Results",
                "description" => "Esta firma se presenta debido a la respuesta de búsqueda o despliegue de resultados hacia la red descentralizada ed2k o edonkey, la cual es un proyecto por parte de emule de redes bajo el protocolo P2P, para la compartición de archivos.\n",
                "recommendation" => "\nSe recomienda llevar acabo las siguientes acciones:\n\nDesinstalar el software de la aplicación en los equipos de la red local.\n\nRealizar un análisis de los equipos con un software antivirus totalmente actualizado, en busca de malware.\n\nHabilitar o instalar un Firewall para la detección de tráfico inusual dentro de la red.\n\nBloquear el tráfico asociado a programas de intercambio de archivos P2P no aprobados en el perímetro de la red.",
                "risk" => "Instalación de código malicioso.\nFuga de información sensible.\nSusceptibilidad a ataques debido a la apertura de puertos que este tipo de software requiere.\nUna condición de denegación de servicios.\nConsumo de ancho de banda.",
                "reference" => "http://www.emule-project.net/home/perl/general.cgi?l=1\nhttp://www.symantec.com/connect/articles/identifying-p2p-users-using-traffic-analysis",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "P2P eMule Kademlia Hello Request",
                "description" => "Kademlia es un protocolo de la capa de aplicación la cual está diseñada para las redes P2P (punto a punto), este protocolo regula la comunicación entre nodos y el intercambio de información. Estos nodos llegan a comunicarse entre si, los cuales son usados por el protocolo UDP creando una red virtual sobre una red LAN/WAN existente, en el cual cada nodo de la red es identificado por un número o nodo, esta red es una red de intercambio de archivos, el uso de ciertas aplicaciones P2P se limita en ciertos ambientes._x000D_\n\nCabe mencionar que los programas P2P, son programas para bajar o compartir archivos como son música, videos o programas de manera gratuita, ofreciendo a quien los instala, para poder compartir y acceder a directorios compartidos en otros equipos poniendo en riesgo la seguridad de la información en los equipos, ya que puede provocar la fuga de información sensible y son foco de infección de malware._x000D_\n\n\n",
                "recommendation" => "\nSe recomienda llevar acabo las siguientes acciones:\n\nDesinstalar el software de la aplicación en los equipos de la red local.\n\nRealizar un análisis de los equipos con un software antivirus totalmente actualizado, en busca de malware.\n\nHabilitar o instalar un Firewall para la detección de tráfico inusual dentro de la red.\n\nBloquear el tráfico asociado a programas de intercambio de archivos P2P no aprobados en el perímetro de la red.",
                "risk" => "Instalación de código malicioso.\nFuga de información sensible.\nSusceptibilidad a ataques debido a la apertura de puertos que este tipo de software requiere.\nUna condición de denegación de servicios.\nConsumo de ancho de banda.",
                "reference" => "http://forum.emule-project.net/index.php?showtopic=39066\n\nhttp://www.vsantivirus.com/lista-p2p.htm",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "P2P Kaaza Media desktop p2pnetworking.exe Activity",
                "description" => "Kazaa Media Desktop comenzó como un intercambio P2P (punto a punto) archivo de aplicación utilizando el protocolo FastTrack que consiste en un sistema de intercambio de archivos, esta aplicación de Kazaa desktop es descargado gratuitamente._x000D_\nCabe mencionar que los programas P2P, son programas para bajar o compartir archivos como son música, videos o programas de manera gratuita ofreciendo a quien los instala, para poder compartir y acceder a directorios compartidos en otros equipos poniendo en riesgo la seguridad de la información en los equipos, ya que puede provocar la fuga de información sensible y son foco de infección de malware._x000D_\n\n\n",
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n\nDesinstalar el software de la aplicación en los equipos de la red local.\n\nRealizar un análisis de los equipos con un software antivirus totalmente actualizado, en busca de malware.\n\nHabilitar o instalar un Firewall para la detección de tráfico inusual dentro de la red.\n\nBloquear el tráfico asociado a programas de intercambio de archivos P2P no aprobados en el perímetro de la red.",
                "risk" => "Instalación de código malicioso.\nFuga de información sensible.\nSusceptibilidad a ataques debido a la apertura de puertos que este tipo de software requiere.\nUna condición de denegación de servicios.\nConsumo de ancho de banda.",
                "reference" => "https://www.sans.org/security-resources/malwarefaq/kmd-virus.php",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "P2P Octoshape UDP Session",
                "description" => "Octoshape es un cliente de streaming online capaz de retransmitir canales de audio y vídeo a nuestros reproductores preferidos como son Winamp, Windows Media Player, RealPlayer, VLC o Apple iTunes, etc. También utiliza la tecnología de redes P2P (punto a punto) para minimizar el ancho de banda para para transmitir cualquier material. Octoshape llega a utilizar el protocolo HTTP para conectar servidores y utilizar el protocolo UDP para comunicarse en los puertos 554, 5060._x000D_\n_x000D_\nEste tipo de aplicaciones que son usados pueden poner en riesgo la seguridad de la información en los equipos, ya que puede provocar la fuga de información sensible y son foco de infección de malware._x000D_\n\n\n",
                "recommendation" => "\nSe recomienda llevar acabo las siguientes acciones:\n\nDesinstalar el software de la aplicación en los equipos de la red local.\n\nRealizar un análisis de los equipos con un software antivirus totalmente actualizado, en busca de malware.\n\nHabilitar o instalar un Firewall para la detección de tráfico inusual dentro de la red.\n\nBloquear el tráfico asociado a programas de intercambio de archivos P2P no aprobados en el perímetro de la red.",
                "risk" => "Instalación de código malicioso.\nFuga de información sensible.\nSusceptibilidad a ataques debido a la apertura de puertos que este tipo de software requiere.\nUna condición de denegación de servicios.\nConsumo de ancho de banda.",
                "reference" => "http://www.octoshape.com/\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "P2P possible torrent download",
                "description" => "La actividad detectada por la firma corresponde al intercambio de archivos Torrent desde los sitios reportados a través de redes P2P (Peer To Peer) la cual puede ser usada por varios programas de descargas de tipo P2P. Donde dichas redes son generalmente utilizadas para descargar y compartir distintos tipos de archivos.\n_x000D_\nEl uso de aplicaciones que utlizan redes P2P pone en riesgo la seguridad de la información en los equipos de cómputo, ya que puede provocar la fuga de información sensible y son foco de infección de malware, así como puede incurrir en una violación a las políticas internas por el uso indebido de software ajeno a la institución.\n_x000D_\n",
                "recommendation" => "\nSe recomienda llevar acabo las siguientes acciones:\n\nDesinstalar el software de la aplicación en los equipos de la red local.\n\nRealizar un análisis de los equipos con un software antivirus totalmente actualizado, en busca de malware.\n\nHabilitar o instalar un Firewall para la detección de tráfico inusual dentro de la red.\n\nBloquear el tráfico asociado a programas de intercambio de archivos P2P no aprobados en el perímetro de la red.",
                "risk" => "Instalación de código malicioso.\nFuga de información sensible.\nSusceptibilidad a ataques debido a la apertura de puertos que este tipo de software requiere.\nUna condición de denegación de servicios.\nConsumo de ancho de banda.",
                "reference" => "http://techterms.com/definition/p2p \n\nhttp://smallbusiness.chron.com/dangers-torrents-70661.html\n\nhttp://forums.avg.com/es-es/avg-forums?sec=thread&act=show&id=5139\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "P2P Vuze BT UDP Connection",
                "description" => "La detección de actividad inusual dentro de los equipos de cómputo con respecto a la firma, se puede identificar al uso de “Vuze”, el cual es un programa empleado para la transferencia de archivos a través de “BitTorrent”_x000D_.\n_x000D_\nBitTorrent es un protocolo diseñado para el intercambio de archivos P2P (Peer to Peer) en Internet, siendo uno de los protocolos más comunes para la transferencia de archivos grandes. _x000D_\n_x000D_\nEl uso de aplicaciones que utilizan redes P2P pone en riesgo la seguridad de la información en los equipos de cómputo, ya que puede provocar la fuga de información sensible y son foco de infección de malware, así como puede incurrir en una violación a las políticas internas por el uso indebido de software ajeno a la institución.\n",
                "recommendation" => " \nSe recomienda llevar acabo las siguientes acciones:\n\nDesinstalar el software de la aplicación en los equipos de la red local.\n\nRealizar un análisis de los equipos con un software antivirus totalmente actualizado, en busca de malware.\n\nHabilitar o instalar un Firewall para la detección de tráfico inusual dentro de la red.\n\nBloquear el tráfico asociado a programas de intercambio de archivos P2P no aprobados en el perímetro de la red.",
                "risk" => "Instalación de código malicioso.\nFuga de información sensible.\nSusceptibilidad a ataques debido a la apertura de puertos que este tipo de software requiere.\nUna condición de denegación de servicios.\nConsumo de ancho de banda.",
                "reference" => "http://laneutralidaddered.blogspot.mx/2011/07/el-trafico-p2p.html\n\nhttp://forums.avg.com/es-es/avg-forums?sec=thread&act=show&id=5139",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Palevo/BFBot/Mariposa client join attempt",
                "description" => "Esta firma se presenta al detectar actividad inusual de peticiones de conexión con direcciones IP públicas, las cuales cuenten con antecedente de propagación de código malicioso. Identificando la comunicación con el C&C de la botnet \"Palevo\"._x000D_\n_x000D_\nPalevo es un malware de tipo gusano que puede tomar control del equipo infectado y realizar acciones de forma remota, afectando el funcionamiento del equipo. Otra característica, es la capacidad para bloquear el software de seguridad, modificando la configuración del firewall y desactivando los servicios de seguridad como las actualizaciones o deshabilitando el antivirus del equipo._x000D_\n_x000D_\nLa propagación del malware de tipo gusano, se lleva a cabo por vulnerabilidades del sistema operativo, por el uso de unidades extraíbles contaminadas o por el uso de programas de intercambio de archivos P2P.\n         _x000D_\n\n",
                "recommendation" => "Se recomienda llevar acabo las siguientes accciones:\n\nInstalar un software antivirus totalmente actualizado y analizar el equipo en busca de malware.\n\nBorrar la caché y las cookies en el navegador del equipo.\n\nDesactivar reproducción automática para prevenir la ejecución automática de maliciosos archivos ejecutables en extraíbles y unidades de red.\n\nSiempre mantener sistemas actualizados mediante la descarga y la aplicación de los últimos parches de seguridad.\n\nEvite hacer clic en URL-dudosas de fuentes desconocidas.\n\nAislar inmediatamente equipos infectados de la red para prevenir la propagación.",
                "risk" => "Propagación de malware.\nReinicio del equipo. \nEl sistema responde de manera lenta o incluso no inicia el SO. \nPérdida o eliminación de archivos sin autorización del usuario.\nPublicidad o ventanas emergentes con contenido inapropiado.\nRobo de contraseñas.",
                "reference" => "http://www.trendmicro.com/vinfo/us/threat-encyclopedia/web-attack/104/palevo-worm-leads-to-info-theft-ddos-attacks\n\nhttp://www.osi.es/gl/node/4241",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Possible HTTP 404 XSS Attempt (Local Source)",
                "description" => "Esta firma se levanta al identificar un intento de ataque XSS, en donde el atacante ocupa la página de error (404) para obtener informacion del servidor web contra el cual se realza el ataque._x000D_\n_x000D_\nEsta firma se hace presente cuando se identiffica en la solicitud enviada al servidor la cadena \"<script\" la cual hace referencia a un script que algún usuario mal intencionado inyectó en el servidor web.",
                "recommendation" => "Realizar validaciones y codificar cualquier entrada de datos proporcionada por una agente externo a la aplicación mediante formularios, URL, etc.\nImplementar políticas restrictivas o permisivas que ayuden a filtrar los datos enviados hacia la aplicación.\nImplementar una política de contenido seguro.\nImplementar un firewall para aplicaciones web (WAF).",
                "risk" => "Los atacantes pueden ejecutar scipts en el navegador del equipo de la víctima para secuestrar su sesión de usuario, realizar ataques de modificación de contenido (defacement), redireccionar al usuario a sitios maliciosos buscando infectar el equipo con malware, etc.",
                "reference" => "https://www.nsa.gov/ia/_files/factsheets/xss_iad_factsheet_final_web.pdf\nhttps://www.owasp.org/index.php/XSS_(Cross_Site_Scripting)_Prevention_Cheat_Sheet\nhttps://www.owasp.org/index.php/Web_Application_Firewall",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Pandex checkin detected",
                "description" => "Presencia en el equipo del Malware Trojan.Pandex, este troyano se propaga mediante la distribución de SPAM desde un servidor remoto, una vez instalado en el equipo recolecta direcciones de correo electrónico para infectar otros equipos y además, permite conexiones remotas a los equipos comprometidos._x000D_\n_x000D_\nUn caballo de Troya es una aplicación maliciosa que se hace pasar por software legítimo para engañar al usuario y poder ser instalado. Una vez en el equipo, puede ejecutar una serie de procesos maliciosos para comprometerlo o robar información sensible.",
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n\n- Utilizar un firewall para bloquear todas las conexiones entrantes de Internet a los servicios que no deberían estar públicos.\n- Seguir una política de contraseña segura:\n       Al menos 16 caracteres.\n      Caracteres alfanuméricos.\n      Incluir letras mayúsculas y minúsculas.\n      Incluir caracteres especiales.\n- Asegurarse de que los programas y usuarios del equipo utilizan el nivel más bajo de los privilegios necesarios para completar una tarea. \n- Desactivar reproducción automática para evitar la puesta en marcha automática de los archivos ejecutables de las redes y unidades extraíbles, y desconecte las unidades cuando no es necesario.\n- Desactivar el uso compartido de archivos si no es necesario. Si se requiere el intercambio de archivos, utilice una ACL y la protección de contraseña para limitar el acceso.\n- Aislar computadoras comprometidas con rapidez para evitar que las amenazas se propague aún más. Realice un análisis forense y restaure los equipos con medios de confianza.\n- Configurar su servidor de correo electrónico para bloquear o eliminar correo electrónico que contiene archivos adjuntos que se utilizan comúnmente para propagar amenazas, como .vbs, .bat, .exe, .pif y .scr.",
                "risk" => "El Trojan.Pandex penetra el sistema sin conocimiento y sin permiso del usuario, y fácilmente contacta un servidor remoto para descargar otros parásitos nocivos en el ordenador infectado. \nExtorsión y robo de identidad.\nFrecuentes POPUPS en el navegador.\nModificación de registros del SO.\nEl sistema se vuelve lento.\n",
                "reference" => "http://www.symantec.com/security_response/writeup.jsp?docid=2007-042001-1448-99&tabid=2",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Paros Proxy Scanner Detected",
                "description" => "Paros es una aplicación con distintas funciones para realizar pruebas de seguridad y escaneos de vulnerabilidades en plataformas web. Además, permite ver y modificar el trafico HTTP/HTTPS al momento que pasa por la red.",
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n\n- Actualizar y aplicar los parches de seguridad de forma constante a los servicios utilizados en el equipo involucrado.\n- Filtrar los paquetes de todas las peticiones con el User Agent: \"Paros\", accediendo a la configuración de  iptables, y rechazar la comunicación por medio de la siguiente regla: \n        iptables -A INPUT -p tcp --dport 80 -m string --algo bm --string \"Paros\" -j DROP\n- Si la aplicación utilizada como servidor se trata de Apache, se puede implementar un control de acceso utilizando el módulo mod_authz_host con la siguiente regla: \n        Deny from 37.115.191.68\n- Implementar una aplicación WAF (Web Application Firewall) con la que se pueden identificar y bloquear ataques a servidores web.",
                "risk" => "Paros proxy es una aplicación para la evaluación de vulnerabilidades sobre aplicaciones web. Consiste en un proxy realizado en Java que permite visualizar en tiempo real los paquetes HTTP/HTTPS y ver los elementos que se están editando o modificando, como las cookies y campos de formularios. Además, incluye un registro de tráfico, calculadora de hash y un escáner que permite el análisis de la aplicación web y posteriormente la realización de ataques comunes a aplicaciones web como XSS (cross-site scripting) e inyección de SQL.          ",
                "reference" => "http://www.ibm.com/developerworks/library/wa-appsecurity/\nhttp://sectooladdict.blogspot.mx/2011/01/myth-breaker-best-open-source-web.html\nhttps://www.os3.nl/_media/2010-2011/courses/rp1/p27_report.pdf",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "PHP Generic Remote File Include Attempt (FTP)",
                "description" => "Se da cuando un atacante incluye un archivo malicioso de forma remota en un servidor con una aplicación web vulnerable (generalmente desarrollada en PHP), usualmente esto se logra al explotar el mecanismo de “inclusión dinámica de archivos”._x000D_\n_x000D_\nLa vulnerabilidad ocurre debido a que no se validan adecuadamente los datos proporcionados por el usuario, lo que puede llevar a:_x000D_\n_x000D_\nEjecución de código en el servidor web._x000D_\nEjecución de código en el lado del cliente (por ejemplo JavaScript) que puede ocasionar otro tipo de ataques como cross-site scripting (XSS)._x000D_\nDenegación de servicios (DoS)._x000D_\nRobo de información sensible._x000D_\n_x000D_\nEn este caso la inclusión del archivo se da mediante el protocolo FTP.",
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n\n- Revisar los componentes, módulos y plugins que se tenga instalado en Joomla!, para aplicar las actulizaciones de seguridad.\n- Nunca conectarse como superusuario o como propietario de la base de datos. Siempre utilice usuarios personalizados con privilegios muy limitados.\n- Emplear sentencias preparadas con variables vinculadas. Son proporcionadas por PDO, MySQLi y otras bibliotecas.\n- Comprobar si la entrada proporcionada tiene el tipo de datos previsto. PHP tiene un amplio rango de funciones para validar la entrada de datos, desde las más simples, encontradas en Funciones de variables y en Funciones de tipo caracter (p.ej., is_numeric(), ctype_digit() respectivamente), hasta el soporte para expresiones regulares compatibles con Perl.\n- Si la expresión espera una entrada numérica, considere verificar los datos con la función ctype_digit(), o silenciosamente cambie su tipo utilizando settype(), o emplee su representación numérica por medio de sprintf().",
                "risk" => "La ejecución de código en el servidor web\nLa ejecución de código en el lado del cliente como JavaScript que puede conducir a otros ataques como cross site scripting (XSS)\nDenegación de servicio (DoS)\nEl robo de datos / manipulación.\nLos atacantes proporcionan datos de entrada modificados para el intérprete de SQL y engañan al intérprete para ejecutar comandos no deseados.\nLos atacantes utilizan esta vulnerabilidad, proporcionando datos de entrada modificados para el intérprete de SQL de una manera tal que el intérprete no es capaz de distinguir entre los comandos y datos destinados  por el atacante. El intérprete es engañado para ejecutar comandos no deseados.\nUn ataque de inyección SQL explota las vulnerabilidades de seguridad en la capa de base de datos. Al explotar la falla de inyección SQL, los atacantes pueden crear, leer, modificar o eliminar información confidencial.",
                "reference" => "http://php.net/manual/es/security.database.sql-injection.php",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "PHP Remote File Inclusion (monster list http)",
                "description" => "Se da cuando un atacante incluye un archivo malicioso de forma remota en un servidor con una aplicación web vulnerable (generalmente desarrollada en PHP), usualmente esto se logra al explotar el mecanismo de “inclusión dinámica de archivos”._x000D_\n_x000D_\nLa vulnerabilidad ocurre debido a que no se validan adecuadamente los datos proporcionados por el usuario, lo que puede llevar a:_x000D_\n_x000D_\nEjecución de código en el servidor web.",
                "recommendation" => "\nSe recomienda llevar acabo las siguientes acciones:\n\n- Actualizar a la última versión.\n- Para detener este tipo de ataques, el programador debe filtrar correctamente la variable.\n- Cuando se realiza una petición URI por un fichero/directorio, se debe construir el path completo del fichero/directorio y normalizar todos los caracteres (ej, 20% convertido a espacios).\n- Asegurarse de que los primeros caracteres de un directorio correcto es exactamente el mismo que el del documento raíz.\n- Utilizar magic_qoutes_gpc para que los caracteres: ‘, “, \\, y los NULL sean automáticamente marcados con una barra invertida.\n- Asegurarse de que no se pueda acceder a archivos más allá del \"Document Root\" de la página.\n- Verificar el tamaño del archivo.\n- Utilizar MYME-TYPE para verificar la extensión del archivo.",
                "risk" => "\nLa inclusión de archivos remotos (RFI) es un tipo de vulnerabilidad que se encuentra en los sitios web. \nPermite que un atacante incluya un archivo remoto, por lo general a través de una secuencia de comandos en el servidor web . La vulnerabilidad se produce debido a la utilización de la entrada proporcionada por el usuario sin validación adecuada.\n\n",
                "reference" => "http://www.securityspace.com/smysecure/catid.html?id=1.3.6.1.4.1.25623.1.0.80073\nhttp://www.cvedetails.com/cve/CVE-2006-1781/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "PHP System Command in HTTP POST",
                "description" => "Se detectaron peticiones que intentan ejecutar comandos de sistema a través de peticiones web. Se utiliza el método de envió de datos POST para poder ingresar comandos de sistema los cuales pueden ser ingresados directamente en la URL o pueden ser incluidos en un archivo PHP el cual se ingresa al sistema para posteriormente ejecutar comandos que pueden afectar al sistema o aplicación web._x000D_\nEste tipo de ataques busca ejecutar comandos que permitan el acceso al equipo sin autorización o la alteración del contenido en servidores web, en caso de tener éxito el ataque compromete la seguridad del equipo y su contenido permitiendo fuga de información sensible o ejecución de otro tipo de código malicioso que afecte a otros equipos dentro de la institución.\n_x000D_\n\n",
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n\nExaminar el paquete de señales  en el que se está haciendo la solicitud a un servidor malicioso y / o en peligro. Compruebe si hay otros IDS u otros eventos de herramientas relacionadas con el flujo TCP en cuestión. Verificar los niveles de parches y soluciones antimalware, como FireAMP, en el host de punto final. Si el malware parece estar presente, considere la reconstrucción de la máquina afectada.",
                "risk" => "Navegación dirigida\nPhishing\nSpyware\nRobo de credenciales\nEjecución de acciones automáticas\nSecuestro de sesión / fijación \nLa falta de tiempo de espera de sesión / cierre de sesión\n",
                "reference" => "https://www.praetorian.com/blog/php-cgi-remote-command-execution-vulnerability-exploitation\n\nhttp://www.golemtechnologies.com/articles/shell-injection\n\nhttps://www.owasp.org/index.php/Testing_for_Command_Injection_(OTG-INPVAL-013)\n\nhttp://insecurety.net/?p=403",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "PHP tags in HTTP POST",
                "description" => "Se detectaron peticiones que realizan un ataque de RFI (Remote File Inclusion) donde intentan ingresar un archivo con extensión PHP en el equipo a través del método POST. Se intenta explotar una vulnerabilidad en los sistemas conocida como Unrestricted File Upload que permite subir archivos a servidores sin ninguna restricción, esto debido a variables mal validadas o vulnerabilidades de aplicaciones utilizadas.\nEste tipo de ataques permite al usuario acceder al equipo sin autorización y puede provocar fuga de información sensible así como tomar control total del equipo involucrado permitiendo realizar cualquier acción indebida.\n_x000D_\nReferencias:_x000D_\nhttp://cyberseguridad.net/index.php/181-inclusion-de-ficheros-remotos-rfi-remote-file-inclusion-ataques-informaticos-ii_x000D_\nhttps://isc.sans.edu/diary/Interesting+PHP+injection/9478_x000D_\nhttps://www.owasp.org/index.php/Unrestricted_File_Upload_x000D_\nhttps://www.owasp.org/index.php/Testing_for_Remote_File_Inclusion_x000D_\nhttp://projects.webappsec.org/w/page/13246955/Remote%20File%20Inclusion_x000D_",
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n\nEste tipo de ataques se debe a la falta de desarrollo de código seguro, por lo que se recomienda realizar lo siguiente:\n\n- Validación De Datos\n\n  La validación de datos es el proceso de asegurar que su aplicación se está ejecutando con los datos correctos. Si su script PHP espera un número entero para la entrada del usuario, a continuación, cualquier otro tipo de datos se descarta. Cada pieza de datos de usuario debe ser validado en que lo reciba para asegurarse de que es del tipo corregido, y se desecha si no pasa el proceso de validación.\n\n- Escapar de salida\n\n  Con el fin de proteger la integridad de los datos / salida que muestran, debe escapar de los datos en la presentación al usuario. Esto evita que el navegador de la aplicación de cualquier significado no deseado a cualquier secuencia especial de caracteres que se pueden encontrar.\n\n-Sanitización de Datos\n\n   Sanitización de datos se centra en la manipulación de los datos para asegurarse de que es seguro, eliminando cualquier resto no deseados de los datos y la normalización a la forma correcta. Por ejemplo, si usted está esperando una cadena de texto sin formato como la entrada del usuario, es posible que desee eliminar cualquier código HTML de ella.\n\nEn general, el htmlspecialchars() la función es suficiente para el filtrado de salida prevista para su visualización en un navegador. Si utiliza una codificación de caracteres en sus páginas web que no sean ISO-8859-1 o UTF-8, sin embargo, entonces usted querrá usar htmlentities() . Para obtener más información acerca de las dos funciones, lea sus respectivos escribir-ups en la documentación oficial de PHP.",
                "risk" => "También conocido como XSS, el ataque es básicamente un tipo de ataque de inyección de código que se hace posible gracias a la validación de los datos de usuario de forma incorrecta, que generalmente se inserta en la página a través de un formulario web o mediante un hipervínculo alterado. El código inyectado puede ser cualquier código de cliente malintencionado, como JavaScript, VBScript, HTML, CSS, Flash y otros. El código se utiliza para guardar los datos dañinos en el servidor o realizar una acción maliciosa en el navegador del usuario.\n\nDesafortunadamente, los ataques cross-site scripting se produce sobre todo, porque los desarrolladores están fallando para entregar código seguro. Cada programador PHP tiene la responsabilidad de entender cómo los ataques se pueden llevar a cabo en contra de sus scripts en PHP para explotar posibles vulnerabilidades de seguridad.",
                "reference" => "http://php.net/manual/es/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "PHP-CGI query string parameter vulnerability",
                "description" => "Se detectaron peticiones que intentan explotar una vulnerabilidad del módulo php-cgi perteneciente a PHP, que consiste en un error del archivo cgi_main.c que permite la manipulación de parámetros para poder escalar privilegios. La vulnerabilidad es identificada como CVE-2012-1823 afectando a las versiones 5.4.1 y anteriores.\nLa vulnerabilidad permite a un atacante obtener información sensible,  causar una denegación de servicio(DoS) o puede ser capaz de ejecutar código arbitrario con los privilegios del servidor web.\n_x000D_\nReferencias:_x000D_\nhttp://www.scip.ch/es/?vuldb.5319_x000D_\nhttps://www.exploit-db.com/exploits/18836/_x000D_\nhttps://cve.mitre.org/cgi-bin/cvename.cgi?name=CVE-2012-1823_x000D_\nhttps://bugs.php.net/bug.php?id=61910_x000D_\nhttp://www.symantec.com/security_response/attacksignatures/detail.jsp?asid=27798_x000D_\nhttps://isc.sans.edu/diary/PHP+vulnerability+CVE-2012-1823+being+exploited+in+the+wild/13312_x000D_",
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n\n- Actualizar y aplicar los parches de seguridad de forma constante a los servicios utilizados en el equipo involucrado.\n",
                "risk" => "Cuando se configura como un script CGI (también conocido como php-cgi), éste no maneja adecuadamente las cadenas de consulta por lo que permite a atacantes remotos ejecutar código arbitrario mediante la colocación de opciones de línea de comando en la cadena de consulta.",
                "reference" => "https://www.snort.org/rule_docs/22063",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "PING IPTools",
                "description" => "Se detectaron una serie de conexiones utilizando la aplicación IPTools, dicha aplicación contiene varias herramientas para el análisis y explorar redes.\nEntre las herramientas de IPTools se encuentra Ping Scanner que puede ser utilizada para el escaneo de una red mediante el comando ping que utiliza el protocolo ICMP el cual permite verificar el estado de un host en una red; en caso de contar con gran cantidad de peticiones puede llegar a generar una condición de denegación de servicios(DoS)._x000D_\nUno de los objetivos de un escaneo, es la identificación de puertos abiertos así como la versión de las aplicaciones que se encuentran utilizando dichos puertos, esto con la finalidad de descubrir vulnerabilidades que puedan poner en peligro la seguridad de los equipos de una institución.\n_x000D_\n",
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones: \n\n- Para deshabilitar, bloquear o “dropear” los paquetes ping, añada las siguientes reglas en el iptable:\n\n   # iptables -A INPUT -i eth0 -p icmp --icmp-type destination-unreachable -j ACCEPT\n   # iptables -A INPUT -i eth0 -p icmp --icmp-type time-exceeded -j ACCEPT\n   # iptables -A INPUT -i eth0 -p icmp --icmp-type echo-reply -j ACCEPT\n   # iptables -A INPUT -i eth0 -p icmp -j DROP\n\nNota: Tambien puede eliminar el -i eth0 y bloquear el ping en todas las interfaces de red.\n\n- Existe una forma más fácil de lograrlo y es poner el valor \"icmp_echo_ignore_all\" a 1 de manera permanente, para ello puedes hacer lo siguiente:\n    \n    Editar sysctl.conf\n       # sudo nano /etc/sysctl.conf\n    Agregar la línea\n       net.ipv4.icmp_echo_ignore_all = 1",
                "risk" => "En presencia de las solicitudes con una dirección de origen falsa (\"spoofing\"), pueden hacer que una máquina de destino envíe paquetes relativamente grandes a otro host. \n\nNota: Tenga cuenta que una respuesta Ping no es sustancialmente mayor que la correspondiente solicitud, por lo que no hay un efecto multiplicador de ahí: no dará energía adicional al atacante en el contexto de un ataque de denegación de servicio. Puede proteger el atacante contra identificación, sin embargo.\n\nUna solicitud Ping puede dar información sobre la estructura interna de una red. Esto no es pertinente a los servidores visibles públicamente, sin embargo, ya los que ya son visibles públicamente.\n\nEl uso de trafico ICMP de tipo  echo permite la exploracion de sistemas activos. Con esta exploracion se pretende identificar los equipos existentes dentro de la red que se quiere explorar, normalmente\naccesibles desde internet.\n\nEl comando ping puede informar, mediante paquetes ICMP de tipos echo-request y echo-reply, sobre si una determinada direccion IP está o no activa.\n\nLos objetivos de un escaneo, es la identificación de puertos abiertos así como la versión de las aplicaciones que se encuentran utilizando dichos puertos, esto con la finalidad de descubrir vulnerabilidades que puedan poner en peligro al equipo y a la institución.",
                "reference" => "http://www.ks-soft.net/ip-tools.esp/index.htm\n\nhttp://resources.infosecinstitute.com/icmp-attacks/ \n\nhttp://www.techworld.com/security/defending-yourself-against-port-scanners-490/\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Possible Apache Struts OGNL Command Execution CVE-2013-2251 redirect",
                "description" => "La actividad generada muestra intentos de explotar la vulnerabilidad de Java \"Struts 2.0.0\", en el servidor Apache (CVE 2013-2251), esta vulnerabilidad permite manipular el flujo de una aplicación web mediante los comandos OGNL, modificando los parámetros \"action:\"/\"redirect:\"/\"redirectAction:\" de forma remota.\nEsta vulnerabilidad afecta a las versiones 2.0.0 y 2.3.15 de la aplicación Apache Struts.",
                "recommendation" => "Se recomienda llevar acabo las siguientes acciones:\n- Actualizar  a la versión  Struts 2.3.15.1 o superior y aplicar los parches más recientes de todo el software así como del Sistema Operativo.\n- Realizar un análisis del equipo con un software antivirus totalmente actualizado, en busca de malware.",
                "risk" => "Una vulnerabilidad calificada como crítica se ha encontrado en Apache Struts hasta la versión 2.3.15. Esta afecta a una función desconocida del componente DefaultActionMapper. La manipulación del argumento de  action: / redirect: / redirectAction: con una entrada desconocida conduce a una condición de desbordamiento de búfer. Esto tiene un impacto en la confidencialidad, integridad y disponibilidad.",
                "reference" => "https://struts.apache.org/docs/s2-016.html\nhttps://web.nvd.nist.gov/view/vuln/detail?vulnId=CVE-2013-2251\nhttp://www.osvdb.org/98445",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Possible ASPROX Download URI Struct June 19 2014",
                "description" => "La actividad muestra tráfico generado por el malware Asprox.\nAxprox es el nombre de una botnet que se encarga de explotar vulnerabilidades usando SQL permitiendo la descarga de software malicioso a través de phishing y el fraude electrónico.\nSe basa principalmente en engañar a usuarios convenciéndolos de acceder a una URL o un documento aparentemente confiable a través de un correo electrónico. \nEl equipo infectado por el malware es utilizado como una red de bots para recolectar las credenciales de inicio de sesión, permitiendo ataques DDoS, ataques de inyección SQL y tráfico de publicidad falsa. ",
                "recommendation" => "Debido a que la principal forma de propagación del malware “KULUOZ” es mediante un archivo adjunto vía correo electrónico, se sugiere examinar los correos y sus archivos adjuntos aun cuando provengan de una fuente conocida. También se recomienda instalar software antivirus  con tecnologías para detección de amenazas en la web, e-mail y archivos de mala reputación así como las distintas variantes del Malware “KULUOZ”.",
                "risk" => "Que el equipo infectado quede comprometido y se vuelva parte de una botnet, para después ser utilizado en actividades ilícitas tales como ataques de tipo DoS o DDoS.",
                "reference" => "http://www.trendmicro.com/vinfo/us/threat-encyclopedia/web-attack/159/asprox-botnet-reemergesin-the-form-of-kuluoz",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Possible Attempt to Get SQL Server Version in URI using SELECT VERSION",
                "description" => "Se detectaron ataques de tipo SQL hacia el sitio web institucional por parte de las direcciones IP reportadas.\nEl ataque consiste en inyectar código SQL ajeno en una consulta ya programada, con el fin de alterar el funcionamiento de la base de datos, a través de los parámetros enviados en una URL. Estas alteraciones podrían producir fuga o modificación de la información en la base de datos.",
                "recommendation" => "Implementar buenas prácticas de programación dentro de las aplicaciones, por ejemplo, validar los datos introducidos por el usuario mediante una lista blanca para caracteres permitidos o utilizar procedimientos almacenados parametrizados.",
                "risk" => "Acceso no autorizado a información sensible contenida en las bases de datos, lo que puede generar un costo, ya sea monetario o en le renombre de la organización afectada.",
                "reference" => "http://sqlandme.com/2011/05/13/how-to-check-sql-server-version/\nhttps://www.owasp.org/index.php/Top_10_2013\nhttps://technet.microsoft.com/en-us/library/ms161953%28v=SQL.105%29.aspx",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Possible CVE-2014-6271 Attempt in Header",
                "description" => "La actividad generada muestra intentos de explotar la vulnerabilidad GNU Bash de Shellshock (CVE 2014 6271) permitiendo a un atacante ejecutar código malicioso de forma remota en un intérprete de comandos Bash.\nLa vulnerabilidad afecta a los modulos “mod_cgi” y “mod_cgid” para los servicios HTTP de Apache Server y en sistemas donde la interfaz /bin/sh es implementada por GNU Bash, como la característica Bypass ForceCommand de OpenSSH.",
                "recommendation" => "Actualizar todos los paquetes de la shell bash a su versión más reciente para corregir el problema.",
                "risk" => "Que una persona o entidad no autorizada se haga con el control del sistema con fines ilícitos, puede haber fuga de información sensible ademsa de la posibilidad de comprometer más equipos en la red local.",
                "reference" => "https://securityblog.redhat.com/2014/09/24/bash-specially-crafted-environment-variables-code-injection-attack/\nhttps://www.alienvault.com/forums/discussion/3311/new-threat-intelligence-content-for-bash-shellshock-cve-2014-6271\nhttps://blogs.akamai.com/2014/09/environment-bashing.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Possible CVE-2014-6271 Attempt in Headers",
                "description" => "Una vulnerabilidad detectada en Septiembre del 2014 que afecta al bash  (Bourne Again Shell) conocido como \"Shellshock\" que permite a los atacantes ejecutar comandos de manera arbitraria mediante una variable ambiental con formato especifico._x000D_\n_x000D_\nLos sistemas comprometidos son aquellos basados en UNIX así como varias versiones de Linux (ubuntu, centos, fedora, etc). La vulnerabilidad permitiría tomar control total del equipo, el robo de información sensible hasta una denegación de servicio (DoS)._x000D_\n_x000D_\nEn la mayoría de los casos se puede observar el siguiente patrón de caracteres en la solicitud \"() [ :;}\".",
                "recommendation" => "Actualizar todos los paquetes de la shell bash a su versión más reciente para corregir el problema.",
                "risk" => "Que una persona o entidad no autorizada se haga con el control del sistema con fines ilícitos, puede haber fuga de información sensible ademsa de la posibilidad de comprometer más equipos en la red local.",
                "reference" => "https://securityblog.redhat.com/2014/09/24/bash-specially-crafted-environment-variables-code-injection-attack/\nhttps://www.alienvault.com/forums/discussion/3311/new-threat-intelligence-content-for-bash-shellshock-cve-2014-6271\nhttps://blogs.akamai.com/2014/09/environment-bashing.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Possible CVE-2014-6271 Attempt in HTTP Cookie",
                "description" => "Una vulnerabilidad detectada en Septiembre del 2014 que afecta al bash (Bourne Again Shell) conocido como \"Shellshock\" que permite a los atacantes ejecutar comandos de manera arbitraria mediante una variable ambiental con formato especifico._x000D_\n_x000D_\nLos sistemas comprometidos son aquellos basados en UNIX así como varias versiones de Linux (ubuntu, centos, fedora, etc). La vulnerabilidad permitiría tomar control total del equipo, el robo de información sensible hasta una denegación de servicio (DoS)._x000D_\n_x000D_\nEn la mayoría de los casos se puede observar el siguiente patrón de caracteres en la solicitud \"() [ :;}\". Más específicamente esta firma nos indica que el intento fue desde una cookie.",
                "recommendation" => "Actualizar todos los paquetes de la shell bash a su versión más reciente para corregir el problema.",
                "risk" => "Que una persona o entidad no autorizada se haga con el control del sistema con fines ilícitos, puede haber fuga de información sensible ademsa de la posibilidad de comprometer más equipos en la red local.",
                "reference" => "https://securityblog.redhat.com/2014/09/24/bash-specially-crafted-environment-variables-code-injection-attack/\nhttps://www.alienvault.com/forums/discussion/3311/new-threat-intelligence-content-for-bash-shellshock-cve-2014-6271\nhttps://blogs.akamai.com/2014/09/environment-bashing.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Possible CVE-2014-6271 Attempt in URI",
                "description" => "Una vulnerabilidad detectada en Septiembre del 2014 que afecta al bash (Bourne Again Shell) conocido como \"Shellshock\" que permite a los atacantes ejecutar comandos de manera arbitraria mediante una variable ambiental con formato especifico._x000D_\n_x000D_\nLos sistemas comprometidos son aquellos basados en UNIX así como varias versiones de Linux (ubuntu, centos, fedora, etc). La vulnerabilidad permitiría tomar control total del equipo, el robo de información sensible hasta una denegación de servicio (DoS)._x000D_\n_x000D_\nEn la mayoría de los casos se puede observar el siguiente patrón de caracteres en la solicitud \"() [ :;}\". Específicamente el código fue encontrado en la solicitud del sitio web, estando contenido en la URI.",
                "recommendation" => "Actualizar todos los paquetes de la shell bash a su versión más reciente para corregir el problema.",
                "risk" => "Que una persona o entidad no autorizada se haga con el control del sistema con fines ilícitos, puede haber fuga de información sensible ademsa de la posibilidad de comprometer más equipos en la red local.",
                "reference" => "https://securityblog.redhat.com/2014/09/24/bash-specially-crafted-environment-variables-code-injection-attack/\nhttps://www.alienvault.com/forums/discussion/3311/new-threat-intelligence-content-for-bash-shellshock-cve-2014-6271\nhttps://blogs.akamai.com/2014/09/environment-bashing.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Possible Kelihos .eu CnC Domain Generation Algorithm (DGA) Lookup NXDOMAIN Response",
                "description" => "Kelihos es el nombre de una botnet que utiliza comunicaciones de tipo P2P, dificultando de esta forma la detección de los centros de control. Algunas de sus funciones son ataques de Denegación de Servicio (DoS), Spam o envío masivo de correos electrónicos, robo y minería de Bitcoin._x000D_\nEn lugar de tener en el código los dominios a los que se comunican los nodos, la botnet incorpora un algoritmo DGA (Algoritmo de Generación de Dominios), mediante el cual se generan periódicamente gran cantidad de dominios con base a ciertos criterios, llegando incluso a más de 1.000 dominios diarios. De este modo, el malware comprueba si esos dominios son accesibles, y en el caso de serlo, se conecta a ellos con el fin de recibir actualizaciones o instrucciones._x000D_",
                "recommendation" => "Mantener tanto el sistema operativo como las aplicaciones instaladas en el equipo totalmente actualizadas.\nUtilizar antivirus que se encuentren siempre actualizados\nImplementar un servidor “sinkhole DNS” que permita redirigir, analizar y descartar tráfico malicioso.",
                "risk" => "Que el equipo infectado quede comprometido y se vuelva parte de una botnet, para después ser utilizado en actividades ilícitas tales como ataques de tipo DoS o DDoS.",
                "reference" => "http://www.secureworks.com/cyber-threat-intelligence/threats/waledac_kelihos_botnet_takeover/\nhttp://www.sans.org/reading-room/whitepapers/dns/dns-sinkhole-33523",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Possible MySQL SQLi Attempt Information Schema Access",
                "description" => "Un Schema describe la estructura de una base de datos. En una base de datos relacional, el esquema define sus tablas, sus campos en cada tabla y las relaciones entre cada campo y cada tabla. _x000D_\nMySQL proporciona información del esquema de las bases de datos por medio de la tabla de sistema “INFORMATION_SCHEMA”. De tal forma que si se realizan consultas utilizando dicha tabla, se pueden obtener y averiguar el nombre de todas las tablas, así como de su estructura._x000D_",
                "recommendation" => "Implementar buenas prácticas de programación dentro de las aplicaciones, por ejemplo, validar los datos introducidos por el usuario mediante una lista blanca para caracteres permitidos o utilizar procedimientos almacenados parametrizados.",
                "risk" => "Acceso no autorizado a información sensible contenida en las bases de datos, lo que puede generar un costo, ya sea monetario o en le renombre de la organización afectada.",
                "reference" => "http://sqlandme.com/2011/05/13/how-to-check-sql-server-version/\nhttps://www.owasp.org/index.php/Top_10_2013\nhttps://technet.microsoft.com/en-us/library/ms161953%28v=SQL.105%29.aspx",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Possible SQL Injection Attempt SELECT FROM",
                "description" => "El ataque de SQL injection consiste en inyectar código SQL ajeno en una consulta ya programada, con el fin de alterar el funcionamiento de la base de datos. Estas alteraciones podrían producir fuga, modificación o pérdida de la información en la base de datos_x000D_.\nEl proceso de inyección consiste en finalizar prematuramente una cadena de texto y anexar un nuevo comando (dañino), el atacante pone fin a la cadena inyectada con una marca de comentario \"--\", de tal forma que el texto situado a continuación se omite en tiempo de ejecución.",
                "recommendation" => "Implementar buenas prácticas de programación dentro de las aplicaciones, por ejemplo, validar los datos introducidos por el usuario mediante una lista blanca para caracteres permitidos o utilizar procedimientos almacenados parametrizados.",
                "risk" => "Acceso no autorizado a información sensible contenida en las bases de datos, lo que puede generar un costo, ya sea monetario o en le renombre de la organización afectada.",
                "reference" => "http://sqlandme.com/2011/05/13/how-to-check-sql-server-version/\nhttps://www.owasp.org/index.php/Top_10_2013\nhttps://technet.microsoft.com/en-us/library/ms161953%28v=SQL.105%29.aspx",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Possible SQL Injection Attempt UNION SELECT",
                "description" => "El ataque de SQL injection consiste en inyectar código SQL ajeno en una consulta ya programada, con el fin de alterar el funcionamiento de la base de datos. Estas alteraciones podrían producir fuga, modificación o pérdida de la información en la base de datos_x000D_.\nEl proceso de inyección consiste en finalizar prematuramente una cadena de texto y anexar un nuevo comando (dañino), el atacante pone fin a la cadena inyectada con una marca de comentario \"--\", de tal forma que el texto situado a continuación se omite en tiempo de ejecución.",
                "recommendation" => "Implementar buenas prácticas de programación dentro de las aplicaciones, por ejemplo, validar los datos introducidos por el usuario mediante una lista blanca para caracteres permitidos o utilizar procedimientos almacenados parametrizados.",
                "risk" => "Acceso no autorizado a información sensible contenida en las bases de datos, lo que puede generar un costo, ya sea monetario o en le renombre de la organización afectada.",
                "reference" => "http://sqlandme.com/2011/05/13/how-to-check-sql-server-version/\nhttps://www.owasp.org/index.php/Top_10_2013\nhttps://technet.microsoft.com/en-us/library/ms161953%28v=SQL.105%29.aspx",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Possible SSDP Amplification Scan in Progress",
                "description" => "Esta firma se presenta al detectar escaneos a través del puerto 1900, el cual es empleado por el protocolo SSDP (Simple Service Discovery Protocol)._x000D_\nSSDP es un protocolo que sirve para ver los dispositivos conectados en una red y de este modo descubrir dispositivos de servicios como impresoras y servidores. _x000D_\n_x000D_\nNormalmente este tipo de escaneos buscan alguna vulnerabilidad ya conocida y así obtener acceso no autorizado al sistema. Esto con la finalidad de descubrir vulnerabilidades que puedan poner en peligro al equipo y a la institución.\n\n",
                "recommendation" => "Implementar un servidor “sinkhole DNS” que permita redirigir, analizar y descartar tráfico malicioso.",
                "risk" => "Al ser un ataque DDoS puede provocar pérdida de conectividad causada por inundar una red con tráfico UDP, lo que puede generar sobrecarga de los activos computacionales de la red objetivo.",
                "reference" => "https://ssdpscan.shadowserver.org/\n\nhttp://ordenador.wingwit.com/Redes/other-computer-networking/77235.html#.VZ9WG7xVK1G",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Possible Web Crawl - libwww-perl User Agent",
                "description" => "La actividad sospechosa identificada por la firma, corresponde a la detección de carga de WebShell de forma arbitraria hacia el servidor web, intentando explotar una vulnerabilidad a través del módulo \"ofc_upload_image.php\" para la plataforma Joomla._x000D_\nDicha vulnerabilidad permite al atacante subir cualquier tipo de archivo sin que el servidor valide el formato del mismo; esto conlleva a que usuarios malintencionados puedan subir archivos maliciosos, además de poder realizar ataques de forma automática mediante algún script, poniendo en riesgo la integridad del equipo en cuestión._x000D_\n_x000D_\n\n",
                "recommendation" => "Crear el archivo “robots.txt” y agregar en el las reglas necesarias para bloquear cualquier actividad generada por esta herramienta.\nImplementar un Firewall para aplicaciones Web (WAF).Si se cuenta con un sistema operativo Linux y con la herramienta iptables agregar la regla correspondiente:\n    iptables -A INPUT -m string --string 'cadena’ --algo bm -j LOG",
                "risk" => "La pérdida de información importante o sensible debido a actividades realizadas con estas herramientas en manos de un programador muy hábil.",
                "reference" => "http://www.robotstxt.org/robotstxt.html\nhttps://www.owasp.org/index.php/Web_Application_Firewall\nhttp://www.gnu.org/software/wget/manual/html_node/Robot-Exclusion.html\nhttp://www.fleiner.com/bots/\nhttp://systemadmin.es/2012/05/filtrado-por-cadenas-con-iptables",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "POSSIBLE Web Crawl using Wget",
                "description" => "Esta firma se presenta al detectar actividad inusual de peticiones de conexión con direcciones IP públicas, las cuales cuentan con antecedente de propagación de código malicioso. En dichas peticiones se puede observar un User-Agent anormal catalogado para su uso de Web Crawler, que son programas diseñados para explorar páginas web en forma automática y obtener diversos datos de dichas páginas web._x000D__x000D_\nLa firma también está en relación con la detección de Wget, que es una herramienta que permite la descarga de contenidos desde servidores web de una forma simple. Esta es una vulnerabilidad presentada que se puede utilizar para cambiar el contenido de una página web lo cual pone en peligro al equipo y a la institución.\n_x000D_\n",
                "recommendation" => "Crear el archivo “robots.txt” y agregar en el las reglas necesarias para bloquear cualquier actividad generada por esta herramienta.\nImplementar un Firewall para aplicaciones Web (WAF).Si se cuenta con un sistema operativo Linux y con la herramienta iptables agregar la regla correspondiente:\n    iptables -A INPUT -m string --string 'cadena’ --algo bm -j LOG",
                "risk" => "La pérdida de información importante o sensible debido a actividades realizadas con estas herramientas en manos de un programador muy hábil.",
                "reference" => "http://www.webuseragents.com/ua/624698/wget-1-11-4-red-hat-modified\n\nhttp://tejedoresdelweb.com/w/%C2%BFQu%C3%A9_es_un_crawler_o_spider%3F\n\nhttp://www.iss.net/security_center/reference/vuln/HTTP_testcgi.htm",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Possible WP CuckooTap Arbitrary File Download",
                "description" => "La actividad detectada por la firma corresponde a la localización de intento de explotación de una vulnerabilidad del complemento Slider Revolution para la plataforma WordPress._x000D_\n_x000D_\nEsta vulnerabilidad es conocida como Local File Inclusion (LFI) que permite acceder, ver y descargar cualquier archivo en el servidor web a través del complemento antes mencionado. Lo cual puede ser utilizado para robar las credenciales de la base de datos, comprometiendo el sitio web a través de esta misma._x000D_\n_x000D_\n\n",
                "recommendation" => "Validar que tanto la plataforma WordPress, así como todos sus componentes se encuentren en su versión más actual. De no ser así, actualizarlos.\nImplementar una aplicación WAF (Web Application Firewall) con la que se pueden identificar y bloquear ataques a servidores web.",
                "risk" => "Que el equipo sea utilizado para fines maliciosos e incluso ilícitos por parte de una persona no autorizada.",
                "reference" => "http://blog.sucuri.net/2014/09/slider-revolution-plugin-critical-vulnerability-being-exploited.html\n\nhttps://github.com/googleinurl/Wordpress-A.F.D-Verification/blob/master/README.md",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Possible ZyXELs ZynOS Configuration Download Attempt (Contains Passwords)",
                "description" => "Esta firma se presenta al detectar actividad inusual de peticiones de conexión, dichas peticiones buscan explotar una vulnerabilidad conocida en el sistema operativo ZyNOS, el cual es utilizado por algunos fabricantes de routers y módems. La vulnerabilidad consiste en poder descargar la configuración sin autenticación.\n_x000D_La configuración se encuentra localizada en la interfaz web en: “IP/rom-0”.  El cual es un archivo binario que contiene la contraseña de administrador, el cual se encuentra comprimido en formato LZW (Lempel-Ziv-Welch).  Esta vulnerabilidad podría poner en riesgo la seguridad del equipo permitiendo acceso al equipo sin autorización, fuga de información e incluso acceso a diversos recursos en la red.            \n_x000D__x000D_\n\n",
                "recommendation" => "Redirigir el tráfico dirigido al puerto 80 del router a una dirección IP sin uso dentro de nuestra red.\nConectarse mediante SSH o telnet a la interfaz de líneas de comando (CLI) del router para agregar modificar la configuración. ",
                "risk" => "Que la persona o entidad atacante obtenga control total sobre el dispositivo permitiéndole conocer todas las contraseñas y configuraciones contenidas en el, lo que le permitiría tener acceso a toda la red local.",
                "reference" => "http://www.team-cymru.com/ReadingRoom/Whitepapers/2013/TeamCymruSOHOPharming.pdf\n\nhttp://www.scmagazine.com/attackers-alter-dns-configurations-remotely-compromise-300k-routers/article/336792/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Potential SSH Scan",
                "description" => "_x000D_SSH es una herramienta que sirve para acceder de forma remota a un equipo a través de una red, dicho programa trabaja por el puerto 22 permitiendo manejar el equipo mediante consola, esta herramienta está diseñada para registrarse remotamente a otros sistemas a través de la shell de comandos, tales como telnet o ssh. Regularmente la herramienta SSH llega a ser expuesta a ataques haciendo los servicios vulnerables a los intrusos._x000D_\nUno de los principales objetivos de escaneos es identificar la versión que se encuentre instalada, esto es buscar algún exploit y con ello poder conseguir el acceso no autorizado al servicio, haciendo que el equipo al que se esté atacando sea vulnerable y el atacante tenga acceso total del equipo.\n\n\n",
                "recommendation" => "Establecer una política de contraseñas seguras, pero preferentemente evitar el uso de contraseñas y en su lugar utilizar autenticación por criptografía asimétrica (llaves públicas y privadas), con esta última opción también se recomienda incrementar el tamaño de las llaves a 1024 o 2048 bits. Deshabilitar la compatibilidad con el protocolo SSH1 debido a vulnerabilidades conocidas en el mismo. Deshabilitar la compatibilidad con el protocolo SSH1 debido a vulnerabilidades conocidas en el mismo. Restringir el acceso como usuario “root” utilizando la opción “sin password” lo que fuerza a tener una llave para poder utilizar los privilegios de root. Proteger el servicio SSH mediante un firewall para bloquear el acceso a direcciones IP no autorizadas, en caso de no contar con un firewall se puede utilizar la herramienta Iptables para lograr el mismo fin.  Restringir los usuarios que pueden conectarse por SSH mediante la directiva “AllowUsers”",
                "risk" => "Acceso no autorizado al sistema comprometiendo el equipo y toda la información sensible contenida en él.",
                "reference" => "http://www.gb.nrao.edu/pubcomputing/redhatELWS4/RH-DOCS/rhel-rg-es-4/ch-ssh.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Potential VNC Scan 5800-5820",
                "description" => "VNC está basado en una estructura cliente/servidor y es un software que sirve para acceder de forma remota a un equipo a través de una red, dicho software tiene destinado cierto número de puertos entre los que se encuentran, son los puertos 5800 al 5820 y es un protocolo TCP._x000D_\n_x000D_Normalmente este tipo de escaneos tiene como objetivo identificar la versión del servicio VNC instalado, para posteriormente buscar algún exploit o vulnerabilidad para conseguir acceso no autorizado al servicio, lo que conlleva a que el atacante tenga control total sobre el equipo._x000D_\n\n\n",
                "recommendation" => "Verificar si el uso de la aplicación VNC está permitida de acuerdo a las políticas de la institución, en caso de no ser así se recomienda su eliminación.\nVerificar si el servicio VNC está habilitado, de no ser así, se recomienda cerrar los puertos 5800 – 5820 y 5900 - 5920. Si el equipo cuenta con un sistema operativo Windows, bloquear el puerto en el firewall de Windows.\nSi el servicio está en uso, mantener el software VNC actualizado.\nCrear listas de acceso para tener un mayor control sobre quiénes pueden acceder al equipo haciendo uso del software VNC.",
                "risk" => "Acceso no autorizado al sistema comprometiendo el equipo y toda la información sensible contenida en él.",
                "reference" => "https://www.realvnc.com/\n\nhttp://www.vermiip.es/puertos/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Potential VNC Scan 5900-5920",
                "description" => "VNC está basado en una estructura cliente/servidor y es un software que sirve para acceder de forma remota a un equipo a través de una red, dicho software tiene destinado cierto número de puertos entre los que se encuentran, son los puertos 5900 al 5920 y es un protocolo TCP._x000D_\n_x000D_Normalmente este tipo de escaneos tiene como objetivo identificar la versión del servicio VNC instalado, para posteriormente buscar algún exploit o vulnerabilidad para conseguir acceso no autorizado al servicio, lo que conlleva a que el atacante tenga control total sobre el equipo._x000D_\n\n",
                "recommendation" => "Verificar si el uso de la aplicación VNC está permitida de acuerdo a las políticas de la institución, en caso de no ser así se recomienda su eliminación.\nVerificar si el servicio VNC está habilitado, de no ser así, se recomienda cerrar los puertos 5800 – 5820 y 5900 - 5920. Si el equipo cuenta con un sistema operativo Windows, bloquear el puerto en el firewall de Windows.\nSi el servicio está en uso, mantener el software VNC actualizado.\nCrear listas de acceso para tener un mayor control sobre quiénes pueden acceder al equipo haciendo uso del software VNC.",
                "risk" => "Acceso no autorizado al sistema comprometiendo el equipo y toda la información sensible contenida en él.",
                "reference" => "https://www.realvnc.com/\n\nhttp://www.vermiip.es/puertos/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "PUP Win32/ELEX Checkin",
                "description" => "\"_x000D_Elex\" es una detección especifica utilizado por Malware el cual está catalogado como PUP (programa potencialmente no deseado), este tipo de Malware se encarga de realizar actividades maliciosas dentro del equipo, entre las que se encuentra la modificación del navegador web el cual redirecciona todas las búsquedas necesarias a los sitios inseguros y cuestionables_x000D_._x000D_\nEste tipo de aplicaciones suelen instalarse en el equipo por medio de programas de dudosa procedencia, haciéndolo invisible para el usuario, afectando el funcionamiento del equipo._x000D_\n\n\n",
                "recommendation" => "Verificar si se encuentra en el Adware Win32/ELEX, en caso de ser así, desinstalarlo\nEliminar los complementos de los navegadores web relacionados con el Adware Win32/Elex\nRealizar un análisis completo del sistema con un software antivirus actualizado, para descartar la presencia de malware.",
                "risk" => "Un equipo infectado con malware brinda la oportunidad al atacante de recolectar y usar o vender información personal de la víctima a otros hackers, enviar spam o infectar  otras máquinas con Adware bajo pedido de empresas de publicidad fraudulentas, extorsión, robo de identidad, etc.",
                "reference" => "http://www.malwareremovalguides.info/pup-optional-elex-removal-instructions/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "PUP.Win32.BoBrowser User-Agent (BoBrowser)",
                "description" => "BoBrowser se describe como una aplicación, la cual llega a tener características útiles, prpoporciona un antivirus gratuito, aumento de velocidad de descargas. Este programa trabaja como un complemento que se puede añadir a los navegadores web, aunque la aplicación se describe como un programa útil llega a ser lo contrario ya que esta catalogado como PUP (programa potencialmente no deseado), este tipo de Malware se encarga de realizar actividades maliciosas dentro del equipo, entre las que se encuentra la modificación del navegador web el cual redirecciona todas las búsquedas necesarias a los sitios inseguros y cuestionables.\nEste tipo de aplicaciones suelen instalarse en el equipo por medio de programas de dudosa procedencia, haciéndolo invisible para el usuario, afectando el funcionamiento del equipo._x000D_\n\n",
                "recommendation" => "Detener los siguientes procesos y borrar los archivos correspondientes: \"bobrowser.exe\", \"chrome_elf.dll\" y \"extension_list.json\"\nEliminar la siguiente carpeta: C:\\users\\user\\appdata\\Local\\BoBrowser\\\nDesinstalar BoBrowser del equipo mediante la opción “Desinstalar programa” dentro del Panel de Control.\nEliminar los complementos no deseados de los navegadores web.",
                "risk" => "Un equipo infectado con malware brinda la oportunidad al atacante de recolectar y usar o vender información personal de la víctima a otros hackers, enviar spam o infectar  otras máquinas con Adware bajo pedido de empresas de publicidad fraudulentas, extorsión, robo de identidad, etc.",
                "reference" => "http://losvirus.es/bobrowser/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "PUP.Win32.BoBrowser User-Agent (LogEvents)",
                "description" => "Esta firma se presenta debido a la detección de un agente web relacionado con el adware BoBrowser, el cual es un adware o software agregado como complemento en un navegador web, la firma se detecta debido la lectura de registros de actividad web.\n\n\n",
                "recommendation" => "Detener los siguientes procesos y borrar los archivos correspondientes: \"bobrowser.exe\", \"chrome_elf.dll\" y \"extension_list.json\"\nEliminar la siguiente carpeta: C:\\users\\user\\appdata\\Local\\BoBrowser\\\nDesinstalar BoBrowser del equipo mediante la opción “Desinstalar programa” dentro del Panel de Control.\nEliminar los complementos no deseados de los navegadores web.",
                "risk" => "Un equipo infectado con malware brinda la oportunidad al atacante de recolectar y usar o vender información personal de la víctima a otros hackers, enviar spam o infectar  otras máquinas con Adware bajo pedido de empresas de publicidad fraudulentas, extorsión, robo de identidad, etc.",
                "reference" => "http://malwaretips.com/blogs/remove-bobrowser-virus/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "PUP.Win32.BoBrowser User-Agent (VersionDwl)",
                "description" => "Esta firma se presenta debido a la detección de un agente web relacionado con el adware BoBrowser, el cual es un adware o software agregado como complemento en un navegador web, la firma se detecta debido al registro de una descarga o actualización del complemento instalado o por instalar en el navegador.\n\n\n",
                "recommendation" => "Detener los siguientes procesos y borrar los archivos correspondientes: \"bobrowser.exe\", \"chrome_elf.dll\" y \"extension_list.json\"\nEliminar la siguiente carpeta: C:\\users\\user\\appdata\\Local\\BoBrowser\\\nDesinstalar BoBrowser del equipo mediante la opción “Desinstalar programa” dentro del Panel de Control.\nEliminar los complementos no deseados de los navegadores web.",
                "risk" => "Un equipo infectado con malware brinda la oportunidad al atacante de recolectar y usar o vender información personal de la víctima a otros hackers, enviar spam o infectar  otras máquinas con Adware bajo pedido de empresas de publicidad fraudulentas, extorsión, robo de identidad, etc.",
                "reference" => "http://www.securitystronghold.com/gates/remove-bobrowser.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Python-urllib/ Suspicious User Agent",
                "description" => "Esta firma se presenta debido a la existencia de un agente web reconocido en la libreria urllib del lenguaje de programacion Python, ésta permite manipular objetos en la web mediante diversos métodos para le recopilación de información de un sitio, esta actividad es usualmente relacionada con crawlers.\n\n\n",
                "recommendation" => "Crear el archivo “robots.txt” y agregar en el las reglas necesarias para bloquear cualquier actividad generada por esta herramienta.\nImplementar un Firewall para aplicaciones Web (WAF).Si se cuenta con un sistema operativo Linux y con la herramienta iptables agregar la regla correspondiente:\n    iptables -A INPUT -m string --string 'cadena’ --algo bm -j LOG",
                "risk" => "La pérdida de información importante o sensible debido a actividades realizadas con estas herramientas en manos de un programador muy hábil.",
                "reference" => "http://www.robotstxt.org/robotstxt.html\nhttps://www.owasp.org/index.php/Web_Application_Firewall\nhttp://www.gnu.org/software/wget/manual/html_node/Robot-Exclusion.html\nhttp://www.fleiner.com/bots/\nhttp://systemadmin.es/2012/05/filtrado-por-cadenas-con-iptables",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Query for a known malware domain (sektori.org)",
                "description" => "Esta firma se presenta debido a la detección de consultas pertenecientes a un dominio malicioso, identificado como parte de una o más botnets, intentando comunicarse hacia nuestra red interna.\n\n",
                "recommendation" => "Analizar el equipo para descartar la presencia de malware que genere está actividad.\nBloquear el acceso a sitios mediante el archivo hosts del equipo, esto puede variar si el sistema operativo se trata de Windows o de una distribución Linux.\nSi se cuenta con un servidor de filtrado de contenido agregar la regla necesaria para filtrar estos sitios.",
                "risk" => "Infección por malware, lo que compromete la seguridad del equipo y los datos contenidos en él.",
                "reference" => "http://www.todoprogramas.com/trucos/linux/comobloquearunsitiowebnodeseadoenubuntulinux/\nhttp://norfipc.com/articulos/como-bloquear-impedir-acceso-paginas-sitios-web-internet.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Query to Known CnC Domain msnsolution.nicaze.net",
                "description" => "Esta firma se presenta debido a la detección de consultas pertenecientes hacia un dominio malicioso, identificado como parte del gusano \"Yimfoca\" al intentar resolver a este dominio, busca realizar la descarga de más archivos maliciosos o propagarse.\n\n",
                "recommendation" => "Analizar el equipo para descartar la presencia de malware que genere está actividad.\nBloquear el acceso a sitios mediante el archivo hosts del equipo, esto puede variar si el sistema operativo se trata de Windows o de una distribución Linux.\nSi se cuenta con un servidor de filtrado de contenido agregar la regla necesaria para filtrar estos sitios.",
                "risk" => "Infección por malware, lo que compromete la seguridad del equipo y los datos contenidos en él.",
                "reference" => "https://www.symantec.com/security_response/writeup.jsp?docid=2010-120315-2926-99&tabid=2",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Zeus GameOver Possible DGA NXDOMAIN Responses",
                "description" => "ZeuS Gameover es una variante del troyano original ZeuS, una de sus características más peculiares es que se basa en una botnet punto a punto, de tal forma que elimina la necesidad de un servidor Command & Control centralizado. Adicionalmente implementa un algoritmo DGA (Domain Generation Algorithm) que genera dominios como los siguientes en caso de no poder alcanzar los nodos de la red:\n_x000D_•    lhcemrwpfllnlblfevkjf.com_x000D_\n•    buzptsuoyhnrqdyprohqozsl.ru_x000D_\n•    cqheuowcjnaixeuzlcyemsqwpeqrw.com_x000D_\n_x000D_\nCada nodo de la red puede actuar como servidor C&C aunque en realidad ninguno lo es. Los bots son capaces de descargar comandos, archivos de configuración y ejecutables desde otros bots.",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Analizar el equipo de red interna con algún software Antivirus/Antimalware actualizado con las firmas más recientes en búsqueda de posibles infecciones por código malicioso.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Verificar que el equipo de la red interna ejecute únicamente aquellas aplicaciones, procesos, servicios, etc. que sean indispensables para realizar sus tareas asignadas, por lo cual es necesario deshabilitar o desinstalar toda aplicación o configuración que no sea requerida para tales fines.\n*Posterior al análisis de Malware se deberá verificar que el equipo cuente con las últimas actualizaciones proporcionadas por el fabricante. Es necesario realizar regularmente la actualización de las Aplicaciones y Sistema Operativo con la finalidad de mitigar las vulnerabilidades.",
                "risk" => "Robo de información sensible en el equipo afectado.",
                "reference" => "http://www.govcert.admin.ch/blog/2/detecting-and-mitigating-gameover-zeus-goz\nhttp://blog.mindedsecurity.com/2012/09/zeus-gameover-overview.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Radmin Remote Control Session Setup Initiate",
                "description" => "Se detectó el uso de la herramienta Radmin, un software que permite entre otras cosas, compartir archivos, usar un servicio de chat, video llamadas y elcontrol remoto de los equipos de cómputo._x000D_\n_x000D_\nSi este tipo de aplicaciones no se administran de forma adecuada pueden provocar robo de información confidencial, exponer el equipo involucrado a una infección por malware y pérdida de información, además de permitir el acceso sin autorización a los equipos institucionales.",
                "recommendation" => "Validar que el uso de la aplicación se encuentre permitido dentro de la organización.\n  En caso de que se encuentre permitido:\n         Se sugiere implementar una solución VPN y una vez establecida la conexión a la red deseada, solicitar la conexión de escritorio remoto hacia el equipo deseado.\n         Se sugiere configurar la aplicación Radmin de manera correcta para prevenir futuros problemas\n   En caso contrario, desinstalar la aplicación y establecer un control para cuentas de usuario que permita evitar modificaciones en las configuraciones del equipo así como la instalación de aplicaciones no autorizadas.\nRealizar un control de aplicaciones para restringir en lo posible el uso de programas de acceso remoto.",
                "risk" => "Acceso no autorizado al sistema comprometiendo el equipo y toda la información sensible contenida en él.",
                "reference" => "http://www.radmin.com/radmin/security.php\nhttp://windows.microsoft.com/es-MX/windows7/products/features/user-account-control\nhttp://www.linuxtotal.com.mx/index.php?cont=info_admon_008",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Rapid IMAP Connections - Possible Brute Force Attack",
                "description" => "Esta firma se presenta cuando se detecta una serie de conexiones a un equipo por el puerto 143, dicho puerto es usado por el protocolo IMAP (Internet Message Access Protocol) utilizado para la recepción de correos electrónicos desde algún servidor._x000D_\n_x000D_\nEl tráfico se considera sospechoso por ser una cantidad grande de mensajes en un pequeño lapso de tiempo, ataque por fuerza bruta, esto es con el afán de obtener acceso al sistema ya que el puerto 143 puede proporcionar una entrada a los atacantes que les permita tomar control total del equipo involucrado.",
                "recommendation" => "Tras muchos intentos fallidos de inicio de sesión, bloquear la cuenta de tal forma que cuente únicamente con capacidades limitadas.\nImplementar el uso de herramientas como CAPTCHA para prevenir ataques automatizados.\nUtilizar URLs distintas para diferentes bloques de usuarios, de esta forma no tendrán acceso al sitio desde la misma URL\nImplementar algún mecanismo (por ejemplo mediante la herramienta IPtables) que permita controlar el número de conexiones solicitadas en un intervalo de tiempo.",
                "risk" => "Si una persona o entidad atacante logra acceder de forma ilícita al servicio, puede hacer modificaciones no autorizadas, o comprometer la seguridad de la información.",
                "reference" => "http://www.cs.virginia.edu/~csadmin/gen_support/brute_force.php\nhttp://soi57.net/blog/iptables-para-limitar-el-numero-de-conexiones-entrantes/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "RDP connection confirm",
                "description" => "Esta firma salta cuando se detecta el uso del protocolo RDP (Remote Desktop  Protocol), el protocolo de escritorio remoto permite a los usuarios conectarse a un sistema de manera remota a través de una interfaz gráfica y tomar control del mismo. Esto se da gracias a que permite capturar eventos de mouse y de teclado por medio de la conexión establecida._x000D_\n_x000D_\nEste protocolo puede poner en riesgo los equipos involucrados en la comunicación, comprometiendo la información contenida en los mismos, ya que si no se cuenta con la seguridad adecuada puede ser blanco de ataques informáticos.",
                "recommendation" => "Verificar si el acceso vía RDP está permitido.\n       Si el acceso vía RDP está permitido, asegurar que en las reglas del firewall sólo se acepten las conexiones desde las direcciones IP que tienen permitido el acceso (whitelist).\n       Habilitar autenticación por SSL/TLS\nVerificar si el servicio de Escritorio Remoto de Windows está activo.\nSi el servicio de Escritorio Remoto no está activo, es recomendable cerrar el puerto 3389 TCP, para evitar futuros incidentes que intenten explotar alguna otra vulnerabilidad del protocolo RDP.",
                "risk" => "Acceso no autorizado al sistema comprometiendo el equipo y toda la información sensible contenida en él.",
                "reference" => "http://www.speedguide.net/port.php?port=3389\nhttps://support.microsoft.com/es-es/kb/186607/es\nhttp://practicasintermedias2012usac.blogspot.mx/2012/11/remote-desktop-protocol.html\nhttp://www.alkia.net/index.php/faqs/106-how-to-secure-remote-desktop-connections-using-tls-ssl-based-authentication",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Request to a Suspicious *.tk domain",
                "description" => "Los dominios .tk corresponden a dominios de la isla Tokelau situada en el pacífico sur.\nEstos dominios han confirmado una fuerte presencia en el mercado que se utiliza para distribuir malware (virus, troyanos, spyware, adware, etc.), se volvieron tan codiciados que ocupan el tercer lugar dentro de los dominios con ataques en países de alto nivel, solamente precedidos por Alemania (.de) y el Reino Unido (.uk).",
                "recommendation" => "Analizar el equipo para descartar la presencia de malware que genere está actividad.\nBloquear el acceso a sitios mediante el archivo hosts del equipo, esto puede variar si el sistema operativo se trata de Windows o de una distribución Linux.\nSi se cuenta con un servidor de filtrado de contenido agregar la regla necesaria para filtrar este tipo de sitios.",
                "risk" => "Infección por malware, lo que compromete la seguridad del equipo y los datos contenidos en él.",
                "reference" => "http://www.todoprogramas.com/trucos/linux/comobloquearunsitiowebnodeseadoenubuntulinux/\nhttp://norfipc.com/articulos/como-bloquear-impedir-acceso-paginas-sitios-web-internet.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "RDP connection request",
                "description" => "Esta firma salta cuando se detecta el uso del protocolo RDP (Remote Desktop  Protocol), el protocolo de escritorio remoto permite a los usuarios conectarse a un sistema de manera remota a través de una interfaz gráfica y tomar control del mismo. Esto se da gracias a que permite capturar eventos de mouse y de teclado por medio de la conexión establecida._x000D_\n_x000D_\nEste protocolo puede poner en riesgo los equipos involucrados en la comunicación, comprometiendo la información contenida en los mismos, ya que si no se cuenta con la seguridad adecuada puede ser blanco de ataques informáticos.",
                "recommendation" => "Verificar si el acceso vía RDP está permitido.\n       Si el acceso vía RDP está permitido, asegurar que en las reglas del firewall sólo se acepten las conexiones desde las direcciones IP que tienen permitido el acceso (whitelist).\n       Habilitar autenticación por SSL/TLS\nVerificar si el servicio de Escritorio Remoto de Windows está activo.\nSi el servicio de Escritorio Remoto no está activo, es recomendable cerrar el puerto 3389 TCP, para evitar futuros incidentes que intenten explotar alguna otra vulnerabilidad del protocolo RDP.",
                "risk" => "Acceso no autorizado al sistema comprometiendo el equipo y toda la información sensible contenida en él.",
                "reference" => "http://www.speedguide.net/port.php?port=3389\nhttps://support.microsoft.com/es-es/kb/186607/es\nhttp://practicasintermedias2012usac.blogspot.mx/2012/11/remote-desktop-protocol.html\nhttp://www.alkia.net/index.php/faqs/106-how-to-secure-remote-desktop-connections-using-tls-ssl-based-authentication",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "RDP disconnect request",
                "description" => "La actividad generada muestra conexiones por parte de las direcciones IP reportadas a través del puerto 3389, dicho puerto está asociado a la aplicación de escritorio remota característica de Windows que se comunica con el protocolo RDP.\nMediante RDP un cliente se puede conectar desde cualquier equipo de forma remota hacia un servidor RDP utilizando comunicación cifrada. \nDejar el puerto 3389 abierto representa un riesgo para el equipo y la organización ya que de ser comprometido por un usuario no autorizado podría causar la fuga de información sensible, además de que este puerto es vulnerable en la propagación de Malware.",
                "recommendation" => "Verificar si el acceso vía RDP está permitido.\n       Si el acceso vía RDP está permitido, asegurar que en las reglas del firewall sólo se acepten las conexiones desde las direcciones IP que tienen permitido el acceso (whitelist).\n       Habilitar autenticación por SSL/TLS\nVerificar si el servicio de Escritorio Remoto de Windows está activo.\nSi el servicio de Escritorio Remoto no está activo, es recomendable cerrar el puerto 3389 TCP, para evitar futuros incidentes que intenten explotar alguna otra vulnerabilidad del protocolo RDP.",
                "risk" => "Acceso no autorizado al sistema comprometiendo el equipo y toda la información sensible contenida en él.",
                "reference" => "http://www.speedguide.net/port.php?port=3389\nhttps://support.microsoft.com/es-es/kb/186607/es\nhttp://practicasintermedias2012usac.blogspot.mx/2012/11/remote-desktop-protocol.html\nhttp://www.alkia.net/index.php/faqs/106-how-to-secure-remote-desktop-connections-using-tls-ssl-based-authentication",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Rebate Informer User-Agent (REBATEINF)",
                "description" => "Se detectó diversas peticiones por parte de las direcciones IP reportadas hacia los sitios web asociados con las direcciones IP públicas reportadas, en dichas peticiones se identificó la cabecera User-Agent “REBATEINF”.\nRebateinf es un Adware conocido como un pregrama potencialmente no deseado (PUP por sus siglas en inglés), ya que modifica la configuración de los navegadores web, recopila los hábitos de navegación del usuario, muestra publicidad e instala alguna barra de tareas en los navegadores.\nRebateinf se propaga a través de la instalación de algún software gratuito pirata.",
                "recommendation" => "Eliminar el plugin:\n    Para el navegador  Mozilla Firefox ir a: \n          Herramientas / Complementos / Extensiones  y eliminar el complemento.\n           Para el navegador  Internet Explorer ir a:\n           Herramientas/Administrarcomplementos/Barrasdeherramientas/extensiones y eliminar el complemento.\n  Para el navegador Google Chrome:\n     Ir a al menú de Herramientas / Extensiones y eliminar el complemento [4].\nAnalizar el equipo con un software Antivirus completamente actualizado para descartar algún malware en el equipo por el uso de dicho plugin.",
                "risk" => "Un equipo infectado con malware brinda la oportunidad al atacante de recolectar y usar o vender información personal de la víctima a otros hackers, enviar spam o infectar  otras máquinas con Adware bajo pedido de empresas de publicidad fraudulentas, extorsión, robo de identidad, etc.",
                "reference" => "http://www.herdprotect.com/rebatei.dllc2baf6aaf56673907ccbb280477a27931a776604.aspx\nhttp://www.shouldiblockit.com/rebateinf.exe-3011.aspx",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "RelevantKnowledge Adware CnC Beacon",
                "description" => "RelevantKnowledge es considerado como un Adware, usualmente se instala sin consentimiento del usuario a través de algún otro software o consultas a páginas potencialmente maliciosas.\nRegistra la actividad generada por el usuario a través de los navegadores web, dicha actividad es enviada a un servidor remoto que posteriormente será utilizada con el propósito de marketing, generando publicidad y aumentando la posibilidad de infección por malware.",
                "recommendation" => "Buscar y desinstalar Relevant Knowledge desde la opción “desinstalar programas” dentro del panel de control:\nReiniciar el equipo y eliminar cualquier rastro del malware eliminando la  carpeta “C:\\Program Files\\RelevantKnowledge\\“ de forma manual, puede ser necesario detener el servicio (rlvknlg.exe) antes de borrar la carpeta\nRealizar un análisis completo del sistema con un software antivirus actualizado, para descartar la presencia de malware.\nArchivos asociados:\n\nC:\\Program Files\\RelevantKnowledge\\nscf.dat\nC:\\Program Files\\RelevantKnowledge\\rlls64.dll\nC:\\Program Files\\RelevantKnowledge\\rlls.dll\nC:\\Program Files\\RelevantKnowledge\\rloci.bin\nC:\\Program Files\\RelevantKnowledge\\rlservice.exe\nC:\\Program Files\\RelevantKnowledge\\rlvknlg64.exe\nC:\\Program Files\\RelevantKnowledge\\rlvknlg.exe\n\nClaves de registro asociadas:\n\nHKEY_CURRENT_USER\\Software\\Microsoft\\Windows\\CurrentVersion\\Explorer\\MenuOrder\\Start Menu\\Programs\\RelevantKnowledge\nHKEY_LOCAL_MACHINE\\SOFTWARE\\Microsoft\\Windows\\CurrentVersion\\Run \"RelevantKnowledge\" \nHKEY_CURRENT_USER\\Software\\Microsoft\\Windows\\CurrentVersion\\RunOnce \"OSSProxy\" rlvknlg.exe\nHKEY_CURRENT_USER\\Software\\Microsoft\\Windows\\ShellNoRoam\\MUICache Data \"RelevantKnowledge\"\nHKEY_LOCAL_MACHINE\\SOFTWARE\\Microsoft\\Windows\\CurrentVersion\\Uninstall\\[d08d9f98-1c78-4704-87e6-368b0023d831}\nHKEY_LOCAL_MACHINE\\SYSTEM\\ControlSet001\\Services\\SharedAccess\\Parameters\\FirewallPolicy\\StandardProfile\\AuthorizedApplications\\List \"c:\\program files\\relevantknowledge\\rlvknlg.exe:*:Enabled:rlvknlg.exe\"",
                "risk" => "Un equipo infectado con malware brinda la oportunidad al atacante de recolectar y usar o vender información personal de la víctima a otros hackers, enviar spam o infectar  otras máquinas con Adware bajo pedido de empresas de publicidad fraudulentas, extorsión, robo de identidad, etc.",
                "reference" => "http://deletemalware.blogspot.mx/2011/04/remove-relevant-knowledge-uninstall.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "request to .xxx TLD",
                "description" => "La actividad generada muestra peticiones por parte de la dirección IP local reportada, hacia dominios identificados con contendido para adulto (xxx), por lo que dicha actividad implica una violación a las políticas de seguridad de la institución, ya que este tipo de sitios usualmente son foco de distribución de malware.",
                "recommendation" => "Bloquear el acceso a sitios mediante el archivo hosts del equipo, esto puede variar si el sistema operativo se trata de Windows o de una distribución Linux.\nSi se cuenta con un servidor de filtrado de contenido agregar la regla necesaria para filtrar este tipo de sitios.",
                "risk" => "Infección por malware, lo que compromete la seguridad del equipo y los datos contenidos en él.",
                "reference" => "http://www.todoprogramas.com/trucos/linux/comobloquearunsitiowebnodeseadoenubuntulinux/\nhttp://norfipc.com/articulos/como-bloquear-impedir-acceso-paginas-sitios-web-internet.html\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Sality Fake Opera User Agent",
                "description" => "W32.Sality es un Malware que afecta diversas versiones del sistema operativo Windows. Su función es infectar archivos ejecutables en dispositivos locales, compartidos y extraíbles. _x000D_\n_x000D_\nDicho virus también crea una botnet punto a punto (P2P) y recibe la URL para iniciar la descarga de archivos adicionales, al final intentará deshabilitar cualquier software de seguridad presente en el equipo._x000D_\n_x000D_Además, este virus también busca claves específicas del registro de Windows para infectar los archivos que se ejecutan cuando inicia el sistema operativo, reemplazando el código original de los archivos infectados por una copia cifrada del código viral.",
                "recommendation" => " Eliminar el archivo\n    wmdrtc32.dll\nRealizar un análisis completo con un software antivirus actualizado, para eliminar rastros del malware o variantes del mismo.",
                "risk" => "Un equipo infectado con malware brinda la oportunidad al atacante de recolectar y usar o vender información personal de la víctima a otros hackers, enviar spam o infectar  otras máquinas con Adware bajo pedido de empresas de publicidad fraudulentas, extorsión, robo de identidad, etc.",
                "reference" => "http://www.securitystronghold.com/gates/win32.sality.html\nhttp://www.symantec.com/security_response/writeup.jsp?docid=2006-011714-3948-99&tabid=2",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "SCAN Behavioral Unusual Port 139 traffic, Potential Scan or Infection",
                "description" => "El puerto 139 en un equipo generalmente está asociado al protocolo NetBIOS (con sistemas operativos Windows), dicho servicio es utilizado para establecer comunicación entre equipos de una red local lo que brinda la posibilidad de compartir archivos e impresoras._x000D_\n_x000D_Sin embargo, también puede ser utilizado por cualquier otro sistema que utilice el protocolo SMB._x000D_\n_x000D_Debido a esto, muchas veces el puerto 139 se encuentra abierto aunque no esté siendo utilizado, por lo que usualmente es de los primeros puertos a los que un atacante intentará conectarse._x000D_\nSe sabe que existen diversos gusanos que utilizan este puerto como medio de propagación hacia otros equipos en una red, lo que representa un riesgo para la seguridad de los equipos de cómputo involucrados.",
                "recommendation" => "Deshabilitar la función de archivos e impresoras compartidas y bloquear el puerto, de ser necesario este servicio:  \nUtilizar contraseñas seguras\nBloquear el puerto en el router o firewall",
                "risk" => "Un escaneo descubre vulnerabilidades en un sistema que posteriormente pueden ser explotadas y de esta manera comprometer el equipo y la información contenida en él.",
                "reference" => "https://isc.sans.edu//port.html?port=139 \nhttp://www.speedguide.net/port.php?port=139",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "SCAN Multiple MySQL Login Failures, Possible Brute Force Attempt",
                "description" => "MySQL se trata de un manejador de bases de datos. Un exceso de intentos fallidos de inicio de sesión en dicha aplicación puede apuntar a un ataque por fuerza bruta._x000D_\n_x000D_\nLa fuerza bruta es un método de prueba y error utilizado por un atacante mediante el cual intentan obtener información (usualmente nombre de usuario o contraseña) que le otorgue acceso a algún sistema o aplicación.",
                "recommendation" => "Tras muchos intentos fallidos de inicio de sesión, bloquear la cuenta de tal forma que cuente únicamente con capacidades limitadas.\nImplementar el uso de herramientas como CAPTCHA para prevenir ataques automatizados.\nUtilizar URLs distintas para diferentes bloques de usuarios, de esta forma no tendrán acceso al sitio desde la misma URL\nImplementar algún mecanismo (por ejemplo mediante la herramienta IPtables) que permita controlar el número de conexiones solicitadas en un intervalo de tiempo.",
                "risk" => "Si una persona o entidad atacante logra acceder de forma ilícita al servicio, puede hacer modificaciones no autorizadas, o comprometer la seguridad de la información.",
                "reference" => "http://www.cs.virginia.edu/~csadmin/gen_support/brute_force.php\nhttp://soi57.net/blog/iptables-para-limitar-el-numero-de-conexiones-entrantes/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "SCAN Nessus User Agent",
                "description" => "Al detectarse el User-Agent Nessus, indica que se está haciendo uso de la herramienta del mismo nombre._x000D_\nNessus es una herramienta licenciada bajo GPL que permite detectar las vulnerabilidades de un sistema. La principal característica de esta herramienta es que se basa en un modelo cliente/servidor._x000D_\nEl servidor es quien realiza el test de seguridad mientras el cliente puede estar instalado en otra máquina y pedir al servidor que efectúe un test de seguridad en uno o varios equipos._x000D_\nEn operación normal, NESSUS comienza escaneando los puertos con nmap o con su propio escáner de puertos para buscar puertos abiertos y después intentar explotar las vulnerabilidades encontradas.",
                "recommendation" => "Implementar el uso de Firewalls que cuenten con las últimas actualizaciones de su software.\nConfigurar listas de acceso como mínimo en los routers de frontera, para de esta manera conseguir tener control sobre el flujo y tipo de tráfico que hay en la red.\nCerrar los puertos de servicios innecesarios y restringir el acceso en los servidores de su infraestructura a clientes con los User-Agent: \"Nessus\", “WHCC/”, “NMAP”, “Nikto” o “Solarwinds”\nImplementar TCP wrappers donde sea aplicable, lo que brinda la posibilidad de brindar acceso o negar acceso a los servicios con base en direcciones IP o nombres de dominio.\nImplementar el programa Portsentry, el cual se dedica a monitorear los puertos indicados y realizar diversas acciones en caso de detectar alguna anomalía.\nImplementar un firewall para aplicaciones web (WAF).",
                "risk" => "Un escaneo realizado por estas herramientas puede descubrir vulnerabilidades en los servicios u aplicaciones ofrecidas, lo que posteriormente puede ser explotado y de esta manera comprometer el equipo y la información contenida en él.",
                "reference" => "http://www.cisco.com/c/en/us/td/docs/ios/12_2/security/configuration/guide/fsecur_c/scfacls.html\nhttp://www.sans.org/reading-room/whitepapers/auditing/port-scanning-techniques-defense-70\nhttp://www.seguridad.unam.mx/descarga.dsc?arch=506\nhttps://www.owasp.org/index.php/Web_Application_Firewall\nhttps://www.safaribooksonline.com/library/view/network-security-assessment/059600611X/ch04s07.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "SCAN Nikto Web App Scan in Progress",
                "description" => "Se refiere al posible uso del software de escaneo de servidores Nikto. Dicha herramienta se encarga de efectuar diferentes tipos de actividades en los servidores tales como, detección de malas configuraciones y vulnerabilidades, detección de archivos en directorios por defecto, listado de la estructura del servidor, versiones y fechas de actualizaciones, análisis de vulnerabilidades XSS(cross-site-scripting), ataques de fuerza bruta por diccionario, reportes en formatos txt, csv, html, etc.",
                "recommendation" => "Implementar el uso de Firewalls que cuenten con las últimas actualizaciones de su software.\nConfigurar listas de acceso como mínimo en los routers de frontera, para de esta manera conseguir tener control sobre el flujo y tipo de tráfico que hay en la red.\nCerrar los puertos de servicios innecesarios y restringir el acceso en los servidores de su infraestructura a clientes con los User-Agent: \"Nessus\", “WHCC/”, “NMAP”, “Nikto” o “Solarwinds”\nImplementar TCP wrappers donde sea aplicable, lo que brinda la posibilidad de brindar acceso o negar acceso a los servicios con base en direcciones IP o nombres de dominio.\nImplementar el programa Portsentry, el cual se dedica a monitorear los puertos indicados y realizar diversas acciones en caso de detectar alguna anomalía.\nImplementar un firewall para aplicaciones web (WAF).",
                "risk" => "Un escaneo realizado por estas herramientas puede descubrir vulnerabilidades en los servicios u aplicaciones ofrecidas, lo que posteriormente puede ser explotado y de esta manera comprometer el equipo y la información contenida en él.",
                "reference" => "http://www.cisco.com/c/en/us/td/docs/ios/12_2/security/configuration/guide/fsecur_c/scfacls.html\nhttp://www.sans.org/reading-room/whitepapers/auditing/port-scanning-techniques-defense-70\nhttp://www.seguridad.unam.mx/descarga.dsc?arch=506\nhttps://www.owasp.org/index.php/Web_Application_Firewall\nhttps://www.safaribooksonline.com/library/view/network-security-assessment/059600611X/ch04s07.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Sipvicious User-Agent Detected (friendly-scanner)",
                "description" => "La detección de actividad inusual dentro de los equipos de cómputo con respecto a la firma, se puede identificar por emplear como User-Agent a “friendly-scanner”, mismo que se encuentra relacionado con la herramienta SIPVicious, un software empleado para auditar sistemas de VoIP basados en SIP, así como también se emplea para la descarga de malware. Donde dichos escaneos se realizan al puerto 5060._x000D_\nEl puerto 5060 es empleado para el protocolo SIP (Session Initiation Protocol) el cual inicia, modifica y finaliza sesiones interactivas con elementos multimedia. El escaneo puede revelar información acerca del sistema auditado, lo cual puede llevar a la explotación de alguna vulnerabilidad detectada.\n\n\n",
                "recommendation" => "Filtrar los paquetes de todas las peticiones con el User Agent: \"friendly-scanner\", accediendo a la configuración de  iptables y rechazar la comunicación mediante la regla:\niptables -A INPUT -p tcp --dport 80 -m string --algo bm --string friendly-scanner -j DROP\n",
                "risk" => "Explotación de alguna vulnerabilidad detectada, obtención de credenciales del usuario.",
                "reference" => "http://www.speedguide.net/port.php?port=5060\n\nhttp://www.darknet.org.uk/tag/sipvicious/\n\nhttps://www.voztovoice.org/?q=node/100",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Skype User-Agent detected",
                "description" => "La actividad sospechosa identificada por la firma, corresponde al establecimiento de conexiones a través de Skype, el cual utiliza un protocolo de Internet del tipo voz sobre IP (VoIP) el cual hace posible que las señales de voz sean transformadas en paquetes digitales y enviados a través de Internet._x000D_\n_x000D_El uso de este tipo de software de comunicaciones dentro de la organización como el chat ,implica un riesgo de seguridad a la institución, ya que puede provocar la fuga de información sensible y son foco de infección de malware, así como puede incurrir en una violación a las políticas internas por el uso indebido de software ajeno a la institución_x000D_\n_x000D_\n\n",
                "recommendation" => "Validar que el uso de la aplicación Skype se encuentra permitida dentro de la institución, en caso de no estar permitida se sugiere desinstalar la aplicación del equipo.",
                "risk" => "Violación a las políticas de uso de software de la institución.\nFuga de información sensible.\nDisminución de la productividad laboral por parte del usuario.              ",
                "reference" => "http://www.makeuseof.com/tag/3-skype-security-issues/\n\nhttp://www.altusmedia.com.mx/blog/?p=528",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "SCAN NMAP -sA (1)",
                "description" => "Nmap (“Network Mapper”) es una herramienta de código abierto utilizada para realizar auditorías y análisis de redes de datos. Se diseñó para escanear grandes redes de forma muy rápida, aunque también funciona correctamente en equipos individuales._x000D_\nNmap puede brindar distintos tipos de información acerca del objetivo, por ejemplo, resolución inversa de DNS, tipo de dispositivo, el sistema operativo utilizado en el mismo o su dirección MAC._x000D_\nAl utilizar Nmap con los parámetros –sA, se le está indicando que realizará un escaneo en los conjuntos de reglas de un firewall dado, con la finalidad de determinar si realiza un análisis de los paquetes que viajan a través de él y conocer que puertos son filtrados y cuáles no._x000D_",
                "recommendation" => "Implementar el uso de Firewalls que cuenten con las últimas actualizaciones de su software.\nConfigurar listas de acceso como mínimo en los routers de frontera, para de esta manera conseguir tener control sobre el flujo y tipo de tráfico que hay en la red.\nCerrar los puertos de servicios innecesarios y restringir el acceso en los servidores de su infraestructura a clientes con los User-Agent: \"Nessus\", “WHCC/”, “NMAP”, “Nikto” o “Solarwinds”\nImplementar TCP wrappers donde sea aplicable, lo que brinda la posibilidad de brindar acceso o negar acceso a los servicios con base en direcciones IP o nombres de dominio.\nImplementar el programa Portsentry, el cual se dedica a monitorear los puertos indicados y realizar diversas acciones en caso de detectar alguna anomalía.\nImplementar un firewall para aplicaciones web (WAF).",
                "risk" => "Un escaneo realizado por estas herramientas puede descubrir vulnerabilidades en los servicios u aplicaciones ofrecidas, lo que posteriormente puede ser explotado y de esta manera comprometer el equipo y la información contenida en él.",
                "reference" => "http://www.cisco.com/c/en/us/td/docs/ios/12_2/security/configuration/guide/fsecur_c/scfacls.html\nhttp://www.sans.org/reading-room/whitepapers/auditing/port-scanning-techniques-defense-70\nhttp://www.seguridad.unam.mx/descarga.dsc?arch=506\nhttps://www.owasp.org/index.php/Web_Application_Firewall\nhttps://www.safaribooksonline.com/library/view/network-security-assessment/059600611X/ch04s07.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "SCAN nmap TCP",
                "description" => "Nmap (“Network Mapper”) es una herramienta de código abierto utilizada para realizar auditorías y análisis de redes de datos. Se diseñó para escanear grandes redes de forma muy rápida, aunque también funciona correctamente en equipos individuales._x000D_\nNmap puede brindar distintos tipos de información acerca del objetivo, por ejemplo, resolución inversa de DNS, tipo de dispositivo, el sistema operativo utilizado en el mismo o su dirección MAC._x000D_\nEl Protocolo de Control de Transmisión (TCP), es un protocolo utilizado en el trasporte de datos que está orientado a conexión, esto garantiza la entrega de los datos, siendo un protocolo confiable y, con ayuda de CRC, le permite le entrega sin errores del mismo. ",
                "recommendation" => "Implementar el uso de Firewalls que cuenten con las últimas actualizaciones de su software.\nConfigurar listas de acceso como mínimo en los routers de frontera, para de esta manera conseguir tener control sobre el flujo y tipo de tráfico que hay en la red.\nCerrar los puertos de servicios innecesarios y restringir el acceso en los servidores de su infraestructura a clientes con los User-Agent: \"Nessus\", “WHCC/”, “NMAP”, “Nikto” o “Solarwinds”\nImplementar TCP wrappers donde sea aplicable, lo que brinda la posibilidad de brindar acceso o negar acceso a los servicios con base en direcciones IP o nombres de dominio.\nImplementar el programa Portsentry, el cual se dedica a monitorear los puertos indicados y realizar diversas acciones en caso de detectar alguna anomalía.\nImplementar un firewall para aplicaciones web (WAF).",
                "risk" => "Un escaneo realizado por estas herramientas puede descubrir vulnerabilidades en los servicios u aplicaciones ofrecidas, lo que posteriormente puede ser explotado y de esta manera comprometer el equipo y la información contenida en él.",
                "reference" => "http://www.cisco.com/c/en/us/td/docs/ios/12_2/security/configuration/guide/fsecur_c/scfacls.html\nhttp://www.sans.org/reading-room/whitepapers/auditing/port-scanning-techniques-defense-70\nhttp://www.seguridad.unam.mx/descarga.dsc?arch=506\nhttps://www.owasp.org/index.php/Web_Application_Firewall\nhttps://www.safaribooksonline.com/library/view/network-security-assessment/059600611X/ch04s07.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "SCAN Potential SSH Scan",
                "description" => "Se detectó una serie de escaneos hacia el puerto 22 generalmente utilizado por el protocolo SSH, el cual permite el acceso a equipos de manera remota.\nUno de los objetivos de un escaneo, es la identificación de puertos abiertos así como la versión de las aplicaciones que se encuentran utilizando dichos puertos, esto con la finalidad de descubrir vulnerabilidades.\nLos escaneos hacia el puerto 22 pueden llegar a generar una condición de ataque de fuerza bruta para intentar acceder sin autorización poniendo en riesgo la seguridad de los equipos involucrados.\n_x000D_\n",
                "recommendation" => "Implementar el uso de Firewalls que cuenten con las últimas actualizaciones de su software.\nConfigurar listas de acceso como mínimo en los routers de frontera, para de esta manera conseguir tener control sobre el flujo y tipo de tráfico que hay en la red.\nCerrar los puertos de servicios innecesarios y restringir el acceso en los servidores de su infraestructura a clientes con los User-Agent: \"Nessus\", “WHCC/”, “NMAP”, “Nikto” o “Solarwinds”\nImplementar TCP wrappers donde sea aplicable, lo que brinda la posibilidad de brindar acceso o negar acceso a los servicios con base en direcciones IP o nombres de dominio.\nImplementar el programa Portsentry, el cual se dedica a monitorear los puertos indicados y realizar diversas acciones en caso de detectar alguna anomalía.\nImplementar un firewall para aplicaciones web (WAF).",
                "risk" => "Un escaneo realizado por estas herramientas puede descubrir vulnerabilidades en los servicios u aplicaciones ofrecidas, lo que posteriormente puede ser explotado y de esta manera comprometer el equipo y la información contenida en él.",
                "reference" => "http://www.cisco.com/c/en/us/td/docs/ios/12_2/security/configuration/guide/fsecur_c/scfacls.html\nhttp://www.sans.org/reading-room/whitepapers/auditing/port-scanning-techniques-defense-70\nhttp://www.seguridad.unam.mx/descarga.dsc?arch=506\nhttps://www.owasp.org/index.php/Web_Application_Firewall\nhttps://www.safaribooksonline.com/library/view/network-security-assessment/059600611X/ch04s07.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "SCAN Potential SSH Scan OUTBOUND",
                "description" => "Se detectó una serie de escaneos hacia el puerto 22 generalmente utilizado por el protocolo SSH, el cual permite el acceso a equipos de manera remota.\nDichos escaneos fueron realizados desde la red interna lo que implica el uso de herramientas de escaneo desde la red interna o la infección del equipo por algún malware que genere la actividad no deseada.\nUno de los objetivos de un escaneo, es la identificación de puertos abiertos así como la versión de las aplicaciones que se encuentran utilizando dichos puertos, esto con la finalidad de descubrir vulnerabilidades.\n_x000D_\n\n",
                "recommendation" => "Establecer una política de contraseñas seguras, pero preferentemente evitar el uso de contraseñas y en su lugar utilizar autenticación por criptografía asimétrica (llaves públicas y privadas), con esta última opción también se recomienda incrementar el tamaño de las llaves a 1024 o 2048 bits.\n\nDeshabilitar la compatibilidad con el protocolo SSH1 debido a vulnerabilidades conocidas en el mismo.\n\nRestringir el acceso como usuario “root” utilizando la opción “sin password” lo que fuerza a tener una llave para poder utilizar los privilegios de root.\n\nProteger el servicio SSH mediante un firewall para bloquear el acceso a direcciones IP no autorizadas, en caso de no contar con un firewall se puede utilizar la herramienta Iptables para lograr el mismo fin.\n\nRestringir los usuarios que pueden conectarse por SSH mediante la directiva “AllowUsers”",
                "risk" => "Acceso no autorizado al sistema comprometiendo el equipo y toda la información sensible contenida en él.",
                "reference" => "https://www.ietf.org/rfc/rfc4251.txt\n\nhttp://www.ieee-security.org/TC/SPW2013/papers/data/5017a111.pdf\n\nhttp://www.nebrija.es/~cmalagon/seguridad_informatica/Lecturas/2-port_scann1ng_nmap_hxc.pdf\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "SCAN Potential VNC Scan 5900-5920",
                "description" => "Se detectó una serie de escaneos hacia el rango de puerto 5900 a 5920, generalmente estos puertos son utilizados por la aplicación VNC, la cual permite el acceso y control de equipos de manera remota.\nUno de los objetivos de un escaneo, es identificar puertos abiertos así como la versión de las aplicaciones que se encuentran utilizando los puertos, con la finalidad de descubrir vulnerabilidades. En caso de encontrar una vulnerabilidad, un atacante podría obtener acceso al equipo de manera remota sin autorización, pudiendo provocar fuga de información o actividades indebidas que afecten a la red de la institución.\n_x000D_\n\n",
                "recommendation" => "Verificar si el uso de la aplicación VNC está permitida de acuerdo a las políticas de la institución, en caso de no ser así se recomienda su eliminación. \nVerificar si el servicio VNC está habilitado, de no ser así, se recomienda cerrar los puertos 5800 – 5820 y 5900 - 5920. Si el equipo cuenta con un sistema operativo Windows, bloquear el puerto en el firewall de Windows.\n    Abrir el firewall de Windows -> Programas -> Windows firewall con seguridad avanzada -> Regla de entrada, desde aquí se podrá crear la regla para realizar el bloqueo.\nSi el servicio está en uso, mantener el software VNC actualizado.\nCrear listas de acceso para tener un mayor control sobre quiénes pueden acceder al equipo haciendo uso del software VNC.",
                "risk" => "Acceso no autorizado al sistema comprometiendo el equipo y toda la información sensible contenida en él.",
                "reference" => "https://www.realvnc.com/\n\nhttp://www.speedguide.net/port.php?port=5900\n\nhttp://www.nebrija.es/~cmalagon/seguridad_informatica/Lecturas/2-port_scann1ng_nmap_hxc.pdf\n\nhttps://strobe.uwaterloo.ca/~twiki/bin/view/ISTCSS/AttackPort\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "SCAN Sipvicious Scan",
                "description" => "Se detectaron una serie de escaneos hacia el puerto 5060 comúnmente utilizado por el protocolo SIP (Session Initiation Protocol) que se encarga de administrar las sesiones multimedia entre usuarios, por ejemplo mensajería instantánea, juegos en línea, video, audio y principalmente servicios de VoIP.\nSe identificó en las conexiones el uso de Sipvicious, una herramienta usada para auditar sistemas de VoIP basados en SIP. Dicha herramienta puede ser utilizada por un atacante para realizar un escaneo de una red institucional.\nUno de los objetivos de un escaneo, es identificar puertos abiertos así como la versión de las aplicaciones que se encuentran utilizando los puertos, con la finalidad de descubrir vulnerabilidades, esto representa un riesgo, pudiendo obtener las credenciales de inicio de sesión del servidor SIP y tener acceso a dicho servidor pudiendo modificar las configuraciones, provocar fuga de información sensible ó realizar otras acciones que afecten el funcionamiento de la red en general.\n\n\n",
                "recommendation" => "Implementar el uso de Firewalls que cuenten con las últimas actualizaciones de su software.\nConfigurar listas de acceso como mínimo en los routers de frontera, para de esta manera conseguir tener control sobre el flujo y tipo de tráfico que hay en la red.\nCerrar los puertos de servicios innecesarios y restringir el acceso en los servidores de su infraestructura a clientes con los User-Agent:\n   \"Nessus\"\n   “WHCC/”\n   “NMAP”\n   “Nikto”\n   “Solarwinds”\nImplementar TCP wrappers donde sea aplicable, lo que brinda la posibilidad de brindar acceso o negar acceso a los servicios con base en direcciones IP o nombres de dominio.\nImplementar el programa Portsentry, el cual se dedica a monitorear los puertos indicados y realizar diversas acciones en caso de detectar alguna anomalía.\nImplementar un firewall para aplicaciones web (WAF).",
                "risk" => "Un escaneo realizado por estas herramientas puede descubrir vulnerabilidades en los servicios u aplicaciones ofrecidas, lo que posteriormente puede ser explotado y de esta manera comprometer el equipo y la información contenida en él.",
                "reference" => "https://www.sinologic.net/blog/2008-04/aclarando-conceptos-sip-y-voip.html\n\nhttps://technet.microsoft.com/es-es/library/aa998265(v=exchg.150).aspx\n\nhttp://tools.cisco.com/security/center/viewAlert.x?alertId=33141\n\nhttps://www.voztovoice.org/?q=node/100\n\nhttp://serverfault.com/questions/549134/how-can-i-stop-sipvicious-friendly-scanner-from-flooding-my-sip-server",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "SCAN SolarWinds IP scan attempt",
                "description" => null,
                "recommendation" => "Implementar el uso de Firewalls que cuenten con las últimas actualizaciones de su software.\nConfigurar listas de acceso como mínimo en los routers de frontera, para de esta manera conseguir tener control sobre el flujo y tipo de tráfico que hay en la red.\nCerrar los puertos de servicios innecesarios y restringir el acceso en los servidores de su infraestructura a clientes con los User-Agent: \"Nessus\", “WHCC/”, “NMAP”, “Nikto” o “Solarwinds”\nImplementar TCP wrappers donde sea aplicable, lo que brinda la posibilidad de brindar acceso o negar acceso a los servicios con base en direcciones IP o nombres de dominio.\nImplementar el programa Portsentry, el cual se dedica a monitorear los puertos indicados y realizar diversas acciones en caso de detectar alguna anomalía.\nImplementar un firewall para aplicaciones web (WAF).",
                "risk" => "Un escaneo realizado por estas herramientas puede descubrir vulnerabilidades en los servicios u aplicaciones ofrecidas, lo que posteriormente puede ser explotado y de esta manera comprometer el equipo y la información contenida en él.",
                "reference" => "http://www.cisco.com/c/en/us/td/docs/ios/12_2/security/configuration/guide/fsecur_c/scfacls.html\nhttp://www.sans.org/reading-room/whitepapers/auditing/port-scanning-techniques-defense-70\nhttp://www.seguridad.unam.mx/descarga.dsc?arch=506\nhttps://www.owasp.org/index.php/Web_Application_Firewall\nhttps://www.safaribooksonline.com/library/view/network-security-assessment/059600611X/ch04s07.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "SCAN Tomcat Web Application Manager scanning",
                "description" => "Tomcat es un contenedor web con soporte de servlets y JSPs y puede funcionar como servidor web por sí mismo y es un servidor de Internet (especializado en aplicaciones Java) el cual hace a una computadora capaz de almacenar los sitios web que creas (HTML/Java) y enviarlos a las personas que se conecten a él como una página que puedan ver en sus navegadores (Internet Exporer, FireFox, etc.). _x000D_\n_x000D_Al principio se pensaba que el uso de Tomcat fuera de forma autónoma y era sólo recomendable para entornos de desarrollo y entornos con requisitos mínimos de velocidad y gestión de transacciones, y solo se terminó usando como servidor web autónomo en entornos con alto nivel de tráfico y alta disponibilidad._x000D_\n_x000D_\nEste tipo de aplicaciones son usadas con el fin de escanear he identificando la versión que se encuentre instalada esto es buscar algún exploit y con ello poder conseguir el acceso no autorizado al servicio, haciendo que el equipo al que se esté atacando sea vulnerable y el atacante tenga acceso total del equipo. _x000D_\n_x000D_\n\n",
                "recommendation" => "Verificar que el servidor se encuentre en su versión más reciente.\nVerificar si es necesario el acceso al gestor de la aplicación Tomcat o si se está utilizando un método alternativo para administrar las instancias, de ser así se recomienda deshabilitar el gestor.\nSi se utiliza un gestor alternativo, se recomienda utilizar el gestor nativo.\nDe ser necesario el gestor nativo:\n   Limitar el acceso de conexión por direcciones IP conocidas (puede utilizarse el componente RemoteAddrValve o LockOut Realm).\n   Limitar el número de conexiones permitidas.\n   Utilizar contraseñas seguras.\n   Implementar Realms, son métodos de control de acceso a recursos en Tomcat.\n   Modificar los parámetros por defecto del servidor; rutas, puertos, nombre de archivos, etc.",
                "risk" => "Al realizar un escaneo se pueden identificar diversas vulnerabilidades en lo servidores web con Tomcat habilitado que de ser explotadas por entidades maliciosas, puede comprometer los sistemas y la información contenida en ellos.",
                "reference" => "http://www.ajpdsoft.com/modules.php?name=Encyclopedia&op=content&tid=769",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "SCAN WebHack Control Center User-Agent Inbound (WHCC/)",
                "description" => "Web Hack Control Center es una herramienta de escáner de vulnerabilidades de servidores web o evaluación basada GUI. Esta aplicación te da la posibilidad para identificar que existen vulnerabilidades de seguridad en algunos servidores web mediante el escaneo, también puede actuar como un  navegador web principal , así que básicamente esta aplicacion es un escáner y un navegador empaquetada en uno._x000D_\nUno de los principales objetivos de escaneos es identificar la versión que se encuentre instalada, esto es buscar algún exploit y con ello poder conseguir el acceso no autorizado al servicio, haciendo que el equipo al que se esté atacando sea vulnerable y el atacante tenga acceso total del equipo. _x000D_\n",
                "recommendation" => "Implementar el uso de Firewalls que cuenten con las últimas actualizaciones de su software.\nConfigurar listas de acceso como mínimo en los routers de frontera, para de esta manera conseguir tener control sobre el flujo y tipo de tráfico que hay en la red.\nCerrar los puertos de servicios innecesarios y restringir el acceso en los servidores de su infraestructura a clientes con los User-Agent: \"Nessus\", “WHCC/”, “NMAP”, “Nikto” o “Solarwinds”\nImplementar TCP wrappers donde sea aplicable, lo que brinda la posibilidad de brindar acceso o negar acceso a los servicios con base en direcciones IP o nombres de dominio.\nImplementar el programa Portsentry, el cual se dedica a monitorear los puertos indicados y realizar diversas acciones en caso de detectar alguna anomalía.\nImplementar un firewall para aplicaciones web (WAF).",
                "risk" => "Un escaneo realizado por estas herramientas puede descubrir vulnerabilidades en los servicios u aplicaciones ofrecidas, lo que posteriormente puede ser explotado y de esta manera comprometer el equipo y la información contenida en él.",
                "reference" => "http://www.cisco.com/c/en/us/td/docs/ios/12_2/security/configuration/guide/fsecur_c/scfacls.html\nhttp://www.sans.org/reading-room/whitepapers/auditing/port-scanning-techniques-defense-70\nhttp://www.seguridad.unam.mx/descarga.dsc?arch=506\nhttps://www.owasp.org/index.php/Web_Application_Firewall\nhttps://www.safaribooksonline.com/library/view/network-security-assessment/059600611X/ch04s07.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Script tag in URI, Possible Cross Site Scripting Attempt",
                "description" => "Cross site scripting también conocido como XSS, es un tipo de vulnerabilidad en donde las secuencias de comandos son inyectar los sitios web visitados por los usuarios mediante comandos. Cross site scripting son ataques que ocurren cuando un atacante utiliza una aplicación web para enviar código malicioso,  _x000D_generalmente en forma de un script, hacia el usuario que intentará acceder a la página ya vulnerada._x000D_\n_x000D_Los caracteres pueden variar dependiendo el programa o aplicación que se utilice, estos caracteres son usados comúnmente en un lenguaje de programación como puede ser el Javascrip agregando los caracteres necesarios para algún ataque. Normalmente son ataques como es el ataque XSS de aplicaciones web el cual  _x000D_\npermite inyectar páginas web visitados por los usuarios en código Javascrip._x000D_\n\n\n",
                "recommendation" => "Realizar validaciones y codificar cualquier entrada de datos proporcionada por una agente externo a la aplicación mediante formularios, URL, etc.\nImplementar políticas restrictivas o permisivas que ayuden a filtrar los datos enviados hacia la aplicación.\nImplementar una política de contenido seguro.\nImplementar un firewall para aplicaciones web (WAF).",
                "risk" => "Los atacantes pueden ejecutar scipts en el navegador del equipo de la víctima para secuestrar su sesión de usuario, realizar ataques de modificación de contenido (defacement), redireccionar al usuario a sitios maliciosos buscando infectar el equipo con malware, etc.",
                "reference" => "https://www.nsa.gov/ia/_files/factsheets/xss_iad_factsheet_final_web.pdf\nhttps://www.owasp.org/index.php/XSS_(Cross_Site_Scripting)_Prevention_Cheat_Sheet\nhttps://www.owasp.org/index.php/Web_Application_Firewall",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "SELECT USER SQL Injection Attempt in URI",
                "description" => "Una inyección SQL consiste en la inserción o la \"inyección\" de una consulta SQL a través de los datos de  _x000D_\nentrada del cliente para la aplicación. Esto es leer datos sensibles de la base de datos, modificándolos  _x000D_\n(Insertar / Actualizar / Eliminar), ejecutando operaciones de administración dentro de la misma base de  _x000D_\ndatos  recuperar el contenido de un archivo determinado  y en algunos casos cuestión comandos al sistema  _x000D_\noperativo. _x000D_\n_x000D_\nEste tipo de ataques de SQL son un tipo de ataque de inyección, en la que los comandos SQL se inyectan en  _x000D_\nla entrada de datos de plano con el fin de efectuar la ejecución de comandos SQL predefinidos o bien al  _x000D_\nalterar la sentencia SQL termina poniendo en peligro la seguridad de una aplicación web, ocasionando el  _x000D_\nrobo de información del usuario._x000D_\n\n",
                "recommendation" => "Restringir los permisos de inicio de sesión de la base de datos utilizada por la aplicación web.                                                                                                                                                                            Implementar una aplicación WAF (Web Application Firewall) con la que se pueden identificar y bloquear ataques a servidores                                                                                      Bloquear la comunicación con la dirección IP pública en el firewall perimetral.                                 ",
                "risk" => "La información sensible de la base de datos puede quedar expuesta al acceso, modificación o fuga de la información.",
                "reference" => "https://www.owasp.org/index.php/SQL_Injection_Prevention_Cheat_Sheet",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "SERVER 403 Forbidden",
                "description" => "La firma se presenta debido a la existencia de una acceso denegado o una petición no autorizada hacia un servidor web.\n\n",
                "recommendation" => "Validar que el ingreso al dominio se encuentre permitido por institución, de ser así habilitar el IIS Internet Information Services.  ",
                "risk" => " Acceso a sitios no atorizados por la institución.\nViolación a las políticas de seguridad de la institución.",
                "reference" => "http://www.checkupdown.com/status/E403.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "SERVER PHP Attack Tool Morfeus F Scanner",
                "description" => "La firma se presenta debido a la detección de la herramienta Morfeus para el escaneo en el servidor web, dirigidas a vulnerabilidades en PHP_x000D_\n\n\n",
                "recommendation" => "Filtrar los paquetes de todas las peticiones con el User Agent: \"Morfeus F\", accediendo a la configuración de  iptables y rechazar la comunicación mediante la regla:\n• iptables -A INPUT -p tcp --dport 80 -m string --algo bm --string Morfeus F -j DROP\n",
                "risk" => "Encontrar vulnerabilidades en el equipo que podrás ser explotadas por el atacante  para tomar control del equipo.",
                "reference" => "http://stateofsecurity.com/?p=467",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Session Traversal Utilities for NAT (STUN Binding Request obsolete rfc 3489 CHANGE-REQUEST attribute change IP flag false change port flag false)",
                "description" => "Esta firma se presenta debido a la detección de tráfico obsoleto dentro de la utilidad para NAT, STUN,el RFC 3489 especifica un algoritmo que permite visualizar los puntos finales para caracterizar el comportamiento NAT, de acuerdo con la dirección y el puerto. El algoritmo fue eliminado del RFC 5389 \u200B\u200B, ya que no es fiable y sólo es aplicable a un subconjunto de los dispositivos NAT desplegados.\n\n",
                "recommendation" => "Validar que la comunicación entre los equipos involucrados sea legítima.\nVerificar si el equipo o los equipos relacionados con la dirección IP requieren o están dentro de sus funciones la comunicación por el puerto 3489, en caso de no ser necesaria se sugiere bloquear la comunicación por dicho puerto.",
                "risk" => "Esto puede llevar a que una persona o entidad maliciosa aproveche la comunicación por el puerto 3489 en búsqueda de vulnerabilidades y explotarlas, lograr el acceso no autorizado, robo o fuga de información.",
                "reference" => "https://tools.ietf.org/html/rfc5389#section-16.1",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Signed TLS Certificate with md5WithRSAEncryption",
                "description" => "Esta firma se presenta debido a la detección de tráfico en la red, con un certificado de cifrado obsoleto y no actualizado, el cual es MD5, que es vulnerable a ataques de fuerza bruta para poder romperlo.\n\n",
                "recommendation" => "Actualizar al protocolo TLS 1.2 el cual rechaza certificados digitales firmados mediante el algoritmo MD5.",
                "risk" => "Acceso a sitios no seguros, falsificación de información y robo de credenciales.",
                "reference" => "http://www.win.tue.nl/hashclash/rogue-ca/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Simbar Spyware User-Agent Detected",
                "description" => "Esta firma se presenta debido a un agente detectado como malicioso, perteneciente al Troyano Simbar, realizando peticiones hacia la red.",
                "recommendation" => "Eliminar las siguientes entradas de registro creadas por Simbar:\n• HKEY_CLASSES_ROOT\\SimpleTbar.StockBar \"(Default)\" = \"The Simple Toolbar Search\"\n• HKEY_CLASSES_ROOT\\SimpleTbar.StockBar\\CLSID \"(Default)\" = \"A6790AA5-C6C7-4BCF-A46D-0FDAC4EA99EB\"\n• HKEY_CLASSES_ROOT\\SimpleTbar.StockBar\\CurVer \"(Default)\" = \"The Simple Toolbar Search\"\n• HKEY_CLASSES_ROOT\\SimpleTbar.StockBar.1 \"(Default)\" = \"The Simple Toolbar Search\"\n• HKEY_CLASSES_ROOT\\SimpleTbar.StockBar.1\\CLSID \"(Default)\" = \"A6790AA5-C6C7-4BCF-A46D-0FDAC4EA99EB\"\n• HKEY_CLASSES_ROOT\\TypeLib\\[84C94803-B5EC-4491-B2BE-7B113E013B77}\\1.0 \"(Default)\" = \"SimpleTbar 1.0 Type Library\"\n• HKEY_CLASSES_ROOT\\TypeLib\\[84C94803-B5EC-4491-B2BE-7B113E013B77}\\1.0\\0\\win32 \"(Default)\" =\n• HKEY_CLASSES_ROOT\\TypeLib\\[84C94803-B5EC-4491-B2BE-7B113E013B77}\\1.0\\FLAGS \"(Default)\" = \"0\"\n• HKEY_CLASSES_ROOT\\TypeLib\\[84C94803-B5EC-4491-B2BE-7B113E013B77}\\1.0\\HELPDIR \"(Default)\" =\n• HKEY_LOCAL_MACHINE\\SOFTWARE\\Microsoft\\Internet Explorer\\Extensions\\[A26ABCF0-1C8F-46e7-A67C-0489DC21B9CC} \"(Default)\" = \"The Simple Toolbar Search\"\n",
                "risk" => "Afectación del rendimiento del equipo, recopilar información del usuario, perdida de información.",
                "reference" => "http://blog.armorize.com/2010/05/browser-helper-objects-infection-with.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Sipvicious Scan",
                "description" => "Esta firma se presenta al detectar escaneos a través del puerto 5060, este puerto es comúnmente usado por el protocolo SIP que se emplea para la comunicación de voz sobre IP (VoIP)._x000D__x000D_\nSIP (Session Initiation Protocol) es un protocolo que se usa para iniciar, modificar y finalizar una sesión interactiv,a comprende elementos multimedia como vídeo, voz y mensajería instantánea._x000D_\n_x000D_\nLa firma está en relación con la detección de una herramienta de auditoria de seguridad llamada SIPVicious, la cual se encarga de revisar la configuración del protocolo SIP mediante el escaneo de direcciones IP y obtención de contraseñas de las extensiones SIP. El escaneo puede revelar información acerca del sistema auditado, lo cual puede llevar a la explotación de alguna vulnerabilidad detectada.\n\n",
                "recommendation" => "Reforzar la seguridad del equipo utilizando contraseñas robustas, para dificultar el acceso de equipos malintencionados, se recomienda que las contraseñas cumplan con las siguientes características:\n• Contener al menos 12 caracteres.\n• Utilizar caracteres especiales.\n• Mezclar números, letras y caracteres.\n• Utilizar letras mayúsculas y minúsculas.\n\n",
                "risk" => "Encontrar vulnerabilidades o puertos abiertos en el equipo que podrás ser explotadas por el atacante  para tomar control del equipo.",
                "reference" => "http://www.speedguide.net/port.php?port=5060\n\nhttp://www.darknet.org.uk/tag/sipvicious/\n\nhttps://www.voztovoice.org/?q=node/100\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Skype VOIP Checking Version (Startup)",
                "description" => "Esta firma se presenta al detectar actividad inusual de peticiones de conexión con direcciones IP públicas, donde se detectó el uso de “Skype”, un software que permite comunicación de texto, voz y vídeo sobre Internet (VoIP).  Además se identificó que las peticiones de conexión son hacia la página web del software en busca de actualizaciones para la última versión del mismo._x000D_\n_x000D_\nEl uso de este tipo software de comunicaciones dentro de la organización como el chat, implica un riesgo de seguridad a la institución, ya que puede provocar la fuga de información sensible y son foco de infección de malware, así como puede incurrir en una violación a las políticas internas por el uso indebido de software ajeno a la institución\n_x000D_\nReferencias:\n",
                "recommendation" => "Validar que el uso de la aplicación Skype se encuentra permitida dentro de la institución, en caso de no estar permitida se sugiere desinstalar la aplicación del equipo.",
                "risk" => "Violación a las políticas de uso de software de la institución.\nFuga de información sensible.\nDisminución de la productividad laboral por parte del usuario.     ",
                "reference" => "http://www.makeuseof.com/tag/3-skype-security-issues/\n\nhttp://www.altusmedia.com.mx/blog/?p=528\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Smilebox Software/Adware Checkin",
                "description" => "Se detectó actividad correspondiente al malware Adware.Smilebox, este tipo de Troyano también llamado adware, tiene la función de mostrar publicidad sin el consentimiento del usuario, bloquear la página de inicio de los navegadores con el objetivo de forzar a usar ciertos buscadores. Además el adware se comunica constantemente con dominios en red, a los que envía información acerca del equipo infectado._x000D_\n_x000D_\nEstos dominios están identificados como servidores del Adware.Smilebox, por lo que la comunicación de los equipos infectados son mediante peticiones GET. Una vez que el adware se encuentra instalado, comúnmente crea y modifica tanto archivos como registros del sistema operativo, poniendo en riesgo la confidencialidad, la integridad y la disponibilidad del equipo._x000D_\n_x000D_\n\n",
                "recommendation" => "Eliminar las siguientes entradas de registro creadas por Smilebox:\n• HKEY_LOCAL_MACHINE\\SOFTWARE\\Classes\\CLSID\\[31AA760D-D058-4A63-AA81-BADC600FE745}\\VersionIndependentProgID\\: “Toolbar.CT3061355″\n• HKEY_LOCAL_MACHINE\\SOFTWARE\\Classes\\CLSID\\[31AA760D-D058-4A63-AA81-BADC600FE745}\\ProgID\\: “Toolbar.CT3061355″\n• HKEY_LOCAL_MACHINE\\SOFTWARE\\Classes\\CLSID\\[31AA760D-D058-4A63-AA81-BADC600FE745}\\InprocServer32\\: “C:\\Program Files\\SmileBox_EN\\prxtbSmil.dll”\n• HKEY_LOCAL_MACHINE\\SOFTWARE\\Classes\\CLSID\\[31AA760D-D058-4A63-AA81-BADC600FE745}\\InprocServer32\\ThreadingModel: “Apartment”\n• HKEY_LOCAL_MACHINE\\SOFTWARE\\Classes\\CLSID\\[31AA760D-D058-4A63-AA81-BADC600FE745}\\: “SmileBox EN API Server”\n• HKEY_LOCAL_MACHINE\\SOFTWARE\\Classes\\CLSID\\[3c471948-f874-49f5-b338-4f214a2ee0b1}\\InprocServer32\\: “C:\\Program Files\\Conduit\\Community Alerts\\Alert.dll”\n• HKEY_LOCAL_MACHINE\\SOFTWARE\\Classes\\CLSID\\[3c471948-f874-49f5-b338-4f214a2ee0b1}\\InprocServer32\\ThreadingModel: “Apartment”\n• HKEY_LOCAL_MACHINE\\SOFTWARE\\Classes\\CLSID\\[3c471948-f874-49f5-b338-4f214a2ee0b1}\\: “Conduit Community Alerts”\n• HKEY_LOCAL_MACHINE\\SOFTWARE\\Classes\\CLSID\\[F897EB0E-A3A4-46C3-80EB-2729699D8892}\\InprocServer32\\: “C:\\Program Files\\SmileBox_EN\\prxtbSmil.dll”\n• HKEY_LOCAL_MACHINE\\SOFTWARE\\Classes\\CLSID\\[F897EB0E-A3A4-46C3-80EB-2729699D8892}\\InprocServer32\\ThreadingModel: “Apartment”\n• HKEY_LOCAL_MACHINE\\SOFTWARE\\Classes\\CLSID\\[F897EB0E-A3A4-46C3-80EB-2729699D8892}\\: “SmileBox EN Toolbar”\n• HKEY_LOCAL_MACHINE\\SOFTWARE\\Classes\\Toolbar.CT3061355\\CLSID\\: “[31aa760d-d058-4a63-aa81-badc600fe745}”\n• HKEY_LOCAL_MACHINE\\SOFTWARE\\Microsoft\\Internet Explorer\\Low Rights\\ElevationPolicy\\[1A49230D-198E-4E17-B19B-62F0F123CDAA}\\AppPath: “C:\\Program Files\\SmileBox_EN”\n• HKEY_LOCAL_MACHINE\\SOFTWARE\\Microsoft\\Internet Explorer\\Low Rights\\ElevationPolicy\\[1A49230D-198E-4E17-B19B-62F0F123CDAA}\\AppName: “SmileBox_ENToolbarHelper.exe”\n• HKEY_LOCAL_MACHINE\\SOFTWARE\\Microsoft\\Internet Explorer\\Low Rights\\ElevationPolicy\\[1A49230D-198E-4E17-B19B-62F0F123CDAA}\\Policy: 0x00000003 \n",
                "risk" => "Afectación del rendimiento del equipo, recopilar información del usuario, perdida de información.",
                "reference" => "http://proteccion-contra-malware-pasos.blogspot.mx/2013/04/mystartsmileboxcom-desinstalar.html\n\nhttp://www.forospyware.com/t247643.htm\n\nhttp://www.yac.mx/es/guides/adware/20140711-how-to-remove-Smilebox-Toolbar-by-yac-pc-cleaner.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "SNMP private access udp",
                "description" => "El Simple Network Management Protocol (SNMP), es un servicio de uso común que proporciona capacidades de gestión de red y monitoreo (tráfico udp puerto 161). SNMP ofrece la capacidad de sondear los dispositivos de red y los datos de los host. SNMP también es capaz de cambiar las configuraciones en el host, lo que permite la gestión remota del dispositivo de red. El protocolo utiliza una cadena de comunidad para la autenticación del cliente SNMP. La cadena de comunidad de gestión predeterminada o escribir a menudo es \"privado\". El SNMP explota o se aprovecha de estas cadenas de comunidad por defecto para permitir a un atacante cambiar la configuración del sistema de un dispositivo que utiliza la cadena de comunidad de escritura \"private\". La oportunidad de este exploit se incrementa debido a que el agente SNMP se suele instalar en un sistema por defecto sin el conocimiento del administrador._x000D_\n_x000D_\nEn relación a esta firma en especial es porque se detectó la cadena \"private\" en los mensajes SNMP, si estos son una gran cantidad en muy poco tiempo, existe la posibilidad de que la comunicación con el host se sature causando una denegación de servicios (DoS).",
                "recommendation" => "Validar que las conexiones entre los equipos sean legítimas.\nEn caso de no ser necesarias las conexiones con las direcciones IP reportadas, se sugiere cerrar el puerto 161.\nSi no se utiliza SNMP, deshabilitarlo.",
                "risk" => "Exceso de tráfico hacia una misma dirección IP lo que puede probocar  que sea susceptible a ataques de denegación de servicio.",
                "reference" => "http://www.alcancelibre.org/staticpages/index.php/como-linux-snmp",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "SNMP public access udp",
                "description" => "El Simple Network Management Protocol (SNMP), es un servicio de uso común que proporciona capacidades de gestión de red y monitoreo (tráfico udp puerto 161). SNMP ofrece la capacidad de sondear los dispositivos de red y los datos de los host. SNMP también es capaz de cambiar las configuraciones en el host, lo que permite la gestión remota del dispositivo de red. El protocolo utiliza una cadena de comunidad para la autenticación del cliente SNMP. La cadena de comunidad de gestión predeterminada o escribir a menudo es \"privado\". El SNMP explota o se aprovecha de estas cadenas de comunidad por defecto para permitir a un atacante cambiar la configuración del sistema de un dispositivo que utiliza la cadena de comunidad de escritura \"private\". La oportunidad de este exploit se incrementa debido a que el agente SNMP se suele instalar en un sistema por defecto sin el conocimiento del administrador._x000D_\n_x000D_\nEn relación a esta firma en especial es porque se detectó la cadena \"private\" en los mensajes SNMP, si estos son una gran cantidad en muy poco tiempo, existe la posibilidad de que la comunicación con el host se sature causando una denegación de servicios (DoS).",
                "recommendation" => "Validar que las conexiones entre los equipos sean legítimas.\nEn caso de no ser necesarias las conexiones con las direcciones IP reportadas, se sugiere cerrar el puerto 161.\nSi no se utiliza SNMP, deshabilitarlo.",
                "risk" => "Exeso de tráfico hacia una misma dirección IP lo que puede probocar  que sea susceptible a ataques de denegación de servicio.",
                "reference" => "http://www.alcancelibre.org/staticpages/index.php/como-linux-snmp",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "SOCKSv5 UDP Proxy Inbound Connect Request (Windows Source)",
                "description" => "Se detectó una conexión de entrada que hace uso del protocolo SOCKS en su versión 5, SOCKS es un protocolo que facilita la ruta de los paquetes que se envían entre un cliente y un servidor a través de un servidor proxy. En la versión 5 nos permite ocupar el protocolo para tráfico de tipo UDP._x000D__x000D_\nSe puede usar para tener acceso a sitios o recursos inseguros, evitando la seguridad del Firewall institucional.",
                "recommendation" => "En caso de contar con un servidor proxy, se puede configurar dicho servidor para filtrar el tráfico de red y permitir únicamente el paso de tráfico válido.\nÉsta configuración se puede lograr mediante la inclusión de un archivo de texto de sitios denegados, donde se definirán todas las URL’s o palabras dentro de la URL a las que no se desea permitir el acceso",
                "risk" => "Violación a las políticas de uso de software de la institución.\nFuga de información sensible.\nAcceso a sitios no seguros.\nPosible infección de malware.",
                "reference" => "http://www.zensur.freerk.com/index-es.htm",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Spoofed MSIE 7 User-Agent Likely Ponmocup",
                "description" => "Esta firma se levanta al detectar la presencia del malware Ponmocup, el cual es un malware que instala silenciosamente otros programas sin consentimiento de usuario. Se ha detectado que dicho malware es capaz de deshabilitar el centro de seguridad del equipo y redireccionar las búsquedas del servidor web a páginas de publicidad.",
                "recommendation" => "Identificar el equipo relacionado en el incidente y desinstalar el software Ponmocup:\nInicio, Panel de control.\nDesinstalar un programa.\nSeleccionar Ponmocup.\nDar clic en el botón “Desinstalar”.                                                                                                                                                                                                                                                                                Eliminar los complementos de los navegadores web:\nAbrir el navegador web.\nIr a opciones o configuraciones y buscar el apartado de complementos o extensiones.\nDesinstalar los complementos no deseados.\nRealizar un análisis del equipo involucrado con un software antivirus para descartar la existencia de algún tipo de malware en el equipo ",
                "risk" => "Afectación del rendimiento del equipo, recopilar información del usuario, perdida de información.",
                "reference" => "http://eliminarspywarevirus.blogspot.mx/2014/11/eliminar-win32ponmocupaa-como-quitar.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "SQL Injection closing string plus line comment",
                "description" => "Este ataque consiste en inyectar código SQL ajeno en una consulta ya programada, con el fin de alterar el funcionamiento de la base de datos. Estas alteraciones podrían producir fuga, modificación o borrado de la información en la base de datos._x000D_\nSe agrega una línea de comentario al final de la inyección de código malicioso, de modo que la porción de código válido que viene después de la inyección, no sea ejecutada, ya que todo después de la línea de comentario no será tomada en cuenta al ejecutar la consulta._x000D_",
                "recommendation" => "• Mantener actualizado el software tanto de las aplicaciones como del Sistema Operativo  de la Base de datos.\n• Restringir los permisos de inicio de sesión de la base de datos utilizada por la aplicación web.\n• Implementar buenas prácticas de programación dentro de las aplicaciones, por ejemplo, validar los datos introducidos por el usuario mediante una lista blanca para caracteres permitidos o utilizar procedimientos almacenados parametrizados.\n",
                "risk" => "La información sensible de la base de datos puede quedar expuesta al acceso, modificación o fuga de la información.",
                "reference" => "https://www.owasp.org/index.php/SQL_Injection_Prevention_Cheat_Sheet",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "SQL service_name buffer overflow attempt",
                "description" => "El parámetro SERVICE_NAME es el nombre por el que se conocen las instancias de una base de datos. Si un atacante modifica este parámetro para que incluya una cadena de gran longitud, al construir el mensaje de error para grabarlo en el archivo de registro se producirá el desbordamiento de búfer con la posibilidad de ejecución de código arbitrario._x000D_\nEl código proporcionado por el atacante se ejecutará en el contexto de seguridad del sistema por lo que podrá conseguir el control total del sistema._x000D_",
                "recommendation" => "• Mantener actualizado el software tanto de las aplicaciones como del Sistema Operativo  de la Base de datos para evitar la explotación de vulnerabilidades.\n• Restringir los permisos de inicio de sesión de la base de datos utilizada por la aplicación web.\n",
                "risk" => "La información sensible de la base de datos puede quedar expuesta al acceso, modificación o fuga de la información.",
                "reference" => "http://www.iss.net/security_center/reference/vuln/BOEP_sqlservr.htm",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "SQL user name buffer overflow attempt",
                "description" => "El parámetro USER_NAME es el nombre del usuario asignado a una instancia de una base de datos. Si un atacante modifica este parámetro para que incluya una cadena de gran longitud, al construir el mensaje de error para grabarlo en el archivo de registro se producirá el desbordamiento de búfer con la posibilidad de ejecución de código arbitrario._x000D_\nEl código proporcionado por el atacante se ejecutará en el contexto de seguridad del sistema por lo que podrá conseguir el control total del sistema._x000D_",
                "recommendation" => "• Mantener actualizado el software tanto de las aplicaciones como del Sistema Operativo  de la Base de datos para evitar la explotación de vulnerabilidades.\n• Restringir los permisos de inicio de sesión de la base de datos utilizada por la aplicación web.\n",
                "risk" => "La información sensible de la base de datos puede quedar expuesta al acceso, modificación o fuga de la información.",
                "reference" => "http://www.iss.net/security_center/reference/vuln/BOEP_sqlservr.htm",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "SSH BruteForce Tool with fake PUTTY version",
                "description" => "Se refiere a un ataque de fuerza bruta que utiliza una herramienta que intenta hacerse pasar por el software PuTTy. Éste es un cliente SSH, Telnet, rlogin, y TCP raw con el que es posible conectarse a servidores remotos iniciando una sesión en ellos._x000D_\nFake PuTTY es una versión maliciosa del software PuTTY, funciona igual que la original para no levantar sospechas, salvo que al intentar establecer una conexión con un servidor remoto automáticamente se envía un ping al servidor de los piratas informáticos con la dirección y los credenciales de dicho servidor, otorgando así al pirata informático el acceso al servidor SSH._x000D_",
                "recommendation" => "• Validar si el equipo con dirección IP destino requiere o está dentro de sus funciones permitir las conexiones por el puerto 22, de no ser así, se sugiere cerrar el puerto.\n\nEn caso de que el servicio por el puerto 22 sea necesario, se recomienda el cumplimiento de las siguientes características de una contraseña segura:\n• La contraseña debe constar de al menos 12 caracteres.\n• Debe contener caracteres alfanuméricos.\n• Debe contener caracteres especiales.\n• Debe combinar mayúsculas y minúsculas.",
                "risk" => "Acceso no autorizado, robo de información sensible.",
                "reference" => "http://www.gb.nrao.edu/pubcomputing/redhatELWS4/RH-DOCS/rhel-rg-es-4/ch-ssh.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "SSLv3 inbound connection to server vulnerable to POODLE attack",
                "description" => "Se detectó tráfico entrante cifrado con SSLv3 considerado obsoleto y vulnerable._x000D_\nSe identificó que la versión SSLv3 cuenta con una vulnerabilidad conocida como POODLE y está registrada con la clave técnica CVE-2014-3566. Esta vulnerabilidad es susceptible en navegadores que no se encuentran actualizados y radica cuando existe un fallo en el intento de conexión segura, los servidores intentan la conexión con los protocolos más antiguos, como SSL 3.0. Un atacante puede desencadenar un fallo de conexión para forzar el uso de SSL 3.0 e interceptar paquetes de tráfico durante las conexiones cliente-servidor para obtener el texto en claro de los mensajes que pretenden ir ocultos bajo el cifrado SSLv3. En este tipo de ataques se busca obtener principalmente datos de navegación como cookies o datos de sesión del cliente.\n_x000D_\n\n",
                "recommendation" => "• Deshabilitar el soporte en las configuraciones de SSL 3.0 en el sistema. \n• Habilitar el módulo TLS_FALLBACK_SCSV en los servidores y clientes locales para prevenir ésta vulnerabilidad. \n",
                "risk" => "Falsificación de información y robo de credenciales, robo de identidad,  infección por código malicioso.",
                "reference" => "http://www.cve.mitre.org/cgi-bin/cvename.cgi?name=CVE-2014-3566\n\nhttp://www.securityfocus.com/bid/70574/info\n\nhttps://www.openssl.org/~bodo/ssl-poodle.pdf\n\nhttp://www.scip.ch/es/?vuldb.67791\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "SSLv3 outbound connection from client vulnerable to POODLE attack",
                "description" => "Se detectó tráfico saliente cifrado con SSLv3 considerado obsoleto y vulnerable._x000D_\nSe identificó que la versión SSLv3 cuenta con una vulnerabilidad conocida como POODLE y está registrada con la clave técnica CVE-2014-3566. Esta vulnerabilidad es susceptible en navegadores que no se encuentran actualizados y radica cuando existe un fallo en el intento de conexión segura, los servidores intentan la conexión con los protocolos más antiguos, como SSL 3.0. Un atacante puede desencadenar un fallo de conexión para forzar el uso de SSL 3.0 e interceptar paquetes de tráfico durante las conexiones cliente-servidor para obtener el texto en claro de los mensajes que pretenden ir ocultos bajo el cifrado SSLv3. En este tipo de ataques se busca obtener principalmente datos de navegación como cookies o datos de sesión del cliente.\n_x000D_\n\n",
                "recommendation" => "• Deshabilitar el soporte en las configuraciones de SSL 3.0 en el sistema. \n• Habilitar el módulo TLS_FALLBACK_SCSV en los servidores y clientes locales para prevenir ésta vulnerabilidad.\n",
                "risk" => "Falsificación de información y robo de credenciales, robo de identidad, infección por código malicioso.",
                "reference" => "http://www.cve.mitre.org/cgi-bin/cvename.cgi?name=CVE-2014-3566\n\nhttp://www.securityfocus.com/bid/70574/info\n\nhttps://www.openssl.org/~bodo/ssl-poodle.pdf\n\nhttp://www.scip.ch/es/?vuldb.67791\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Stacheldraht client check gag",
                "description" => "Se detectó una gran cantidad de peticiones las cuales contienen la cadena de texto “gesundheit!” que está relacionada con la herramienta stacheldraht.\nStacheldraht es un programa que puede ser utilizado para realizar diversos ataques de Denegación de Servicio(DoS) ya sea por ICMP, UDP o SYN. Es considerada una botnet y troyano, debido a que su distribución se realiza mediante programas que infectan un sistema para posteriormente ser controlado por el atacante.\nAdemás se identificó el uso del script “gag, el cual permite a atacantes reconocer los host infectados dentro de una red.\nDebido a que es una herramienta para denegación de servicio, pone en riesgo no solamente la seguridad del equipo infectado sino de la red en general incluyendo dispositivos de red y equipos.\n_x000D_\n\n",
                "recommendation" => "• Mantener actualizado el software tanto de las aplicaciones como del Sistema Operativo, para evitar y corregir vulnerabilidades. \n• En caso de no ser necesario el uso de los servicios de RPC se sugiere cerrarlos. \n",
                "risk" => "Violación a las políticas de uso de software de la institución.\nFuga de información sensible.\nDisminución de la productividad laboral por parte del usuario.",
                "reference" => "http://mysecurity.zyxel.com/mysecurity/jsp/policy.jsp?ID=1048728\nhttp://antisec-security.blogspot.mx/2012/09/botnet-stacheldraht-stacheldraht-el.html\n\nhttp://www.symantec.com/security_response/attacksignatures/detail.jsp?asid=20009\n\nhttps://www.freshports.org/security/gag/\n\nhttp://www.sans.org/security-resources/malwarefaq/stacheldraht.php\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Suspicious inbound to MSSQL port 1433",
                "description" => "Se detectaron conexiones entrantes hacia el puerto 1433 el cual generalmente es utilizado para el servicio de Base de Datos de Microsoft SQL Server.\nEl puerto 1433 cuenta con diversas vulnerabilidades que permiten a un atacante poder ingresar código malicioso, modificar, eliminar o exportar información sensible de la institución, incluso hasta obtener privilegios de administrador lo cual pone en riesgo la seguridad del equipo pudiendo el atacante tomar control total del equipo o expandir el ataque hacia otros equipos de la institución.\n_x000D_\n\n",
                "recommendation" => "• Verificar si el equipo requiere o está dentro de sus funciones permitir las conexiones por el puerto 1433, en caso de no ser necesaria la conexión se sugiere cerrar el puerto.\n• Mantener actualizado el software tanto de las aplicaciones como del Sistema Operativo  de la Base de datos para evitar la explotación de vulnerabilidades.",
                "risk" => "Explotación de vulnerabilidades,  acceso a usuarios no autorizados, robo de información.",
                "reference" => "https://support.microsoft.com/es-es/kb/287932/es\n\nhttps://support.microsoft.com/es-es/kb/313418/es\n\nhttps://technet.microsoft.com/es-es/library/security/MS14-044\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Suspicious inbound to mySQL port 3306",
                "description" => "La actividad generada muestra escaneos hacia el puerto 3306 del equipo con dirección IP local reportada por parte de la dirección IP pública. Dicho puerto se encuentra reservado para el servicio de la aplicación de bases de datos MySQL.\nLos escaneos a dicho puerto, usualmente son utilizados para identificar la versión del servicio instalado, con la finalidad de encontrar si el servicio es vulnerable a algún exploit. Una vez identificado el servicio, podrían realizar un ataque de fuerza bruta. \nUn ataque de fuerza bruta consiste en que sin conocer las credenciales de acceso, se prueban todas las combinaciones posibles para lograr ingresar en el sistema sin autorización.\nTener el puerto 3306 abierto sin la configuración adecuada representa un riesgo para la institución.",
                "recommendation" => "• Validar si el uso del puerto 3306 es necesario en los equipos involucrados, de lo contrario cerrarlo.\n• Mantener actualizado el software tanto de las aplicaciones como del Sistema Operativo  de la Base de datos para evitar la explotación de vulnerabilidades.",
                "risk" => "Explotación de vulnerabilidades,  acceso a usuarios no autorizados, robo de información.",
                "reference" => "https://www.owasp.org/index.php/Brute_force_attack",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Suspicious inbound to Oracle SQL port 1521",
                "description" => "La actividad generada muestra diversas conexiones por parte de los equipos con dirección IP reportadas. Dichas conexiones se realizan hacia el puerto 1521, el cual es utilizado por el servicio SQL de Bases de Datos de Oracle.\nEl no contar con una correcta configuración del puerto 1521 representa un riesgo, ya que de ser comprometido por un usuario no autorizado, puede ocasionar propagación de Malware, acceso al equipo, fuga de información e incluso acceso a diversos recursos en la red.",
                "recommendation" => "• Validar que la comunicación entre los equipos sea legítima.\n• Validar si el uso del puerto 1521 es necesario en los equipos involucrados, de lo contrario cerrarlo.",
                "risk" => "Ataques de fuerza bruta, explotación de vulnerabilidades,  acceso a usuarios no autorizados, robo de información.",
                "reference" => "http://unaaldia.hispasec.com/2002/06/dos-nuevas-vulnerabilidades-en.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Suspicious inbound to PostgreSQL port 5432",
                "description" => "La actividad generada muestra diversas conexiones por parte de los equipos con dirección IP reportadas. Dichas conexiones se realizan hacia el puerto 5432, el cual es utilizado por el servicio de Bases de datos PostgreSQL.\nEl no contar con una correcta configuración del puerto 5432 representa un riesgo, ya que de ser comprometido por un usuario no autorizado, puede ocasionar propagación de Malware, acceso al equipo, fuga de información e incluso acceso a diversos recursos en la red.\nLa actividad representada se considera anormal debido al número de conexiones desde una dirección IP interna en un lapso de tiempo muy corto.",
                "recommendation" => "• Validar que la comunicación entre los equipos sea legítima.\n• Validar si el uso del puerto 5432 es necesario en los equipos involucrados, de lo contrario cerrarlo.",
                "risk" => "Ataques de fuerza bruta, explotación de vulnerabilidades,  acceso a usuarios no autorizados, robo de información.",
                "reference" => "https://wiki.postgresql.org/wiki/20130404ActualizacionSeguridad",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "SUSPICIOUS IRC - PRIVMSG *.(exe|tar|tgz|zip) download command",
                "description" => "La actividad generada muestra diversas peticiones por parte del equipo con dirección IP interna reportada, a través del puerto 6667 reservado para el protocolo IRC, donde se identificó que dichas peticiones son realizadas a hacia el sitio web asociado con la dirección IP pública reportada , que ofrece servicios de mensajería instantánea a través de distintas plataformas web.\nEl protocolo IRC es usado para mantener conversaciones en tiempo real, utilizando un cliente de mensajería para conectarse con el servidor IRC. \nEl uso de este tipo de sitios web o software para conversaciones instantáneas, implica un riesgo de seguridad para la institución, debido a que se puede presentar fuga de información a través de este canal de comunicación.",
                "recommendation" => "Validar que se encuentre instalado únicamente software permitido dentro de las políticas de uso aceptable para el equipo. \nAnalizar el equipo involucrado con un software antivirus actualizado para eliminar cualquier malware que se encuentre alojado en el equipo.",
                "risk" => "Afectación del rendimiento del equipo  por Infección por código malicioso.",
                "reference" => "http://www.iss.net/security_center/reference/vuln/Trojan.Pushdo_Variants.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Suspicious Mozilla User-Agent - Likely Fake (Mozilla/4.0)",
                "description" => "El Agente de usuario (User-Agent), es un parámetro del protocolo HTTP. Cuando un usuario accede a una página web, generalmente se envía una cadena de texto que identifica al agente de usuario ante el servidor. Este texto forma parte del pedido a través de HTTP, generalmente incluye información como el nombre de la aplicación, la versión, el sistema operativo y el idioma, su formato estándar se define en el RFC RFC2616._x000D__x000D_\nLa firma detecta un Agente de Usuario que no sigue el formato estándar, lo que puede significar que se produce por algún tipo de malware presente en el equipo que intenta hacerse pasar por un producto de la fundación Mozilla en su versión 4.0.",
                "recommendation" => "Verificar  que en el equipo relacionado se encuenten unicamente aplicaciones instaladas autorizadas por la institución, en caso contrario desinstalarlas.                                                                                                                     Analizar el equipo relacionado con un software antivirus totalmente actualizado, para descartar la existencia de algún malware en el equipo.\nActualizar y aplicar los parches más recientes del software, así como del Sistema Operativo y del explorador web del equipo relacionado. ",
                "risk" => "Afectación del rendimiento del equipo, recopilar información de navegación del usuario, perdida de información.",
                "reference" => "https://www.nccgroup.trust/us/about-us/newsroom-and-events/blog/2010/june/identifying-malware-via-user-agent-headers/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Suspicious Mozilla User-Agent Inbound - Likely Fake (Mozilla/5.0)",
                "description" => "El Agente de usuario (User-Agent), es un parámetro del protocolo HTTP. Cuando un usuario accede a una página web, generalmente se envía una cadena de texto que identifica al agente de usuario ante el servidor. Este texto forma parte del pedido a través de HTTP, generalmente incluye información como el nombre de la aplicación, la versión, el sistema operativo y el idioma, su formato estándar se define en el RFC RFC2616._x000D_\n_x000D_\nLa firma detecta un Agente de Usuario en una petición entrante la cual no sigue el formato estándar, esto puede significar que se trata de algún tipo de actividad maliciosa que intenta hacerse pasar por un producto de la fundación Mozilla en su versión 5.0.",
                "recommendation" => "Verificar  que en el equipo relacionado se encuenten unicamente aplicaciones instaladas autorizadas por la institución, en caso contrario desinstalarlas.                                                                                                                     Analizar el equipo relacionado con un software antivirus totalmente actualizado, para descartar la existencia de algún malware en el equipo.\nActualizar y aplicar los parches más recientes del software, así como del Sistema Operativo y del explorador web del equipo relacionado.           ",
                "risk" => "Afectación del rendimiento del equipo, recopilar información de navegación del usuario, perdida de información.",
                "reference" => "http://blog.shekyan.com/page/2/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Suspicious User Agent - Possible Spyware Related (Mozilla)",
                "description" => "El Agente de usuario (User-Agent), es un parámetro del protocolo HTTP. Cuando un usuario accede a una página web, generalmente se envía una cadena de texto que identifica al agente de usuario ante el servidor. Este texto forma parte del pedido a través de HTTP, generalmente incluye información como el nombre de la aplicación, la versión, el sistema operativo y el idioma, su formato estándar se define en el RFC RFC2616._x000D_\n_x000D_\nLa firma detecta un Agente de Usuario que no sigue el formato estándar, lo que puede significar que se ha producido por algún tipo de malware presente en el equipo que intenta hacerse pasar por un producto de la fundación Mozilla.",
                "recommendation" => "Verificar  que en el equipo relacionado se encuenten unicamente aplicaciones instaladas autorizadas por la institución, en caso contrario desinstalarlas.                                                                                                                     Analizar el equipo relacionado con un software antivirus totalmente actualizado, para descartar la existencia de algún malware en el equipo.\nActualizar y aplicar los parches más recientes del software, así como del Sistema Operativo y del explorador web del equipo relacionado.           ",
                "risk" => "Infección por código malicioso, afectación del rendimiento del equipo, recopilar información de navegación del usuario, perdida de información.",
                "reference" => "https://blog.mozilla.org/blog/2013/04/30/protecting-our-brand-from-a-global-spyware-provider/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "NETBIOS Microsoft Windows NETAPI Stack Overflow Inbound - MS08-067",
                "description" => "Una vulnerabilidad de desbordamiento de pila en el servicio de Microsoft Windows Server que puede permitir a un atacante remoto no autenticado ejecutar código arbitrario con privilegios de SYSTEM.\nSe ha identificado que el servicio Microsoft Server contiene una vulnerabilidad de desbordamiento de pila en el manejo de llamada a procedimiento remoto (RPC) de mensajes.",
                "recommendation" => "Aplicar los parches y las actualizaciones correspondientes al servicio de Microsoft Windows Server.\nBloquear el acceso a los servicios SMB (139 / tcp, 445 / tcp) de redes no confiables como Internet.\nPara protegerse de los intentos basados \u200B\u200Ben red que aprovechen esta vulnerabilidad, utilice un servidor de seguridad personal, como Servidor de seguridad de conexión a Internet",
                "risk" => "",
                "reference" => "http://www.kb.cert.org/vuls/id/827267\nhttps://technet.microsoft.com/en-us/library/security/ms08-067.aspx",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "AdWare.Win32.BetterSurf.b SSL Cert",
                "description" => "Programa malicioso que al ser instalado en un equipo, muestra mensajes no deseados sobre publicidad al usuario a través del navegador.",
                "recommendation" => "Para desinstalar el software se recomienda hacer uso del desinstalador propio del Adware, en caso de no estar disponible se recomienda hacer la desinstalación haciendo uso de la opción Panel de Control > Instalar / Desintalar Programas del Sistema Operativo Windows.\n\nAdicionalmente la herramienta Windows Bit Defender elimina el software malicioso.",
                "risk" => "Decrecimiento en el desempeño del equipo afectado.",
                "reference" => "https://www.microsoft.com/security/portal/threat/Encyclopedia/Entry.aspx?Name=Adware%3AWin32%2FBetterSurf",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Suspicious User Agent (agent)",
                "description" => "El Agente de usuario (User-Agent), es un parámetro del protocolo HTTP. Cuando un usuario accede a una página web, generalmente se envía una cadena de texto que identifica al agente de usuario ante el servidor. Este texto forma parte del pedido a través de HTTP, generalmente incluye información como el nombre de la aplicación, la versión, el sistema operativo y el idioma, su formato estándar se define en el RFC RFC2616._x000D_\n_x000D_\nLa firma detecta un Agente de Usuario que no sigue el formato estándar, lo que puede significar que se ha producido por algún tipo de malware presente en el equipo.",
                "recommendation" => "Verificar  que en el equipo relacionado se encuenten unicamente aplicaciones instaladas autorizadas por la institución, en caso contrario desinstalarlas.                                                                                                                     Analizar el equipo relacionado con un software antivirus totalmente actualizado, para descartar la existencia de algún malware en el equipo.\nActualizar y aplicar los parches más recientes del software, así como del Sistema Operativo y del explorador web del equipo relacionado.            ",
                "risk" => "Infección por código malicioso, afectación del rendimiento del equipo, recopilar información de navegación del usuario, perdida de información.",
                "reference" => "http://norfipc.com/articulos/como-bloquear-impedir-acceso-paginas-sitios-web-internet.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Suspicious User Agent (AskInstallChecker)",
                "description" => "Esta firma se presenta al detectar el agente de la extensión o barra de ASK.com en un navegador web, la aplicación askinstallerchecker.exe es identificada como programa potencial no deseado(PUP por sus siglas en inglés), esto debido a que puede mantener terceras partidas y modificar el contenido web al navegar.\n",
                "recommendation" => "Validar que el equipo involucrado tenga instalada dicha barra de herramientas, en caso de ser así desinstalar la barra de Ask:\nInicio, Panel de control.\nDesinstalar un programa.\nSeleccionar Ask.\nDar clic en el botón “Desinstalar”.\nEliminar los complementos de los navegadores web:\nAbrir el navegador web.\nIr a opciones o configuraciones y buscar el apartado de complementos o extensiones.\nDesinstalar los complementos no deseados.\nRealizar un análisis del equipo involucrado con un software antivirus para descartar la existencia de algún tipo de malware en el equipo por el uso de la barra de herramientas. ",
                "risk" => "Infección por código malicioso, afectación del rendimiento del equipo, recopilar información de navegación del usuario, perdida de información.",
                "reference" => "http://www.herdprotect.com/askinstallchecker.exe-6daf776e124b4cba50f8d3916406d85a60f370eb.aspx",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Suspicious User Agent (Autoupdate)",
                "description" => "Esta firma se presenta debido a la detección de un agente web en busca de actualizaciones automaticas, proveniente de software configurado para su autoactualización o de malware instalado en busca de comunicarse o propagarse.\n\n\n",
                "recommendation" => "Verificar  que en el equipo relacionado se encuenten unicamente aplicaciones instaladas autorizadas por la institución, en caso contrario desinstalarlas.                                                                                                                                 Actualizar y aplicar los parches más recientes del software, así como del Sistema Operativo y del explorador web del equipo relacionado.                                                                                                                                                                                                                                                                                                       Analizar el equipo relacionado con un software antivirus totalmente actualizado, para descartar la existencia de algún malware en el equipo.",
                "risk" => "Infección por código malicioso, afectación del rendimiento del equipo, recopilar información de navegación del usuario, perdida de información.",
                "reference" => "http://doc.emergingthreats.net/bin/view/Main/2003337\n\nhttps://www.brightfort.com/sbautoupdate.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Suspicious User Agent (Launcher)",
                "description" => "La firma detecta un actividad realizada por algun(os) lanzador(es) de aplicaciones (Launcher), el cual es una herramienta automatizada para ejecutar aplicaciones de manera automatica._x000D_\nSin embargo, muchas aplicaciones no deseadas podrian ser ejecutadas debido a la existencia de este tipo de herramientas._x000D_\n\n\n",
                "recommendation" => "Actualizar y aplicar los parches más recientes del software, así como del Sistema Operativo y del explorador web del equipo relacionado.\nAnalizar el equipo relacionado con un software antivirus totalmente actualizado, para descartar la existencia de algún malware en el equipo.",
                "risk" => "Infección por código malicioso, afectación del rendimiento del equipo, recopilar información de navegación del usuario, perdida de información.",
                "reference" => "http://gizmodo.com/5920312/what-is-an-app-launcher",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Suspicious User-Agent (AutoHotkey)",
                "description" => "Esta firma se presenta debido a la detección del cliente o agente de Internet, generado por la herramienta Autohotkey, la cual permite realizar scripts básicos para generar atajos a través de la entrada standar para la automatización de tareas o procesos en Windows._x000D_\n_x000D_\n",
                "recommendation" => "Identificar el equipo relacionado en el incidente y desinstalar el software AutoHotkey:\nInicio, Panel de control.\nDesinstalar un programa.\nSeleccionar AutoHotkey.\nDar clic en el botón “Desinstalar”.                                                                                                                                                                                                                                                                                Eliminar los complementos de los navegadores web:\nAbrir el navegador web.\nIr a opciones o configuraciones y buscar el apartado de complementos o extensiones.\nDesinstalar los complementos no deseados.\nRealizar un análisis del equipo involucrado con un software antivirus para descartar la existencia de algún tipo de malware en el equipo ",
                "risk" => "Infección por código malicioso, afectación del rendimiento del equipo, recopilar información de navegación del usuario, perdida de información.",
                "reference" => "http://www.autohotkey.com/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Suspicious User-Agent (NSIS_Inetc (Mozilla))",
                "description" => "Esta firma se presenta debido a la detección de el agente \"Inetc\", el cual es un plug-in de Internet en este caso Mozilla, que permita la carga y descarga de archivos, soportando HTTP, HTTPS y FTP, dentro de sus instrucciones en linea de comando, se presentan algunas funciones de DLL: Get, Post, head, put, para su uso en HTTP._x000D_\n\n",
                "recommendation" => "Analizar el equipo relacionado con un software antivirus totalmente actualizado, para descartar la existencia de algún malware en el equipo.\nActualizar el Sistema Operativo Windows para evitar la explotación de vulnerabilidades.",
                "risk" => "Infección por código malicioso, afectación del rendimiento del equipo, recopilar información de navegación del usuario, perdida de información.",
                "reference" => "http://nsis.sourceforge.net/Inetc_plug-in",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Suspicious User-Agent String (AskPartnerCobranding)",
                "description" => "\"Ask Partner Co branding\" es una barra de herramientas que suele aparecer en la parte superior de los navegadores, generalmente viene para tener enlaces de acceso rápido como son las del correo electrónico o bien modificando el motor de búsqueda. _x000D_\n_x000D_\nCabe señalar que cuando se hace uso de alguna herramienta de toolbar normalmente lo que hace es enviar peticiones hacia el dominio que se esté accediendo en ese momento, facilitando la recopilación de información o descargar algún tipo de malware, disminuyendo su velocidad de navegación, al mismo tiempo pone en riesgo a los usuarios con el robo de identidad._x000D_\n\n",
                "recommendation" => "Validar que el equipo involucrado tenga instalada dicha barra de herramientas, en caso de ser así desinstalar la barra de Ask:\nInicio, Panel de control.\nDesinstalar un programa.\nSeleccionar Ask.\nDar clic en el botón “Desinstalar”.\nEliminar los complementos de los navegadores web:\nAbrir el navegador web.\nIr a opciones o configuraciones y buscar el apartado de complementos o extensiones.\nDesinstalar los complementos no deseados.\nRealizar un análisis del equipo involucrado con un software antivirus para descartar la existencia de algún tipo de malware en el equipo por el uso de la barra de herramientas. ",
                "risk" => "Infección por código malicioso, afectación del rendimiento del equipo, recopilar información de navegación del usuario, perdida de información.",
                "reference" => "https://www.reasoncoresecurity.com/askpartnercobrandingtool.exe-289e6b203dd4226b5ab9a4262432e4fb06630ecb.aspx",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "TeamViewer Dyngate User-Agent",
                "description" => "TeamViewer es un software cuya función es conectarse remotamente a otro equipo, tal es la situación de TeamViewer Dyngate, esta alerta indica básicamente de cómo funciona el cliente TeamViewer de tal forma que el sitio está diciendo que se encuentra en línea._x000D_\n\nEsto es si se tiene la configuración de TeamViewer en un equipo y se crea una cuenta la cual es registrada en algún sitio, se añade el equipo remoto a alguna lista personal indicaría que cualquiera de los equipos remotos vienen en línea TeamViewer será informado._x000D_\n_x000D_\nBasicamente los programas que funcionan de forma remota suelen ser usados como objetivos de escaneos esto es identificar la versión que se encuentre instalada para después buscar algún exploit y con ello poder conseguir el acceso no autorizado al servicio, haciendo que el equipo al que se esté atacando sea vulnerable y el atacante tenga acceso total del equipo. _x000D_\n\n\n",
                "recommendation" => "Validar que el uso de la aplicación TeamViewer se encuentra permitida dentro de la institución, en caso de no estar permitida se sugiere desinstalar la aplicación del equipo.          \nUtilizar VPN y software de acceso remoto que se encuentre dentro de las políticas de seguridad de la empresa.\nRestringir en lo posible el uso de programas de acceso remoto, lo cual se logra llevando un control de aplicaciones permitidas.",
                "risk" => "Violación a las políticas de uso de software de la institución.   \nAcceso a usuarios no autorizado.\n Fuga de información sensible.",
                "reference" => "https://www.teamviewer.com/es/download/currentversion.aspx\n\nhttp://tecnomonkey.co/blog/?p=79",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "TeamViewer Keep-alive inbound",
                "description" => "TeamViewer es un software cuya función es conectarse remotamente a otro equipo, la alerta keep-alive se muestra porque los equipos que se encuentran conectados de forma remota han perdido la conexión y no están conectados a ningún servidor. Esto es que los equipos han perdido toda comunicación para poder trabajar de forma remota.\n_x000D_\nBasicamente los programas que funcionan de forma remota suelen ser usados como objetivos de escaneos, esto es identificar la versión que se encuentre instalada para después buscar algún exploit y con ello poder conseguir el acceso no autorizado al servicio, haciendo que el equipo al que se esté atacando sea vulnerable y el atacante tenga acceso total del equipo. _x000D_\n\n",
                "recommendation" => "Validar que el uso de la aplicación TeamViewer se encuentra permitida dentro de la institución, en caso de no estar permitida se sugiere desinstalar la aplicación del equipo.          \nUtilizar VPN y software de acceso remoto que se encuentre dentro de las políticas de seguridad de la empresa.\nRestringir en lo posible el uso de programas de acceso remoto, lo cual se logra llevando un control de aplicaciones permitidas.",
                "risk" => "Violación a las políticas de uso de software de la institución.   \nAcceso a usuarios no autorizado.\n Fuga de información sensible.",
                "reference" => "http://www.ixiacom.com/about-us/news-events/corporate-blog/magic-teamviewer",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Terminal Server User A Login, possible Morto inbound",
                "description" => "Morto es un gusano que se propaga a través del protocolo de Escritorio Remoto de Windows (RDP), explotando contraseñas débiles que algunos usuarios o administradores pueden utilizar. _x000D_\n_x000D_\nEl protocolo RDP fue desarrollado por Microsoft y permite las conexiones a escritorios remotos, el cual hace uso de este protocolo para poder propagarse entre sus funciones que tiene es, reportar a un Centro de Control (C&C), desde donde recibe órdenes para realizar la instalación de otros códigos maliciosos y efectuar ataques de denegación de servicio(DoS).\n",
                "recommendation" => "Realizar un análisis de los equipos involucrados con un software antivirus para descartar la existencia de algún tipo de malware que esté realizando dicha actividad.      Reforzar la seguridad del equipo involucrados con contraseñas robustas, para dificultar el acceso a los equipos, se recomienda que las contraseñas cumplan con las siguientes características:\n• Contener al menos 12 caracteres.\n• Utilizar caracteres especiales.\n• Mezclar números, letras y caracteres.\n• Utilizar letras mayúsculas y minúsculas.",
                "risk" => "Afectación del rendimiento del equipo, ataque por fuerza bruta,  robo de información, pérdida o fuga de información.",
                "reference" => "https://threatpost.com/new-worm-morto-using-rdp-infect-windows-pcs-082811/75585",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "TFTP Outbound TFTP Write Request",
                "description" => "Esta firma se presenta al detectar peticiones de conexión a través del puerto 69, el cual es usado para el protocolo de Transferencia de Archivos Trivial (TFTP), usado comúnmente para realizar configuraciones de red internas._x000D_\n_x000D_\nDichas peticiones buscan realizar cambios en la configuración interna de la red. Esta vulnerabilidad podría poner en riesgo la seguridad del equipo permitiendo acceso al equipo sin autorización, fuga de información e incluso acceso a diversos recursos en la red.     _x000D_\n\n\n",
                "recommendation" => "• Validar que la comunicación entre los equipos sea legítima.\n• Validar si el uso del servicio TFTP es necesario en los equipos involucrados, de lo contrario desactivar el servicio.\n*Realizar un análisis de los equipos involucrados con un software antivirus para descartar la existencia de algún tipo de malware que esté realizando dicha actividad.",
                "risk" => "Infección por código malicioso, fuga de información.",
                "reference" => "http://www.speedguide.net/port.php?port=69\n\nhttps://www-01.ibm.com/support/knowledgecenter/SSB23S_1.1.0.10/com.ibm.ztpf-ztpfdf.doc_put.10/gtpc1/gtpc1mst114.html\n\nhttp://www.tcpipguide.com/free/t_TFTPDetailedOperationandMessaging.htm",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "TFTP Put",
                "description" => "La detección de actividad inusual dentro de los equipos de cómputo con respecto a la firma se presenta al detectar el Protocolo de Transferencia de Archivos Trivial (TFTP), el cual se emplea para enviar archivos de configuración entre equipos de una red._x000D_\n\nLa firma detecta la petición de ejecución de un comando “put”, el cual se emplea para cargar un archivo en el equipo con el cual se tiene establecido la conexión, realizando cambios en la configuración interna de la red. Esta vulnerabilidad podría poner en riesgo la seguridad de la información y el equipo ya que la confidencialidad, la integridad y la disponibilidad del equipo estarían comprometidas.                   \n_x000D_\n\n",
                "recommendation" => "• Validar que la comunicación entre los equipos sea legítima.\n• Validar si el uso del servicio TFTP es necesario en los equipos involucrados, de lo contrario desactivar el servicio.",
                "risk" => "Acceso al equipo de usuarios no autorizados, Infección por código malicioso, fuga de información.",
                "reference" => "http://www.speedguide.net/port.php?port=69\n\nhttps://www-01.ibm.com/support/knowledgecenter/SSB23S_1.1.0.10/com.ibm.ztpf-ztpfdf.doc_put.10/gtpc1/gtpc1mst114.html\n\nhttp://www.tcpipguide.com/free/t_TFTPDetailedOperationandMessaging.htm",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "ThunderNetwork UDP Traffic",
                "description" => "La detección de actividad inusual dentro de los equipos de cómputo con respecto a la firma, se puede identificar el uso de “ThunderNetwork (Xunlei)”, el cual es un programa empleado para la transferencia de archivos a través de “BitTorrent”_x000D_._x000D_\nBitTorrent es un protocolo diseñado para el intercambio de archivos P2P (Peer to Peer) en Internet, siendo uno de los protocolos más comunes para la transferencia de archivos grandes. _x000D_\n_x000D_\nEl uso de aplicaciones que utilizan redes P2P pone en riesgo la seguridad de la información en los equipos de cómputo, ya que puede provocar la fuga de información sensible y son foco de infección de malware, así como puede incurrir en una violación a las políticas internas por el uso indebido de software ajeno a la institución.\n_x000D__x000D_\n\n",
                "recommendation" => "*Validar que las conexiones entre los equipos sean legítimas.\n*Revisar las políticas de uso de la red y de los equipos y validar si el uso de aplicaciones P2P se encuentran permitidas dentro de la institución, en caso de no estar permitida se sugiere desinstalar la aplicación del equipo.",
                "risk" => "Violación a las políticas de uso de software de la institución, Infección por código malicioso, fuga de información.",
                "reference" => "http://web.dit.upm.es/~jmseyas/linux/mcast.como/Multicast-Como-2.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "TLS possible TOR SSL traffic",
                "description" => "La detección de TOR que son las siglas del nombre en inglés “The Onion Router”, el cual es un programa que permite a usuarios tener anonimato en sus actividades en línea. Básicamente usa varias computadoras localizadas en diversas partes del mundo, para dirigir el tráfico de Internet, haciendo virtualmente imposible la localización y rastreo de la actividad en Internet de un usuario. _x000D_\n_x000D_\nLa peligrosidad de su uso está presente, puesto que mediante TOR se puede acceder a sitios con contenido ilegal tales como: pornografía infantil, venta de estupefacientes, acceso a programas maliciosos, entre otros.\n_x000D_\nPor lo que el uso de este software en una organización es potencialmente riesgoso, ya que se encuentra expuesto a diversas amenazas tales como código malicioso y vulnerabilidades a un ataque de día cero (0 day).  Así como puede incurrir en una violación a las políticas internas por el uso indebido de software ajeno a la institución\n_x000D_",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar si el equipo relacionado con la dirección IP reportada tiene instalado algún programa para el uso de la red TOR.\n   o En caso de encontrarse algún programa de este tipo se recomienda desinstalarlo inmediatamente.\n• Verificar las configuraciones de red del equipo, en busca de algún cambio en los parámetros de Proxy definidos por la institución.\n• Bloquear el dominio reportado:\n   o En el archivo “hosts” del equipo reportado.\n   o En caso de contar con un servidor de filtrado de contenido web, bloquearlo.\n• Analizar el equipo relacionado con el evento con un software antivirus actualizado para descartar la presencia de Malware que realice las peticiones.",
                "risk" => "Violación a las políticas de uso de software de la institución, Infección por código malicioso, fuga de información, tráfico en la red local, comunicación.",
                "reference" => "http://aprenderinternet.about.com/od/Glosario/g/Que-es-Tor.htm \n\nhttps://prism-break.org/es/projects/tor/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Tomcat admin-admin login credentials",
                "description" => "Esta firma se presenta al detectar actividad inusual de peticiones de conexión con direcciones IP públicas, las cuales se intentan autenticar a través del puerto 8080, el cual es usado como una alternativa al servicio de HTTP._x000D_\n_x000D_\nEn las peticiones se encuentra la cabecera \"Authorization: Basic\", que es usada como método de autenticación para enviar usuarios y contraseñas cifrados mediante el algoritmo Base64, el cual es un algoritmo débil y fácil de descifrar. Esta vulnerabilidad podría poner en riesgo la seguridad de la información y el equipo ya que la confidencialidad, la integridad y la disponibilidad del equipo estarían comprometidas._x000D_\n_x000D_\n\n",
                "recommendation" => "Implementar un mecanismo de cifrado en los sistemas de autenticación de usuarios de portales institucionales.\nAplicar las actualizaciones y parches de seguridad del servicio que se este utilizando en el servidor web y del Sistema Operativo.\nReforzar la seguridad del equipo o equipos utilizando contraseñas robustas, para dificultar el acceso de personas o entidades malintencionadas, se recomienda que las contraseñas cumplan con las siguientes características:\nContener al menos 12 caracteres.\nUtilizar caracteres especiales.\nMezclar números, letras y caracteres.\nUtilizar letras mayúsculas y minúsculas.",
                "risk" => "Acceso no autorizado, robo de información sensible,  robo de credenciales.",
                "reference" => "http://www.speedguide.net/port.php?port=8080\n\nhttp://www.httpwatch.com/httpgallery/authentication/\nhttp://www.pcdigital.org/encriptar-y-desencriptar-texto-en-base64/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Tomcat admin-blank login credentials",
                "description" => "Apache Tomcat es una plataforma utilizada para manejar páginas de servidores JAVA, al instalarse, lo hace con parámetros por defecto, entre ellos credenciales muy débiles de autenticación para la interfaz de administración web del servicio._x000D_\nLa contraseña preestablecida para el usuario “admin”, tiene un valor vacío (en blanco), como resultado de esto cualquier persona que acceda a la interfaz de administración puede tener acceso completo al equipo.",
                "recommendation" => "Implementar un mecanismo de cifrado en los sistemas de autenticación de usuarios de portales institucionales.\nAplicar las actualizaciones y parches de seguridad del servicio que se este utilizando en el servidor web y del Sistema Operativo.\nReforzar la seguridad del equipo o equipos utilizando contraseñas robustas, para dificultar el acceso de personas o entidades malintencionadas, se recomienda que las contraseñas cumplan con las siguientes características:\nContener al menos 12 caracteres.\nUtilizar caracteres especiales.\nMezclar números, letras y caracteres.\nUtilizar letras mayúsculas y minúsculas.",
                "risk" => "Acceso no autorizado, robo de información sensible,  robo de credenciales.",
                "reference" => "http://blog.opensecurityresearch.com/2012/09/manually-exploiting-tomcat-manager.html\nhttp://www.rapid7.com/db/vulnerabilities/http-tomcat-manager-blank-admin-password",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "ET WEB_SERVER WebShell Generic - net user",
                "description" => "Las WebShells son herramientas utilizadas por usuarios mal intencionados para acceder a recursos o ejecutar comandos remotos en un sistema infectado. Muchas de estas pueden ser instaladas a través de vulnerabilidades explotadas en sitios web o directamente colocadas al tener acceso con cierto nivel de privilegios al servidor.",
                "recommendation" => "Se recomienda tomar las siguientes acciones:\n\n- Realizar un análisis de vulnerabilidades al equipo afecto a fin de encontrar posibles vulnerabilidades públicas que pudieran haber sido explotadas para acceder a sus recursos.\n- Realizar un análisis de los usuarios y procesos del sistema en el equipo afectado.\n- Realizar un análisis de tráfico del equipo afecto a fin de detectar posibles fugas de información y las fuentes y destinos de las conexiones.\n- Eliminar el directorio en donde se haya encontrado la WebShell.\n- De ser posible formatear el equipo a fin de evitar problemas futuros.",
                "risk" => "Robo de información \nAcceso al sistema",
                "reference" => "http://labs.sucuri.net/db/malware/backdoor-phpwebshell03",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Tomcat Auth Brute Force attempt (tomcat)",
                "description" => "Se realizó un ataque de fuerza bruta en contra del usuario “tomcat\" en un equipo que utiliza el servidor web Apache-Tomcat. Dicho ataque utilizó la cabecera “Authenticate” del protocolo HTTP, la cual es utilizada como mecanismo de autenticación para controlar el acceso a páginas y a otros recursos._x000D_\nFuerza bruta es un método que sirve para obtener acceso no autorizado a algún sistema, para lograr esto, se utiliza software especializado que se encarga de probar todas las posibles combinaciones de caracteres (o mediante un diccionario de contraseñas) hasta conseguir la contraseña correcta del usuario.",
                "recommendation" => "Implementar un mecanismo de cifrado en los sistemas de autenticación de usuarios de portales institucionales.\nAplicar las actualizaciones y parches de seguridad del servicio que se este utilizando en el servidor web y del Sistema Operativo.\nReforzar la seguridad del equipo o equipos utilizando contraseñas robustas, para dificultar el acceso de personas o entidades malintencionadas, se recomienda que las contraseñas cumplan con las siguientes características:\nContener al menos 12 caracteres.\nUtilizar caracteres especiales.\nMezclar números, letras y caracteres.\nUtilizar letras mayúsculas y minúsculas.",
                "risk" => "Acceso no autorizado, robo de información sensible,  robo de credenciales.",
                "reference" => "http://blog.opensecurityresearch.com/2012/09/manually-exploiting-tomcat-manager.html\nhttp://www.rapid7.com/db/vulnerabilities/http-tomcat-manager-blank-admin-password",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Tool.InstallToolbar.24 Reporting",
                "description" => "Tool.InstallToolbar.24 se encuentra catalogado como un PUP (Programa Potencialmente no Deseado) por sus iniciales en inglés. Los programas no deseados tienen la capacidad de realizar cambios en el equipo o en los navegadores web sin consentimiento del usuario. _x000D_\nEste Adware secuestra el navegador (realiza cambios en las configuraciones, como modificar la página de inicio, cambiar el motor de búsqueda, etc.), barras de herramientas y redirige las búsquedas hechas a sitios maliciosos o de mala reputación.",
                "recommendation" => "Validar que el equipo involucrado tenga instalada dicha barra de herramientas, en caso de ser así desinstalar :\nInicio, Panel de control.\nDesinstalar un programa.\nSeleccionar Tool.InstallToolbar.\nDar clic en el botón “Desinstalar”.\nEliminar los complementos de los navegadores web:\nAbrir el navegador web.\nIr a opciones o configuraciones y buscar el apartado de complementos o extensiones.\nDesinstalar los complementos no deseados.\nRealizar un análisis del equipo involucrado con un software antivirus para descartar la existencia de algún tipo de malware en el equipo por el uso de la barra de herramientas. ",
                "risk" => "Afectación del rendimiento del equipo, recopilar información de navegación del usuario, perdida de información, infección por código malicioso.",
                "reference" => "http://emacswiki.org/emacs/ToolBar",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "TOR 1.0 Server Key Retrieval",
                "description" => "Se refiere a un cliente TOR que recupera la llave pública de un servidor TOR al solicitar un servicio ofrecido por el mismo, esto sucede por la forma en la que funciona dicha red._x000D_\n_x000D_TOR (The Onion Router por sus siglas en inglés) es un proyecto que permite a usuarios tener anonimato al realizar sus actividades en línea. Esto se logra mediante una técnica denominada “onion routing” en la que las peticiones son cifradas cada vez que viajan de un nodo al siguiente.",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar si el equipo relacionado con la dirección IP reportada tiene instalado algún programa para el uso de la red TOR.\n   o En caso de encontrarse algún programa de este tipo se recomienda desinstalarlo inmediatamente.\n• Verificar las configuraciones de red del equipo, en busca de algún cambio en los parámetros de Proxy definidos por la institución.\n• Bloquear el dominio reportado:\n   o En el archivo “hosts” del equipo reportado.\n   o En caso de contar con un servidor de filtrado de contenido web, bloquearlo.\n• Analizar el equipo relacionado con el evento con un software antivirus actualizado para descartar la presencia de Malware que realice las peticiones.",
                "risk" => "El riesgo que conlleva el uso de programas o visitas a sitios no permitidos por la organización es la infección por malware y la propagación de éste a los sistemas de la organización.",
                "reference" => "http://aprenderinternet.about.com/od/Glosario/g/Que-es-Tor.htm",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Tor Get Server Request",
                "description" => "Se detectó cierta actividad causada por el uso de la aplicación Tor Browser, la red Tor está diseñada para navegar a través de la web con la mayor confidencialidad posible, es deci,r asegura el anonimato._x000D_\n_x000D_Básicamente usa varias computadoras, localizadas en diversas partes del mundo, para dirigir el tráfico de Internet, haciendo virtualmente imposible la localización y rastreo de la actividad en Internet de un usuario dado._x000D__x000D_\nEl uso de esta aplicación puede dar pauta a visitar sitios potencialmente peligrosos y exponer el equipo a fuga de información, robo de datos personales, infección de malware, etc.",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar si el equipo relacionado con la dirección IP reportada tiene instalado algún programa para el uso de la red TOR.\n   o En caso de encontrarse algún programa de este tipo se recomienda desinstalarlo inmediatamente.\n• Verificar las configuraciones de red del equipo, en busca de algún cambio en los parámetros de Proxy definidos por la institución.\n• Bloquear el dominio reportado:\n   o En el archivo “hosts” del equipo reportado.\n   o En caso de contar con un servidor de filtrado de contenido web, bloquearlo.\n• Analizar el equipo relacionado con el evento con un software antivirus actualizado para descartar la presencia de Malware que realice las peticiones.",
                "risk" => "El riesgo que conlleva el uso de programas o visitas a sitios no permitidos por la organización es la infección por malware y la propagación de éste a los sistemas de la organización.",
                "reference" => "https://www.torproject.org/about/torusers.html.en\nhttp://lifehacker.com/what-is-tor-and-should-i-use-it-1527891029",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "TROJAN Suspicious User-Agent (HTTP Downloader",
                "description" => "Se refiere a una posible descarga de código malicioso identificada por la cabecera de user-agent._x000D_\nEl User-Agent o Agente de usuario, es un parámetro del protocolo HTTP. Cuando un usuario accede a una página web, generalmente se envía una cadena de texto que forma parte del pedido a través de HTTP, incluye información como el nombre de la aplicación, la versión, el sistema operativo y el idioma._x000D_",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Identificar el equipo de red interna y realizar una revisión para descartar la infección por algún tipo de código malicioso.\n*Validar la comunicación entre estos equipos, en caso de no ser necesaria, se recomienda proceder con el bloqueo puntual de la comunicación en el firewall perimetral.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.",
                "risk" => "Recopilar información tanto del usuario como del equipo afectado.\nAfectación del rendimiento del equipo.\nPérdida de información sensible.",
                "reference" => "http://vrt-blog.snort.org/2012/11/web-proxies-user-agent-strings-and.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "TOR Known Tor Relay/Router (Not Exit) Node TCP Traffic group 80 Known TOR Exit Node TCP Traffic group 80",
                "description" => "Se detectó cierta actividad causada por el uso de la aplicación Tor Browser, la red Tor está diseñada para navegar a través de la web con la mayor confidencialidad posible, es decir asegura el anonimato._x000D_\n_x000D_Básicamente usa varias computadoras, localizadas en diversas partes del mundo, para dirigir el tráfico de Internet, haciendo virtualmente imposible la localización y rastreo de la actividad en Internet de un usuario dado._x000D_\n_x000D_El uso de esta aplicación puede dar pauta a visitar sitios potencialmente peligrosos y exponer el equipo a fuga de información, robo de datos personales, infección de malware, etc.",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar si el equipo relacionado con la dirección IP reportada tiene instalado algún programa para el uso de la red TOR.\n   o En caso de encontrarse algún programa de este tipo se recomienda desinstalarlo inmediatamente.\n• Verificar las configuraciones de red del equipo, en busca de algún cambio en los parámetros de Proxy definidos por la institución.\n• Bloquear el dominio reportado:\n   o En el archivo “hosts” del equipo reportado.\n   o En caso de contar con un servidor de filtrado de contenido web, bloquearlo.\n• Analizar el equipo relacionado con el evento con un software antivirus actualizado para descartar la presencia de Malware que realice las peticiones.",
                "risk" => "Violación a las políticas de uso de software de la institución, Infección por código malicioso, fuga de información, tráfico en la red local, comunicación.",
                "reference" => "https://www.torproject.org/about/torusers.html.en\nhttp://lifehacker.com/what-is-tor-and-should-i-use-it-1527891029",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Torrent",
                "description" => "Se detecta el uso de un cliente de red P2P, estas aplicaciones usan el protocolo \"bittorrent\". El protocolo bitttorrent es un protocolo diseñado para el intercambio de archivos punto a punto._x000D_\n_x000D_En algunos casos el contenido de los archivos intercambiados puede no ser lo que se busca, aparte de poder estar infectados por malware, puede permitir la fuga de información sensible, así como el acceso sin autorización a los equipos institucionales.",
                "recommendation" => "Se recomienda llevar a cabo las siguientes acciones:\n• Verificar las políticas de uso de la red y uso del equipo de cómputo.\n• Validar si el uso de software como aplicaciones P2P están dentro de las aplicaciones permitidas por la institución.\n   o En caso de no contar con dichas políticas, implementarlas.\n   o Si el uso de este tipo de aplicaciones no esté permitido, se sugiere localizar los equipos relacionados y desinstalar cualquier aplicación no autorizada por la institución.\n• Analizar el equipo reportado con un software antivirus actualizado para descartar la presencia de Malware.",
                "risk" => "Recepción de archivos con código malicioso.\nRecepción de archivos falsos.\nViolar la propiedad intelectual con archivos de contenido de dudosa procedencia.\nPerdida de información sensible.\nUso de recursos del sistema innecesario.\nSaturar el tráfico en la red.\nEl uso de estos programas aumenta la probabilidad de recibir ataques.",
                "reference" => "https://es.wikipedia.org/wiki/Archivo_Torrent",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "TROJAN Brontok User-Agent Detected (Brontok.A3 Browser)",
                "description" => "Brontok se considera un gusano de correo electrónico masivo con la capacidad de copiarse en las unidades de almacenamiento extraíble. Cuando un equipo queda infectado, el gusano se instala y descarga un archivo de un servidor remoto, también se auto replica ocultando las copias en los archivos del sistema usando diversos nombres idénticos a los del sistema Windows, como, csrss.exe, lsass.exe, services.exe, smss.exe o winlogon.exe. Posteriormente procede a infectar más equipos por medio de mensajes de correo electrónico que obtiene analizando el equipo en el que se encuentra instalado. También modifica el registro del sistema para poder reducir la configuración de seguridad del equipo.",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Localizar el equipo perteneciente a la red interna y realizar un escaneo del dispositivo con la finalidad de descartar infecciones por código malicioso mediante el uso de software Antivirus/Antimalware actualizado con las firmas más recientes.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Posterior al análisis de Malware se deberá verificar que el equipo cuente con las últimas actualizaciones proporcionadas por el fabricante. Es necesario realizar regularmente la actualización de las aplicaciones y Sistema Operativo con la finalidad de mitigar las vulnerabilidades.\n*Si la actividad reincide, aislar el o los equipos infectados y desconectarlos de la red para evitar la propagación e infección de más equipos, posteriormente proceder con su desinfección en un ambiente controlado.",
                "risk" => "Recopilar información tanto del usuario como del equipo afectado.\nAfectación del rendimiento del equipo.\nPérdida de información sensible.",
                "reference" => "http://www.bitdefender.co.uk/free-virus-removal/#Win32.Brontok.A@mm",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "TROJAN Downadup/Conficker A or B Worm reporting",
                "description" => "La actividad generada muestra la características de Conficker/Downadup/Kido, un gusano que se propaga mediante la explotación del servicio RPC de Windows Server Microsoft, que administra la vulnerabilidad remota para la ejecución del código. Además se propaga a través de los recursos compartidos de red protegida por contraseñas débiles, bloquea el acceso a sitios web relacionados con la seguridad.\nLa manera de propagación de este gusano es mediante cualquier dispositivo de almacenamiento extraíble, dentro del dispositivo crea un archivo \"autorun.inf\" cuya acción sea auto ejecutar la copia del gusano cada vez que se conecta el dispositivo extraíble infectado a un equipo.",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Localizar el equipo perteneciente a la red interna y realizar un escaneo del dispositivo con la finalidad de descartar infecciones por código malicioso mediante el uso de software Antivirus/Antimalware actualizado con las firmas más recientes.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Posterior al análisis de Malware se deberá verificar que el equipo cuente con las últimas actualizaciones proporcionadas por el fabricante. Es necesario realizar regularmente la actualización de las aplicaciones y Sistema Operativo con la finalidad de mitigar las vulnerabilidades.",
                "risk" => "Recopilar información tanto del usuario como del equipo afectado.\nAfectación del rendimiento del equipo.\nPérdida de información sensible.",
                "reference" => "http://www.microsoft.com/security/portal/threat/encyclopedia/entry.aspx?Name=%0A%09%09%09%09Worm:Win32/Conficker.B%0A%09%09%09%09",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "ET POLICY Logmein.com/Join.me SSL Remote Control Access",
                "description" => "LogMeIn es una aplicación para conferencias, que entre sus carácteristicas incluye una opción para otorgar control sobre un equipo remoto a fin de compartir información entre los participantes.\n\nLa información que transmitida se encuentra cifrada por medio de SSL, lo cual puede ser utilizado por un usuario mal intencionado para extraer inforamción sensible de los equipos de la organización.",
                "recommendation" => "Se recomienda hacer un análisis de las políticas de seguridad de la organización a fin de determinar si es necesario el uso de aplicaciones de conferencia con opción de control de equipo remoto, en caso de que no se recomienda deshabilitar el uso de cualquier aplicación de administración de equipos remota o reducir su uso únicamente a usuarios que así lo requieran debido a los objetivos de negocio.",
                "risk" => "Robo de información",
                "reference" => "",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "TROJAN MultiPlug.J Checkin",
                "description" => "Se detectó la presencia del Adware Multiplug que se propaga a través de visitas a sitios web maliciosos o mediante la descarga software pirata.\nMultiplug es un programa potencialmente no deseado (PUP por siglas en inglés), dicho adware tiene la capacidad de mostrar anuncios en los navegadores de Internet, modificando las páginas de inicio o abriendo publicidad, instala adicionalmente su propia barra de herramientas.\nPor lo general, este tipo de adware se instala sin conocimiento del usuario al momento de instalar algún otro software (normalmente a cambio de usar el software gratuito o como una opción de instalación predeterminada), generando fallas en el rendimiento del equipo infectado y son puertas traseras para algún tipo de malware.",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Localizar el equipo perteneciente a la red interna y realizar un escaneo del dispositivo con la finalidad de descartar infecciones por código malicioso mediante el uso de software Antivirus/Antimalware actualizado con las firmas más recientes.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Posterior al análisis de Malware se deberá verificar que el equipo cuente con las últimas actualizaciones proporcionadas por el fabricante. Es necesario realizar regularmente la actualización de las aplicaciones y Sistema Operativo con la finalidad de mitigar las vulnerabilidades.",
                "risk" => "Recopilar información tanto del usuario como del equipo afectado.\nAfectación del rendimiento del equipo.\nPérdida de información sensible.",
                "reference" => "http://www.virusradar.com/en/Win32_Adware.MultiPlug.J/description",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "TROJAN Possible TorLocker Ransomware Downloading Tor",
                "description" => "La actividad generada muestra la característica de TorLocker Ransomware, un Malware que se instala en los sistemas operativos Windows mediante correos electrónicos falsos (spam), herramientas de hackers, botnets y falsas actualizaciones de programas.\nTorLocker Ransomware cifra los archivos almacenados del equipo infectado para después exigir un pago para descifrarlos, utiliza la red Tor para comunicarse con un servidor command and control (C&C) para transferir la información y datos de pago.",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Localizar el equipo perteneciente a la red interna y realizar un escaneo del dispositivo con la finalidad de descartar infecciones por código malicioso mediante el uso de software Antivirus/Antimalware actualizado con las firmas más recientes.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Posterior al análisis de Malware se deberá verificar que el equipo cuente con las últimas actualizaciones proporcionadas por el fabricante. Es necesario realizar regularmente la actualización de las aplicaciones y Sistema Operativo con la finalidad de mitigar las vulnerabilidades.",
                "risk" => "Recopilar información tanto del usuario como del equipo afectado.\nAfectación del rendimiento del equipo.\nPérdida de información sensible.",
                "reference" => "https://securelist.com/blog/research/69481/a-flawed-ransomware-encryptor/\nhttp://www.symantec.com/connect/blogs/torlocker-ransomware-variant-designed-target-japanese-users",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "TROJAN Sality - Fake Opera User-Agent",
                "description" => "W32.Sality es un Malware que afecta diversas versiones del sistema operativo Windows. Su función es infectar archivos ejecutables en dispositivos locales, compartidos y extraíbles.\nDicho virus también crea una botnet punto a punto (P2P) y recibe la URL para iniciar la descarga de archivos adicionales, al final intentará deshabilitar cualquier software de seguridad presente en el equipo.\nAdemás, este virus también busca claves específicas del registro de Windows para infectar los archivos que se ejecutan cuando inicia el sistema operativo, reemplazando el código original de los archivos infectados por una copia cifrada del código viral.",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Localizar el equipo perteneciente a la red interna y realizar un escaneo del dispositivo con la finalidad de descartar infecciones por código malicioso mediante el uso de software Antivirus/Antimalware actualizado con las firmas más recientes.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Posterior al análisis de Malware se deberá verificar que el equipo cuente con las últimas actualizaciones proporcionadas por el fabricante. Es necesario realizar regularmente la actualización de las aplicaciones y Sistema Operativo con la finalidad de mitigar las vulnerabilidades.",
                "risk" => "Recopilar información tanto del usuario como del equipo afectado.\nAfectación del rendimiento del equipo.\nPérdida de información sensible.",
                "reference" => "http://blog.eset.ie/2014/04/02/esets-technical-dissection-of-win32sality-trojan/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "TROJAN Suspicious UA (^IE[\\d\\s]",
                "description" => "Se refiere a que se encontró la cadena IE en la cabecera del user-agent, posiblemente intentando hacer referencia al explorador web Internet Explorer, pero el user agent de este navegador es MSIE concatenado con la versión. Dicho user-agent sospechoso no sigue con el estándar especificado en el RFC RFC2616, lo que puede significar que sea producido por algún tipo de malware.",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Localizar el equipo perteneciente a la red interna y realizar un escaneo del dispositivo con la finalidad de descartar infecciones por código malicioso mediante el uso de software Antivirus/Antimalware actualizado con las firmas más recientes.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Posterior al análisis de Malware se deberá verificar que el equipo cuente con las últimas actualizaciones proporcionadas por el fabricante. Es necesario realizar regularmente la actualización de las aplicaciones y Sistema Operativo con la finalidad de mitigar las vulnerabilidades.",
                "risk" => "Recopilar información tanto del usuario como del equipo afectado.\nAfectación del rendimiento del equipo.\nPérdida de información sensible.",
                "reference" => "http://malware-traffic-analysis.net/2014/02/11/index.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Unsupported/Fake Windows NT Version 5.0",
                "description" => "Se refiere a que se ha identificado el uso de la plataforma Windows 2000 mediante la cabecera user-agent, donde el parámetro Plataform Token hace referencia a Windos NT 5.0._x000D_\nAl sistema operativo Windows 2000 se le dejó de dar soporte desde el 13 de julio del 2010, por lo que se le considera obsoleto ya que no se lanzarán más actualizaciones o parches de seguridad._x000D_",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Identificar el equipo de red interna y realizar una revisión para descartar la infección por algún tipo de código malicioso.\n*Validar la comunicación entre estos equipos, en caso de no ser necesaria, se recomienda proceder con el bloqueo puntual de la comunicación en el firewall perimetral.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.",
                "risk" => "Ejecución de código malicioso.\nPérdida de información sensible.",
                "reference" => "http://lavasoft.com/mylavasoft/malware-descriptions/blog/Shiz352af6f98e",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "UnsupportedFake Internet Explorer Version MSIE 5",
                "description" => "Se refiere a que se ha identificado el uso del navegador web Internet Explorer versión 5 mediante la cabecera user-agent, donde el parámetro Version Token hace referencia a MSIE 5._x000D_\nEl navegador web Internet Explorer versión 5, fue lanzado en 1999, carece de compatibilidad con sistemas operativos Windows XP y posteriores, se le dejó de dar soporte desde el año 2000, fue reemplazado por la versión 6.0 en el año 2001, por lo que se le considera obsoleto ya que no se lanzarán más actualizaciones o parches de seguridad._x000D_",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Identificar el equipo de red interna y realizar una revisión para descartar la infección por algún tipo de código malicioso.\n*Validar la comunicación entre estos equipos, en caso de no ser necesaria, se recomienda proceder con el bloqueo puntual de la comunicación en el firewall perimetral.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.",
                "risk" => "Ejecución de código malicioso.\nPérdida de información sensible.",
                "reference" => "http://www.howtogeek.com/113439/how-to-change-your-browsers-user-agent-without-installing-any-extensions/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "USER_AGENTS Potential Avzhan DDOS Bot or abnormal User-Agent",
                "description" => "Se detectaron peticiones con una cabecera User-Agent anormal. _x000D_\nSe identificó en las peticiones características relacionadas con el malware Avzhan. Dicho malware está catalogado como troyano y botnet debido a su forma de propagarse; su método de funcionamiento consiste en infectar equipos mediante un troyano que una vez que infecta el equipo objetivo, se instala como un servicio de Windows que se inicia automáticamente. Después de infectar el equipo, el Bot se registra con un servidor mediante el envío de información sobre el huésped infectado.\nUna vez registrado, puede recibir comandos desde el servidor remoto para realizar ataques DDoS mediante peticiones HTTP GET o puede dar lugar a la descarga e instalación de otro tipo de malware.\n\n",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Identificar el equipo de red interna y realizar una revisión para descartar la infección por algún tipo de código malicioso.\n*Validar la comunicación entre estos equipos, en caso de no ser necesaria, se recomienda proceder con el bloqueo puntual de la comunicación en el firewall perimetral.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.",
                "risk" => "Recopilar información tanto del usuario como del equipo afectado.\nAfectación del rendimiento del equipo.\nPérdida de información sensible.",
                "reference" => "https://asert.arbornetworks.com/another-family-of-ddos-bots-avzhan/\n\nhttp://www.symantec.com/security_response/attacksignatures/detail.jsp?asid=23930\n\nhttp://telussecuritylabs.com/threats/show/TSL20100924-03\n\nhttp://securityposts.blogspot.mx/2011/03/trojanavzhan.html\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "USER_AGENTS Suspicious Win32 User Agent",
                "description" => "Se detectaron peticiones que contienen en la cabecera User-Agent la cadena de texto Win32._x000D_\nWin32 es una cadena genérica para determinar archivos que realizan diversas acciones maliciosas en un equipo infectado, debido a esto el propósito del malware puede ser variado afectando el correcto funcionamiento del equipo.\n",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Identificar el equipo de red interna y realizar una revisión para descartar la infección por algún tipo de código malicioso.\n*Validar la comunicación entre estos equipos, en caso de no ser necesaria, se recomienda proceder con el bloqueo puntual de la comunicación en el firewall perimetral.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.",
                "risk" => "Recopilar información tanto del usuario como del equipo afectado.\nAfectación del rendimiento del equipo.\nPérdida de información sensible.",
                "reference" => "http://www.microsoft.com/security/portal/threat/encyclopedia/entry.aspx?Name=Win32/Agent#tab=2\n\nhttp://www.sans.org/reading-room/whitepapers/detection/60-seconds-wire-malicious-traffic-34307\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Variant.Kazy.53640 Malformed Client Hello SSL 3.0 (Cipher_Suite length greater than Client_Hello Length)",
                "description" => "Se detectaron peticiones las cuales contienen características anormales y están relacionadas con una variante del malware Kazy, además de que utilizan el protocolo de cifrado SSL 3.0 el cual contiene diversas vulnerabilidades.\nKazy es un troyano que permite llevar a cabo intrusiones contra el ordenador afectado, además permite capturas de pantalla del equipo infectado, recolección de datos personales, entre otros. Su método de propagación es mediante el envío de archivos FTP, canales IRC o el uso de redes P2P.\n_x000D_\n",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Identificar el equipo de red interna y realizar una revisión para descartar la infección por algún tipo de código malicioso.\n*Validar la comunicación entre estos equipos, en caso de no ser necesaria, se recomienda proceder con el bloqueo puntual de la comunicación en el firewall perimetral.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.",
                "risk" => "Recopilar información tanto del usuario como del equipo afectado.\nAfectación del rendimiento del equipo.\nPérdida de información sensible.",
                "reference" => "https://technet.microsoft.com/en-us/library/cc785811(v=ws.10).aspx\n\nhttp://www.pandasecurity.com/mexico/homeusers/security-info/224324/Kazy.C\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "VBSAutorun_VBS_Jenxcus Check-in UA",
                "description" => "Se detectaron peticiones con una cabecera User-Agent anormal, el User-Agent esta relacoinado con el malware Jenxcus._x000D_\nJenxcus es considerado un worm, debido a que tiene la capacidad de infectar otros dispositivos conectados en el equipo infectado. La infección puede ser mediante la ejecución manual del archivo infectado. También se encuentra en sitios web que realizan ataque del tipo Drive-By download que permite instalar generalmente software malicioso al acceder a un sitio web sin autorización del usuario.\nEste worm pude robar información del equipo infectado, infectar el equipo con otro tipo de malware, recolectar información del usuario y enviarla a servidores C&C. Esto pone en riesgo la seguridad del equipo.\n\n",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Identificar el equipo de red interna y realizar una revisión para descartar la infección por algún tipo de código malicioso.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.",
                "risk" => "Recopilar información tanto del usuario como del equipo afectado.\nAfectación del rendimiento del equipo.\nPérdida de información sensible.",
                "reference" => "http://aprenderinternet.about.com/od/Glosario/g/que-es-drive-by-download.htm\n\nhttp://www.microsoft.com/security/portal/threat/Encyclopedia/Entry.aspx?Name=VBS/Jenxcus\n\nhttp://home.mcafee.com/virusinfo/virusprofile.aspx?key=3320377\n\nhttps://kc.mcafee.com/resources/sites/MCAFEE/content/live/PRODUCT_DOCUMENTATION/24000/PD24761/en_US/McAfee%20Labs%20Threat%20Advisory-VBSAutorun%20Worm.pdf",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Vulnerable Java Version 1.6.x Detected",
                "description" => "Esta firma se presenta al detectar actividad inusual de peticiones de conexión con direcciones IP públicas, donde se detectó el uso de Java 1.6, que dicha versión se encuentra desactualizada para los exploradores: IE, Mozilla, Google Chrome. \n\nPor lo que incurren en una vulnerabilidad, ya que permite la ejecución de código arbitrario en el equipo de cómputo de la institución. La vulnerabilidad se encuentra en el componente Java Runtime Environment (JRE) y podría permitir la ejecución de código remoto en el contexto del usuario, para afectar la  confidencialidad, integridad y disponibilidad.\n\n",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Revisar las aplicaciones instaladas así como los procesos ejecutados en el equipo, analizando que solo se tengan en ejecución las aplicaciones y procesos esenciales para llevar a cabo las funciones normales del equipo.\n*Instalar las actualizaciones de seguridad más recientes del Sistema Operativo y las aplicaciones recomendadas por el fabricante.",
                "risk" => "Ejecución de código malicioso.\nPérdida de información sensible.",
                "reference" => "http://www.urlvoid.com/scan/dl.javafx.com/\nhttp://securelist.com/analysis/publications/57888/kaspersky-lab-report-java-under-attack/\nhttps://www.java.com/es/download/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Vulnerable Java Version 1.7.x Detected",
                "description" => "La detección de actividad inusual dentro de los equipos de cómputo con respecto a la firma se presenta al detectar la versión de Java 1.7, dicha versión tiene vulnerabilidades conocidas que permiten la ejecución de código arbitrario en el equipo de cómputo desactualizado._x000D_\n\nLa vulnerabilidad se encuentra en el componente Java Runtime Environment (JRE) y esta puede ser explotada al visitar inadvertidamente un sitio web malicioso utilizando un navegador con Java 1.7.x habilitado y podría permitir la ejecución de código remoto en el contexto del usuario, para afectar la confidencialidad, integridad y disponibilidad.\n_x000D_\n",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Revisar las aplicaciones instaladas así como los procesos ejecutados en el equipo, analizando que solo se tengan en ejecución las aplicaciones y procesos esenciales para llevar a cabo las funciones normales del equipo.\n*Instalar las actualizaciones de seguridad más recientes del Sistema Operativo y las aplicaciones recomendadas por el fabricante.",
                "risk" => "Ejecución de código malicioso.\nPérdida de información sensible.",
                "reference" => "http://www.imss.caltech.edu/content/serious-java-17x-vulnerability\n\nhttp://www.oracle.com/technetwork/java/javase/7u11-relnotes-1896856.html\n\nhttps://www.java.com/es/download/\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Vulnerable Java Version 1.8.x Detected",
                "description" => "La actividad sospechosa identificada por la firma, corresponde al establecimiento de conexiones con direcciones IP públicas, las cuales intentan hacer uso de una versión desactualizada de Java (1.8.x), la cual contiene vulnerabilidades conocidas que afectan a los navegadores: IE, Mozilla y Google Chrome.\n_x000D_\nLa vulnerabilidad se encuentra en el componente Java Runtime Environment (JRE) que permite la ejecución de código malicioso, afectando al equipo y comprometiendo la seguridad del mismo._x000D_\n_x000D_\n\n",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Revisar las aplicaciones instaladas así como los procesos ejecutados en el equipo, analizando que solo se tengan en ejecución las aplicaciones y procesos esenciales para llevar a cabo las funciones normales del equipo.\n*Instalar las actualizaciones de seguridad más recientes del Sistema Operativo y las aplicaciones recomendadas por el fabricante.",
                "risk" => "Ejecución de código malicioso.\nPérdida de información sensible.",
                "reference" => "http://www.rapid7.com/db/vulnerabilities/amazon-linux-ami-alas-2015-472\n\nhttps://www.incibe.es/vulnDetail/INTECOCERT_GL/Alerta_Temprana/Actualidade_Vulnerabilidades/detalle_vulnerabilidad_gl/CVE-2015-0403",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Vuze BT UDP Connection (5)",
                "description" => "La detección de actividad inusual dentro de los equipos de cómputo con respecto a la firma, se puede identificar el uso de “Vuze”, el cual es un programa empleado para la transferencia de archivos a través de “BitTorrent”_x000D_._x000D_\nBitTorrent es un protocolo diseñado para el intercambio de archivos P2P (Peer to Peer) en Internet, siendo uno de los protocolos más comunes para la transferencia de archivos grandes._x000D_\nEl uso de aplicaciones que utilizan redes P2P pone en riesgo la seguridad de la información en los equipos de cómputo, ya que puede provocar la fuga de información sensible y son foco de infección de malware, así como puede incurrir en una violación a las políticas internas por el uso indebido de software ajeno a la institución.\n_x000D_\n",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Se recomienda a los administradores consultar las políticas de seguridad relativas al uso de estas aplicaciones en la red de la SSA. \n*En caso de no estar permitida acorde a sus políticas, será necesario localizar los equipos de la red interna que presentan este comportamiento, para realizar una revisión del software instalado y remover cualquier software de P2P.  \n*De ser posible se recomienda quitar el acceso a internet a la dirección IP origen para evitar que continúe el consumo excesivo de ancho de banda para este tipo de actividad.\n*Además será necesario realizar un escaneo con una solución de Antivirus y/o Antimalware actualizado en busca de malware para garantizar la integridad de los equipos afectados.",
                "risk" => "Violación a las políticas de uso de software de la institución.\nDisminución de la productividad laboral por parte del usuario.\nAfectación del rendimiento del equipo.\nConsumo innecesario de ancho de banda.",
                "reference" => "http://laneutralidaddered.blogspot.mx/2011/07/el-trafico-p2p.html\n\nhttp://forums.avg.com/es-es/avg-forums?sec=thread&act=show&id=5139",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "W32/24x7Help.ScareWare CnC Beacon",
                "description" => "Se identificó actividad correspondiente al malware W32/24x7, el cual tiene como finalidad la suplantación de software de seguridad mostrando constantemente alertas falsas de seguridad._x000D__x000D_\nW32/24x7 está catalogado como un programa potencialmente no deseado (PUP por sus siglas en inglés) ya que modifica la configuración de los equipos infectados, recopila información, así como hábitos de navegación del usuario, etc._x000D_\nLa propagación del malware, de tipo gusano se lleva a cabo por vulnerabilidades del sistema operativo, por el uso de unidades extraíbles contaminadas o por el uso de programas de intercambio de archivos.\n_x000D_\n",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Localizar el equipo perteneciente a la red interna y realizar un escaneo del dispositivo con la finalidad de descartar infecciones por código malicioso mediante el uso de software Antivirus/Antimalware actualizado con las firmas más recientes.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no haya sido autorizados.\n*Posterior al análisis de Malware se deberá verificar que el equipo cuente con las últimas actualizaciones proporcionadas por el fabricante. Es necesario realizar regularmente la actualización de las aplicaciones y Sistema Operativo con la finalidad de mitigar las vulnerabilidades.",
                "risk" => "Recopilar información tanto del usuario como del equipo afectado.\nAfectación del rendimiento del equipo.\nPérdida de información sensible.",
                "reference" => "http://malwaretips.com/blogs/remove-247-pc-guard-virus/\n\nhttp://www.symantec.com/security_response/writeup.jsp?docid=2009-081806-2906-99&tabid=2\n\nhttp://www.2-spyware.com/remove-24x7-help.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "W32/AdLoad.Downloader Download",
                "description" => "Esta firma se presenta debido a la detección de la descarga directa del adware Downloader a través de Internet.\n\n",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Localizar el equipo perteneciente a la red interna y realizar un escaneo del dispositivo con la finalidad de descartar infecciones por código malicioso mediante el uso de software Antivirus/Antimalware actualizado con las firmas más recientes.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no haya sido autorizados.\n*Posterior al análisis de Malware se deberá verificar que el equipo cuente con las últimas actualizaciones proporcionadas por el fabricante. Es necesario realizar regularmente la actualización de las aplicaciones y Sistema Operativo con la finalidad de mitigar las vulnerabilidades.",
                "risk" => "Recopilar información tanto del usuario como del equipo afectado.\nAfectación del rendimiento del equipo.\nPérdida de información sensible.",
                "reference" => "http://www.microsoft.com/security/portal/threat/encyclopedia/entry.aspx?Name=TrojanDownloader:Win32/Adload.DK",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "W32/BitCoinMiner.MultiThreat Stratum Protocol Mining.Notify Initial Connection Server Response",
                "description" => "Esta firma se presenta debido a la detección del acuse de conexión inicial con un servidor proxy, por parte del adware BitCoin Miner.\n\n",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Localizar el equipo perteneciente a la red interna y realizar un escaneo del dispositivo con la finalidad de descartar infecciones por código malicioso mediante el uso de software Antivirus/Antimalware actualizado con las firmas más recientes.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no haya sido autorizados.\n*Posterior al análisis de Malware se deberá verificar que el equipo cuente con las últimas actualizaciones proporcionadas por el fabricante. Es necesario realizar regularmente la actualización de las aplicaciones y Sistema Operativo con la finalidad de mitigar las vulnerabilidades.",
                "risk" => "Recopilar información tanto del usuario como del equipo afectado.\nAfectación del rendimiento del equipo.\nPérdida de información sensible.",
                "reference" => "http://www.malwareremovalguides.info/trojan-bitcoinminer-removal-guide/\n\nhttps://mining.bitcoin.cz/help/#!/manual/stratum-protocol\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "W32/BitCoinMiner.MultiThreat Subscribe/Authorize Stratum Protocol Message",
                "description" => "Esta firma se presenta debido a la detección de un mensaje de protocolo stratum del adware BitCoin a través de un servidor proxy, en una solicitud HTTP._x000D_\n\n",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Localizar el equipo perteneciente a la red interna y realizar un escaneo del dispositivo con la finalidad de descartar infecciones por código malicioso mediante el uso de software Antivirus/Antimalware actualizado con las firmas más recientes.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no haya sido autorizados.\n*Posterior al análisis de Malware se deberá verificar que el equipo cuente con las últimas actualizaciones proporcionadas por el fabricante. Es necesario realizar regularmente la actualización de las aplicaciones y Sistema Operativo con la finalidad de mitigar las vulnerabilidades.",
                "risk" => "Recopilar información tanto del usuario como del equipo afectado.\nAfectación del rendimiento del equipo.\nPérdida de información sensible.",
                "reference" => "http://www.malwareremovalguides.info/trojan-bitcoinminer-removal-guide/\n\nhttps://mining.bitcoin.cz/help/#!/manual/stratum-protocol\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "W32/InstallMonetizer.Adware Beacon 2",
                "description" => "Esta firma se presenta debido a la detección de peticiones relacionadas con el Adware Monetizer, reconocidao como un programa potencialmente no deseado dentro de un navegador.                                                                      \n\n",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Localizar el equipo perteneciente a la red interna y realizar un escaneo del dispositivo con la finalidad de descartar infecciones por código malicioso mediante el uso de software Antivirus/Antimalware actualizado con las firmas más recientes.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no haya sido autorizados.\n*Posterior al análisis de Malware se deberá verificar que el equipo cuente con las últimas actualizaciones proporcionadas por el fabricante. Es necesario realizar regularmente la actualización de las aplicaciones y Sistema Operativo con la finalidad de mitigar las vulnerabilidades.",
                "risk" => "Recopilar información tanto del usuario como del equipo afectado.\nAfectación del rendimiento del equipo.\nPérdida de información sensible.",
                "reference" => "http://malwaretips.com/blogs/pup-optional-installmonetizer-a-removal/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "W32/InstallRex.Adware Initial CnC Beacon",
                "description" => "Esta firma se presenta debido a la detección del inicio de la ejecución del adware instalRez, conocido por ser un programa potencialmente no deseado.\n\n",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Localizar el equipo perteneciente a la red interna y realizar un escaneo del dispositivo con la finalidad de descartar infecciones por código malicioso mediante el uso de software Antivirus/Antimalware actualizado con las firmas más recientes.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no haya sido autorizados.\n*Posterior al análisis de Malware se deberá verificar que el equipo cuente con las últimas actualizaciones proporcionadas por el fabricante. Es necesario realizar regularmente la actualización de las aplicaciones y Sistema Operativo con la finalidad de mitigar las vulnerabilidades.",
                "risk" => "Recopilar información tanto del usuario como del equipo afectado.\nAfectación del rendimiento del equipo.\nPérdida de información sensible.",
                "reference" => "http://www.avira.com/en/support-threats-description/tid/8093/tlang/en\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "W32/Sality Executable Pack Digital Signature ASCII Marker",
                "description" => "Sality es un malware el cual puede llegar a comunicarse a través de P2P (pero to peer) con el fin de poder trasmitir spam, este Adware puede llegar a infectar archivos ejecutables en unidades locales ,  _x000D_\nextraíbles y compartidos remotos afectando archivos del sistema operativo, poniendo en riesgo laseguridad y funcionamiento del equipo. _x000D_\n\nCabe señalar que este Malware llega a utilizar distintas herramientas de comunicación para poder ser difundido a través de correo electrónico y mensajes instantáneos. También suele propagarse por medio de redes sociales, sitios fraudulentos, programas gratuitos que no se sabe su procedencia, etc._x000D_\n\n",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Localizar el equipo perteneciente a la red interna y realizar un escaneo del dispositivo con la finalidad de descartar infecciones por código malicioso mediante el uso de software Antivirus/Antimalware actualizado con las firmas más recientes.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no haya sido autorizados.\n*Posterior al análisis de Malware se deberá verificar que el equipo cuente con las últimas actualizaciones proporcionadas por el fabricante. Es necesario realizar regularmente la actualización de las aplicaciones y Sistema Operativo con la finalidad de mitigar las vulnerabilidades.",
                "risk" => "Recopilar información tanto del usuario como del equipo afectado.\nAfectación del rendimiento del equipo.\nPérdida de información sensible.",
                "reference" => "http://www.symantec.com/security_response/writeup.jsp?docid=2006-011714-3948-99\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "WBBlog SQL Injection Attempt -- index.php e_id SELECT",
                "description" => "WBBlog es una función desconocida del archivo index.php y es afectada a través de la manipulación del parámetro e_id de una entrada desconocida, la cual es causa de una vulnerabilidad de clase sql injection.\nEsta consiste en la inserción o la \"inyección\" de una consulta SQL a través de los datos de entrada del cliente para la aplicación esto es leer datos sensibles de la base de datos, modificándolos  _x000D_\n(Insertar/Actualizar/Eliminar), ejecutando operaciones de administración dentro de la misma base de datos, recuperar el contenido de un archivo determinado, la explotación se considera fácil ya que el  _x000D_\nataque se puede efectuar a través de la red a la cual la explotación no necesita ninguna autentificación específica._x000D_\n_x000D_\nEste tipo de ataques de SQL son un tipo de ataque de inyección, en la que los comandos SQL se inyectan en _x000D_la entrada de datos de plano con el fin de efectuar la ejecución de comandos SQL predefinidos o bien al alterar cualquier sentencia SQL se termine poniendo en riesgo la seguridad de una aplicación web, ocasionando el robo de información del usuario.",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Realizar el endurecimiento en la configuración de los servidores críticos (Hardening).\n*Validar que el servidor cuente únicamente con los puertos/servicios requeridos para su operación (por ejemplo si es el equipo será solo un servidor de impresión, no se necesitan servicios de ssh, telnet, remote desktop).\n*Antes de publicar algún servicio a internet asegurar la existencia y ejecución de procedimientos de endurecimiento (hardening) de configuraciones y la aplicación de guías correspondientes en seguridad de host y aplicativos web.\n*Posterior al análisis de malware se deberá verificar que el equipo cuente con las últimasactualizaciones proporcionadas por el fabricante. Es necesario realizar regularmente la actualización de las Aplicaciones y Sistema Operativo con la finalidad de mitigar las vulnerabilidades.\n",
                "risk" => "Acceso no autorizado al sistema comprometiendo el equipo y toda la información sensible contenida en él.\nEncontrar vulnerabilidades o puertos abiertos en el equipo que podrás ser explotadas por el atacante  para tomar control del equipo.\nCambio en la configuración del servidor.\n\n",
                "reference" => "http://cve.mitre.org/cgi-bin/cvename.cgi?name=CVE-2007-1481\nhttp://www.scip.ch/es/?vuldb.35643",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Web Crawl using Curl",
                "description" => "WebCrawler suele tener diferentes usos, el más común es el relacionado motor de búsqueda, los cuales utilizan rastreadores web para poder recopilar información sobre lo que llega a estar disponible en las  _x000D_páginas web públicas. Entonces su propósito principal es la de recoger datos de tal manera que cuando los usuarios llegan a introducir términos de búsqueda en un sitio, éste se los proporcionará de forma rapida con sitios de interés._x000D_\nEsto llega a ser un buen método para recopilar datos de un gran número de páginas web, al igual para el uso de alguna biblioteca del lenguaje de programación PHP, lo cual puede indicar la presencia de algún modulo automatizado para llevar a cabo actividad maliciosa creando un Web Crawler._x000D_\n",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Realizar el endurecimiento en la configuración de los servidores críticos (Hardening).\n*Validar que el servidor cuente únicamente con los puertos/servicios requeridos para su operación (por ejemplo si es el equipo será solo un servidor de impresión, no se necesitan servicios de ssh, telnet, remote desktop).\n*Antes de publicar algún servicio a internet asegurar la existencia y ejecución de procedimientos de endurecimiento (hardening) de configuraciones y la aplicación de guías correspondientes en seguridad de host y aplicativos web.\n*Posterior al análisis de malware se deberá verificar que el equipo cuente con las últimasactualizaciones proporcionadas por el fabricante. Es necesario realizar regularmente la actualización de las Aplicaciones y Sistema Operativo con la finalidad de mitigar las vulnerabilidades.",
                "risk" => "Acceso no autorizado al sistema comprometiendo el equipo y toda la información sensible contenida en él.\nEncontrar vulnerabilidades o puertos abiertos en el equipo que podrás ser explotadas por el atacante  para tomar control del equipo.",
                "reference" => "http://www.deivison.com.br/como-bloquear-web-crawler-bots-scrapers-e-spiders-no-varnish-e-nginx/\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "WEB_SERVER .htaccess access",
                "description" => ".htaccess (hypertext access), también conocido como archivo de configuración distribuida, es un fichero utilizado por el servidor HTTP Apache, éste te permite definir diferentes directivas de configuración para cada directorio (con sus respectivos subdirectorios) sin la necesidad de editar el archivo de configuración principal de Apache. Entonces un archivo que llega a tener una o más directivas de configuración, se le puede colocar en un directorio determinado aplicándolo en el mismo directorio o en los subdirectorios, entre sus usos están la creación de URLs, la restricción de algún acceso, crear redirecciones estáticas, etc. _x000D_\n\n",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n• Identificar el equipo de red interna y realizar una revisión para descartar la infección por algún tipo de código malicioso.\n*Se recomienda proteger el servidor web contra inyección de código malicioso, SQL Injection e intentos de hacking; modificando los archivos de configuración distribuida  \"distributed configuration files”, bloquear los accesos al agente de usuario: “user agent BOT/0.1” agregándolo a una Blacklist.\n*Agregar el  user agent BOT/0.1 al archivo root “.htaccess”:\n              /WebsiteA/.htaccess\n              /WebsiteA/subfolderA/.htaccess\n              /WebsiteB/.htaccess\n*Restringir las reglas del fichero .htaccess\n*Actualizar todos los plugins que tengamos y aplicar los parches de la plataforma de administración web.\n*Proteger la zona de administración con una clave adicional (por ejemplo mediante .htaccess y .htpasswd )\n*Asegurar los directorios deshabilitando la ejecución de cualquier tipo de script con las siguientes extensiones:\nAddHandler cgi-script .php .pl .py .jsp .asp .htm .shtml .sh .cgi\nOptions -ExecCGI",
                "risk" => "Acceso no autorizado al sistema comprometiendo el equipo y toda la información sensible contenida en él.\nEncontrar vulnerabilidades o puertos abiertos en el equipo que podrás ser explotadas por el atacante  para tomar control del equipo.\nCambio en la configuración del servidor.\n\n",
                "reference" => "http://httpd.apache.org/docs/2.2/howto/htaccess.html\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "WEB_SERVER ColdFusion administrator access",
                "description" => "Cold Fusion es una interfaz para acceder a bases de datos vía web, esta herramienta realiza funciones de acceso a la información alojada en base de datos, la cual llega a utilizar programación personalizada ya que se puede distribuir información en una base de datos al interior de una red, una de las ventajas de usar esta herramienta es que si el usuario puede acceder como administrador a dicha aplicación se puede sacar provecho haciendo uso de las siguientes opciones._x000D_\nPuede configurar un servidor, configurar la conexión de base de datos,  administrar la aplicaciónlogrando habilitar alguna depuración o bien especificar alguna contraseña para tener el acceso a la herramienta. Aunque esta herramienta llega a ser útil, algunas de estas características pueden llegar a ser vulneradas tales como querer ingresar al panel de administrador, que es una parte de su interfaz para la configuración de distintas características tales como: correo electrónico, conexiones a bases de datos,etc._x000D_\n\n",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Validar si los equipos presentan cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Revisar las aplicaciones instaladas así como los procesos ejecutados en el equipo, analizando que solo se tengan en ejecución las aplicaciones y procesos esenciales para llevar a cabo las funciones normales del equipo.\n*Aplicar las actualizaciones de seguridad disponibles para Adobe ColdFusion 9.0, 9.0.1, 9.0.2, and 10; que pueden descargarse desde el siguiente link, utilizando las instrucciones proporcionadas por el fabricante.\nhttp://helpx.adobe.com/coldfusion/kb/coldfusion-security-hotfix-apsb13-03.html\n*Inspeccionar los archivos y las tareas programadas de origen desconocido ubicados en el CFIDE, directorios CFIDE / adminapi o webroot, y eliminar cualquier archivo sospechoso (algunos ejemplos de nombres de archivos maliciosos incluyen h.cfm, i.cfm, h9.cfm, r. pcm, adss.cfm o fusebox.cfm).",
                "risk" => "Acceso no autorizado al sistema comprometiendo el equipo y toda la información sensible contenida en él.\nEncontrar vulnerabilidades o puertos abiertos en el equipo que podrás ser explotadas por el atacante  para tomar control del equipo.\nCambio en la configuración del servidor.\n\n",
                "reference" => "http://www.uca.edu.sv/investigacion/bdweb/reportes/coldfusion.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "WEB_SERVER Exploit Suspected PHP Injection Attack (cmd=)",
                "description" => "Esta firma nos indica que durante una solicitud al servidor web comprometido se detectó la cadena \"cmd=\" dentro de la URI de una solicitud GET. Esta cadena anexada a la solicitud permitiría poder ejecutar comandos de manera arbitraria de forma remota y sin la necesidad de tener que autenticarse. Se busca poder tener acceso a una consola de comandos que permita ejecutar de forma arbitraria y remota comandos._x000D_\nSe corre el riesgo de que algún atacante o entidad maliciosa tome el control total del servidor, se genere pérdida de información, se genere un ataque de denegación de servicios (DoS).",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Realizar el endurecimiento en la configuración de los servidores críticos (Hardening).\n*Validar que el servidor cuente únicamente con los puertos/servicios requeridos para su operación (por ejemplo si es el equipo será solo un servidor de impresión, no se necesitan servicios de ssh, telnet, remote desktop).\n*Antes de publicar algún servicio a internet asegurar la existencia y ejecución de procedimientos de endurecimiento (hardening) de configuraciones y la aplicación de guías correspondientes en seguridad de host y aplicativos web.\n*Posterior al análisis de malware se deberá verificar que el equipo cuente con las últimasactualizaciones proporcionadas por el fabricante. Es necesario realizar regularmente la actualización de las Aplicaciones y Sistema Operativo con la finalidad de mitigar las vulnerabilidades.",
                "risk" => "Acceso no autorizado al sistema comprometiendo el equipo y toda la información sensible contenida en él.\nEncontrar vulnerabilidades o puertos abiertos en el equipo que podrás ser explotadas por el atacante  para tomar control del equipo.\nCambio en la configuración del servidor.\n\n",
                "reference" => "http://www.golemtechnologies.com/articles/shell-injection",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "WEB_SERVER SQL Errors in HTTP 200 Response (SqlException)",
                "description" => "Esta firma salta cuando se detecta que un servidor web responde con un código http 200 una solicitud que contiene la cadena sqlException._x000D_\nEl código http 200 es la respuesta que manda un servidor web cuando la solicitud hecha fue correctamente atendida, es decir cuando se solicita un recurso._x000D_\n_x000D_\nLa solicitud lleva la cadena \"sqlException\", la instrucción sqlException nos proporciona información sobre los errores en el acceso a la base de datos._x000D_\nEsta información la podría ocupar un atacante para conocer los errores de intentos de accesar a la base de datos y programar nuevos ataques cada vez más precisos.",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Validar si los equipos presentan cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Revisar las aplicaciones instaladas así como los procesos ejecutados en el equipo, analizando que solo se tengan en ejecución las aplicaciones y procesos esenciales para llevar a cabo las funciones normales del equipo.\n*Realizar el endurecimiento en la configuración de los servidores críticos (Hardening).\n*Validar que el servidor cuente únicamente con los puertos/servicios requeridos para su operación (por ejemplo si es el equipo será solo un servidor de impresión, no se necesitan servicios de ssh, telnet, remote desktop).\n*Antes de publicar algún servicio a internet asegurar la existencia y ejecución de procedimientos de endurecimiento (hardening) de configuraciones y la aplicación de guías correspondientes en seguridad de host y aplicativos web.",
                "risk" => "Acceso no autorizado al sistema comprometiendo el equipo y toda la información sensible contenida en él.\nEncontrar vulnerabilidades o puertos abiertos en el equipo que podrás ser explotadas por el atacante  para tomar control del equipo.\nCambio en la configuración del servidor.\n\n",
                "reference" => "http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html\nhttp://projects.webappsec.org/w/page/13246925/Fingerprinting",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "WEB_SPECIFIC_APPS WBBlog SQL Injection Attempt -- index.php e_id SELECT",
                "description" => "Esta firma se presenta cuando se detecta una petición que contienen las cadenas \"index.php\", \"e_id\" y \"SELECT\". Se busca con ello explotar una vulnerabilidad en el WBBlog que permite la ejecución de código arbitrario y de forma remota mediante el parámetro \"e_id\" donde se detecta una query de tipo \"SELECT\"._x000D_\n_x000D_\nEsta actividad podría permitir a un atacante tomar control del equipo, así como comprometer la integridad, confidencialidad y disponibilidad de los datos contenidos en el servidor.",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Se recomienda proteger el servidor web contra inyección de código malicioso, SQL Injection e intentos de hacking; modificando los archivos de configuración .\n*Validar si los equipos presentan cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Revisar las aplicaciones instaladas así como los procesos ejecutados en el equipo, analizando que solo se tengan en ejecución las aplicaciones y procesos esenciales para llevar a cabo las funciones normales del equipo.\n*Realizar el endurecimiento en la configuración de los servidores críticos (Hardening).\n*Validar que el servidor cuente únicamente con los puertos/servicios requeridos para su operación (por ejemplo si es el equipo será solo un servidor de impresión, no se necesitan servicios de ssh, telnet, remote desktop).\n*Antes de publicar algún servicio a internet asegurar la existencia y ejecución de procedimientos de endurecimiento (hardening) de configuraciones y la aplicación de guías correspondientes en seguridad de host y aplicativos web.",
                "risk" => "Acceso no autorizado al sistema comprometiendo el equipo y toda la información sensible contenida en él.\nEncontrar vulnerabilidades o puertos abiertos en el equipo que podrás ser explotadas por el atacante  para tomar control del equipo.\nCambio en la configuración del servidor.\n\n",
                "reference" => "https://www.owasp.org/index.php/SQL_Injection",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "WebHack Control Center User-Agent Inbound (WHCC/)",
                "description" => "Esta firma salta cuando se detecta el tráfico de entrada, donde en el User-Agent va incluida la cadena WHCC, la cual hace referencia a la aplicación Web Hack Control Center._x000D_\n_x000D_El WHCC es una herramienta de escaneo de vulnerabilidades diseñada para servidores web, esta herramienta tiene una base de datos de otras hazañas y es capaz de detectar las vulnerabilidades presentes que permitieron realizar los ataques._x000D_\n_x000D_\nLa firma se levanta con el tráfico entrante, y es el reflejo de que algún ente malicioso utiliza la herramienta WHCC para detectar vulnerabilidades en nuestros servidores. Esta información puede ser utilizada para realizar el robo de información sensible o una denegación de servicios (DoS).",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Validar si los equipos presentan cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Revisar las aplicaciones instaladas así como los procesos ejecutados en el equipo, analizando que solo se tengan en ejecución las aplicaciones y procesos esenciales para llevar a cabo las funciones normales del equipo.\n*Realizar el endurecimiento en la configuración de los servidores críticos (Hardening).\n*Validar que el servidor cuente únicamente con los puertos/servicios requeridos para su operación (por ejemplo si es el equipo será solo un servidor de impresión, no se necesitan servicios de ssh, telnet, remote desktop).\n*Antes de publicar algún servicio a internet asegurar la existencia y ejecución de procedimientos de endurecimiento (hardening) de configuraciones y la aplicación de guías correspondientes en seguridad de host y aplicativos web.",
                "risk" => "Acceso a información sensible.",
                "reference" => "http://eromang.zataz.com/2011/05/20/suc023-webhack-control-center-user-agent-inbound-whcc/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "WEB-PHP phpinfo access",
                "description" => "Se detectaron peticiones que intentan explotar una vulnerabilidad encontrada en el software Invasion Board, el cual entre sus funciones permite crear foros o sitios web de manera sencilla._x000D_\nLa vulnerabilidad se da después de la instalación de Invasion Board, el cual sugiere instalar phpinfo.php en el directorio web raíz del servidor, dicho programa es básicamente un archivo que contiene gran cantidad de información considerable sobre nuestro servidor, entre otros datos contiene la versión del servidor, dirección IP, configuraciones básicas e incluso usuarios en el servidor._x000D_\nEsto supone un riesgo en la seguridad del equipo y la red en general, debido a que un atacante podría obtener acceso a dicho archivo y contar con información sensible de nuestro servidor, pudiendo obtener acceso al equipo o control total mediante herramientas de software especializadas._x000D_\n\n",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Validar si los equipos presentan cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Revisar las aplicaciones instaladas así como los procesos ejecutados en el equipo, analizando que solo se tengan en ejecución las aplicaciones y procesos esenciales para llevar a cabo las funciones normales del equipo.\n*Realizar el endurecimiento en la configuración de los servidores críticos (Hardening).\n*Validar que el servidor cuente únicamente con los puertos/servicios requeridos para su operación (por ejemplo si es el equipo será solo un servidor de impresión, no se necesitan servicios de ssh, telnet, remote desktop).\n*Antes de publicar algún servicio a internet asegurar la existencia y ejecución de procedimientos de endurecimiento (hardening) de configuraciones y la aplicación de guías correspondientes en seguridad de host y aplicativos web.",
                "risk" => "Acceso a información sensible.",
                "reference" => "http://cve.mitre.org/cgi-bin/cvename.cgi?name=CVE-2002-1149\n\nhttps://perishablepress.com/htaccess-secure-phpinfo-php/\n\nhttp://cve.circl.lu/cve/CVE-2002-1149\n\nhttp://www.securityfocus.com/bid/5789/info\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "WGET Command Specifying Output in HTTP Headers",
                "description" => "Se identificaron una serie de peticiones las cuales contienen comandos que intentan explotar una vulnerabilidad conocida como shellshock.\nLa vulnerabilidad se encuentra en el componente “Environment Variable Handler” que permite el ingreso de comando de forma remota del intérprete de comandos Bash, la vulnerabilidad se encuentra registrada con la clave técnica CVE-2014-6271.\nCon lo anterior se busca ejecutar código de forma remota en el intérprete de comandos Bash presente en distintas distribuciones GNU/Linux, y escalar privilegios para obtener el control del sistema y pudiendo afectar a otro equipo de la red, el intento de esta explotación también podría generar una condición de denegación de servicios.\n_x000D_\n\n",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Validar si los equipos presentan cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Revisar las aplicaciones instaladas así como los procesos ejecutados en el equipo, analizando que solo se tengan en ejecución las aplicaciones y procesos esenciales para llevar a cabo las funciones normales del equipo.\n*Realizar el endurecimiento en la configuración de los servidores críticos (Hardening).\n*Validar que el servidor cuente únicamente con los puertos/servicios requeridos para su operación (por ejemplo si es el equipo será solo un servidor de impresión, no se necesitan servicios de ssh, telnet, remote desktop).\n*Antes de publicar algún servicio a internet asegurar la existencia y ejecución de procedimientos de endurecimiento (hardening) de configuraciones y la aplicación de guías correspondientes en seguridad de host y aplicativos web.",
                "risk" => "Acceso no autorizado al sistema comprometiendo.",
                "reference" => "http://kb.eset-la.com/esetkb/index?page=content&id=SOLN3578&locale=es_ES\n\nhttp://www.gnu.org/software/bash/\n\nhttps://cve.mitre.org/cgi-bin/cvename.cgi?name=CVE-2014-6271\n\nhttp://www.scip.ch/es/?vuldb.67685\n\nhttp://www.welivesecurity.com/la-es/2014/09/26/shellshock-grave-vulnerabilidad-bash/\n\nhttp://www.symantec.com/connect/blogs/shellshock-all-you-need-know-about-bash-bug-vulnerability",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Win32.Sality.3 checkin",
                "description" => "Se detectaron peticiones las cuales contienen características del malware Sality._x000D_\nSality es un malware que se propaga principalmente a través de redes P2P y que infecta los archivos .exe y .src, creando archivos autoarrancables (autorun.ini) en pendrives, particiones de disco duro y utilizando recursos del equipo.\nEste malware afecta archivos del sistema operativo poniendo en riesgo la seguridad y funcionamiento del equipo teniendo grandes alcances como el ingreso de código malicioso utilizado por botnets y desactivación de software de seguridad.\n_x000D_\n",
                "recommendation" => "https://www.symantec.com/content/en/us/enterprise/media/security_response/whitepapers/sality_peer_to_peer_viral_network.pdf\n\nhttp://home.mcafee.com/virusinfo/VirusProfile.aspx?key=142636\n\nhttp://www.symantec.com/security_response/writeup.jsp?docid=2006-011714-3948-99\n",
                "risk" => "Robo de información sensible en el equipo afectado.",
                "reference" => "https://www.symantec.com/content/en/us/enterprise/media/security_response/whitepapers/sality_peer_to_peer_viral_network.pdf",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Win32.Sality-GR Checkin",
                "description" => "Se detectaron peticiones las cuales contienen características del malware Sality. En este caso específico se trata de Win32.Sality-GR, el cual está considerado como un troyano haciéndose pasar por un scanner de virus pero infectando el equipo mostrando publicidad en navegadores web, recolectando información del usuario y creando entradas de otro software malicioso.\nSality es un familia de malware, contienen diversas variantes, generalmente se propaga a través de redes P2P y que infecta los archivos .exe y .src, creando archivos autoarrancables (autorun.ini) en pendrives, particiones de disco duro y utilizando recursos del equipo.\n_x000D_\n\n",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Localizar el equipo perteneciente a la red interna y realizar un escaneo del dispositivo con la finalidad de descartar infecciones por código malicioso mediante el uso de software Antivirus/Antimalware actualizado con las firmas más recientes.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no haya sido autorizados.\n*Posterior al análisis de Malware se deberá verificar que el equipo cuente con las últimas actualizaciones proporcionadas por el fabricante. Es necesario realizar regularmente la actualización de las aplicaciones y Sistema Operativo con la finalidad de mitigar las vulnerabilidades.",
                "risk" => "Robo de información sensible en el equipo afectado.",
                "reference" => "http://www.bestsafeguardtools.com/Unknown/how+to+remove+Win32.Sality-GR.html\n\nhttp://home.mcafee.com/virusinfo/VirusProfile.aspx?key=142636\n\nhttps://www.symantec.com/content/en/us/enterprise/media/security_response/whitepapers/sality_peer_to_peer_viral_network.pdf\n\nhttp://www.symantec.com/security_response/writeup.jsp?docid=2006-011714-3948-99\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Win32/BrowseFox.H Checkin 2",
                "description" => "BrowseFox.H se cataloga como un PUP (programa potencialmente no deseado por sus siglas en inglés). Un PUP es un programa que se instala sin el consentimiento del usuario y realiza acciones o tiene características que pueden minimizar el control del usuario sobre su privacidad, confidencialidad, uso de recursos del equipo, etc.\nBrowseFox.H tiene la capacidad de modificar la configuración de los navegadores web, recopilar información y hábitos de navegación del usuario, además de desplegar publicidad en ventanas emergentes basada en dicha información.\nTambién se encarga de bloquear la página de inicio de los navegadores con el objetivo de forzar el uso de ciertos buscadores que pueden ser peligrosos para el usuario.",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Localizar el equipo perteneciente a la red interna y realizar un escaneo del dispositivo con la finalidad de descartar infecciones por código malicioso mediante el uso de software Antivirus/Antimalware actualizado con las firmas más recientes.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Posterior al análisis de Malware se deberá verificar que el equipo cuente con las últimas actualizaciones proporcionadas por el fabricante. Es necesario realizar regularmente la actualización de las aplicaciones y Sistema Operativo con la finalidad de mitigar las vulnerabilidades.",
                "risk" => "Robo de información sensible en el equipo afectado.",
                "reference" => "http://www.enigmasoftware.com/adwaremegabrowse-removal/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Win32/DealPly Checkin",
                "description" => "DealPly es una extensión para navegadores web que sigue los hábitos de navegación web de un usuario y mostrará ofertas de cupones al acceder a sitios web de compras en línea (eBay, Amazon etc.). Aunque DealPly no es un virus o programa malicioso se le cataloga como un PUP (programa potencialmente no deseado por sus siglas en inglés).\nUn PUP es un programa que se instala sin el consentimiento del usuario y realiza acciones o tiene características que pueden minimizar el control del usuario sobre su privacidad, confidencialidad, uso de recursos del equipo, etc.\nExisten varias formas en las que Dealply se puede instalar en el equipo del usuario: \n      • Descargando esta extensión desde su página de inicio siendo consciente de su instalación.\n      • Junto con otro programa gratuito u otros complementos para navegadores web, con frecuencia, sin el consentimiento del usuario.",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Analizar el equipo de red interna con algún software Antivirus/Antimalware actualizado con las firmas más recientes en búsqueda de posibles infecciones por código malicioso.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Verificar que el equipo de la red interna ejecute únicamente aquellas aplicaciones, procesos, servicios, etc. que sean indispensables para realizar sus tareas asignadas, por lo cual es necesario deshabilitar o desinstalar toda aplicación o configuración que no sea requerida para tales fines.",
                "risk" => "Robo de información sensible en el equipo afectado.",
                "reference" => "http://home.mcafee.com/virusinfo/virusprofile.aspx?key=8250633#none\nhttp://www.microsoft.com/security/portal/threat/encyclopedia/Entry.aspx?Name=SoftwareBundler:Win32/DealPly",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Win32/Ramnit Checkin",
                "description" => "Ramnit es un malware que roba las credenciales de banca en línea, contraseñas de los servicios FTP, las cookies de sesión y archivos personales de los equipos infectados. \nUna vez que un equipo infectado por este malware se desactivan las configuraciones de seguridad de Windows (antivirus, Firewall, control de cuentas de usuarios).\nLos medios de propagación de este malware son a través de dispositivos de almacenamiento externo (usb), anuncios maliciosos, redes sociales y servidores FTP públicos.",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n* Cambiar la contraseña del equipo afectado.\n* Cambiar la contraseña de las aplicaciones del equipo afectado.\n*Analizar el equipo de red interna con algún software Antivirus/Antimalware actualizado con las firmas más recientes en búsqueda de posibles infecciones por código malicioso.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Verificar que el equipo de la red interna ejecute únicamente aquellas aplicaciones, procesos, servicios, etc. que sean indispensables para realizar sus tareas asignadas, por lo cual es necesario deshabilitar o desinstalar toda aplicación o configuración que no sea requerida para tales fines.\n",
                "risk" => "Robo de información sensible en el equipo afectado.",
                "reference" => "http://www.microsoft.com/security/portal/threat/encyclopedia/entry.aspx?Name=Trojan:Win32/Ramnit\nhttps://www.f-secure.com/v-descs/virus_w32_ramnit_n.shtml",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Win32/SoftPulse.H Checkin",
                "description" => "SoftPulse es un malware que recopila la configuración y versión del sistema, la configuración de red de los equipos infectados para ser mandados a un servidor Command and Control (c&c).\nSoftPulse crea registros de entrada para ejecutarse cada vez que arranque el sistema, modifica la configuración de los navegadores web, descarga y ejecuta archivos adicionales incluyendo nuevas versiones de malware.\nLos medios de propagación de SoftPulse son a través de correos electrónicos falsos (Spam), enlaces maliciosos y dispositivos de almacenamiento externo o carpetas compartidas.",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Analizar el equipo de red interna con algún software Antivirus/Antimalware actualizado con las firmas más recientes en búsqueda de posibles infecciones por código malicioso.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Verificar que el equipo de la red interna ejecute únicamente aquellas aplicaciones, procesos, servicios, etc. que sean indispensables para realizar sus tareas asignadas, por lo cual es necesario deshabilitar o desinstalar toda aplicación o configuración que no sea requerida para tales fines.",
                "risk" => "Robo de información sensible en el equipo afectado.",
                "reference" => "http://www.antivirus-blog.com/removal-guides/remove-win32softpulse-pup-removal/\nhttps://forum.avast.com/index.php?topic=163638.0\nhttps://www.avira.com/en/support-threats-description/tid/8449/tlang/en",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Win32/Toolbar.CrossRider.A Checkin",
                "description" => "Tool.CrossRider.A Checkin se encuentra catalogado como un PUP (Programa Potencialmente no Deseado) por sus iniciales en inglés. Los programas no deseados tienen la capacidad de realizar cambios en el equipo o en los navegadores web sin consentimiento del usuario.\nEste Adware secuestra el navegador (realiza cambios en las configuraciones, como modificar la página de inicio, cambiar el motor de búsqueda, etc.), barras de herramientas y redirige las búsquedas hechas a sitios maliciosos o de mala reputación._x000D_\nUn método muy habitual con el que tiende a ser instalado \"Win32/Toolbar.CrossRider\" es por la descarga de software gratuito en Internet (freeware o shareware), donde este malware viene incluido. También hay distintos sitios web como Softonic o Brothersoft que promueven este tipo de infecciones en sus descargas._x000D_",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Analizar el equipo de red interna con algún software Antivirus/Antimalware actualizado con las firmas más recientes en búsqueda de posibles infecciones por código malicioso.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Verificar que el equipo de la red interna ejecute únicamente aquellas aplicaciones, procesos, servicios, etc. que sean indispensables para realizar sus tareas asignadas, por lo cual es necesario deshabilitar o desinstalar toda aplicación o configuración que no sea requerida para tales fines.",
                "risk" => "Robo de información sensible en el equipo afectado.",
                "reference" => "http://www.microsoft.com/security/portal/threat/encyclopedia/entry.aspx?Name=Adware:Win32/Gisav\nhttp://malwaretips.com/blogs/win32-toolbar-crossrider-removal/",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "WindowBase64.atob Function In Edwards Packed JavaScript, Possible iFrame Injection Detected",
                "description" => "WindowBase64.atob() es una función que decodifica una cadena de datos que ha sido codificada en base 64._x000D_\nEdwards Packed JavaScript es un paquete que permite descifrar y ejecutar código ofuscado, esto puede ser utilizado para realizar algún tipo de inyección de código._x000D_\nEl ataque tipo iFrame injection, aprovecha las vulnerabilidades de las páginas web para incrustar código desde otro servidor, haciendo que una página legítima incluya objetos falsos , ya sea para redireccionar a sitios poco confiables o para descargar malware.",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Validar si los equipos presentan cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Revisar las aplicaciones instaladas así como los procesos ejecutados en el equipo, analizando que solo se tengan en ejecución las aplicaciones y procesos esenciales para llevar a cabo las funciones normales del equipo.\n*Realizar el endurecimiento en la configuración de los servidores críticos (Hardening).\n*Validar que el servidor cuente únicamente con los puertos/servicios requeridos para su operación (por ejemplo si es el equipo será solo un servidor de impresión, no se necesitan servicios de ssh, telnet, remote desktop).\n*Antes de publicar algún servicio a internet asegurar la existencia y ejecución de procedimientos de endurecimiento (hardening) de configuraciones y la aplicación de guías correspondientes en seguridad de host y aplicativos web.",
                "risk" => "Robo de información sensible en el equipo afectado.",
                "reference" => "http://yaisb.blogspot.mx/2006/10/defeating-dean-edwards-javascript.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Windows 98 User-Agent Detected - Possible Malware or Non-Updated System",
                "description" => "Se refiere a que se ha identificado el uso de la plataforma Windows 98 mediante la cabecera user-agent, donde el parámetro Plataform Token hace referencia a dicho sistema._x000D_\nEl sistema operativo Windows 98 se publicó en junio de 1998, su última versión estable fue en 1999, se le dejó de dar soporte desde el 13 de julio del 2006, por lo que se le considera obsoleto ya que no se lanzarán más actualizaciones o parches de seguridad._x000D_",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n* Validar el sistema operativo afectado.\n*Analizar el equipo de red interna con algún software Antivirus/Antimalware actualizado con las firmas más recientes en búsqueda de posibles infecciones por código malicioso.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Verificar que el equipo de la red interna ejecute únicamente aquellas aplicaciones, procesos, servicios, etc. que sean indispensables para realizar sus tareas asignadas, por lo cual es necesario deshabilitar o desinstalar toda aplicación o configuración que no sea requerida para tales fines.",
                "risk" => "Si el malware es confirmado en el equipo afectado, el riesgo es:\nRobo de información sensible en el equipo afectado.",
                "reference" => "http://securitydisclosures.blogspot.mx/2013/01/web-exploits-and-intrusion-detection.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Worm.VBS.ayr Checkin",
                "description" => "También conocido como Severons.A, roba información del equipo donde se encuentra enviándola a una ubicación remota. Se copia con el nombre “help.vbs” en la carpeta %TEMP% y modifica la siguiente entrada en el registro de Windows para asegurarse de iniciar automáticamente cada vez que se enciende el equipo:\n_x000D_\nHKLM\\Software\\Microsoft\\Windows\\CurrentVersion\\RunSets value: help.vbs_x000D_\nCon los datos: <Nombre de archivo y ubicación del gusano>, por ejemplo %TEMP%\\help.vbs_x000D_\n_x000D_\nAl ser un gusano, se propaga a otros equipos infectando medios extraíbles (como memorias USB o discos duros portátiles) conectados al equipo comprometido, ocultando todos los archivos que contenga y creando un acceso directo con el nombre “help.lnk” que al ser abierto, ejecuta la copia del gusano en el dispositivo._x000D_\n_x000D_\nEntre la información que puede recopilar este Malware se encuentra:_x000D_\n_x000D_\nNombre de usuario._x000D_\nNombre del equipo._x000D_\nVersión del Sistema Operativo Windows presente en el equipo.",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Analizar el equipo de red interna con algún software Antivirus/Antimalware actualizado con las firmas más recientes en búsqueda de posibles infecciones por código malicioso.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Verificar que el equipo de la red interna ejecute únicamente aquellas aplicaciones, procesos, servicios, etc. que sean indispensables para realizar sus tareas asignadas, por lo cual es necesario deshabilitar o desinstalar toda aplicación o configuración que no sea requerida para tales fines.\n*Posterior al análisis de Malware se deberá verificar que el equipo cuente con las últimas actualizaciones proporcionadas por el fabricante. Es necesario realizar regularmente la actualización de las Aplicaciones y Sistema Operativo con la finalidad de mitigar las vulnerabilidades.",
                "risk" => "Robo de información sensible en el equipo afectado.",
                "reference" => "http://www.symantec.com/connect/articles/security-11-part-1-viruses-and-worms",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Worm.VBS.ayr Checkin 1",
                "description" => "También conocido como Severons.A, roba información del equipo donde se encuentra enviándola a una ubicación remota. Se copia con el nombre “help.vbs” en la carpeta %TEMP% y modifica la siguiente entrada en el registro de Windows para asegurarse de iniciar automáticamente cada vez que se enciende el equipo:\n_x000D_HKLM\\Software\\Microsoft\\Windows\\CurrentVersion\\RunSets value: help.vbs_x000D_\nCon los datos: <Nombre de archivo y ubicación del gusano>, por ejemplo %TEMP%\\help.vbs_x000D_\n_x000D_\nAl ser un gusano, se propaga a otros equipos infectando medios extraíbles (como memorias USB o discos duros portátiles) conectados al equipo comprometido, ocultando todos los archivos que contenga y creando un acceso directo con el nombre “help.lnk” que al ser abierto, ejecuta la copia del gusano en el dispositivo._x000D_\n_x000D_\nEntre la información que puede recopilar este Malware se encuentra:_x000D_\n_x000D_\nNombre de usuario._x000D_\nNombre del equipo._x000D_\nVersión del Sistema Operativo Windows presente en el equipo.",
                "recommendation" => "Se recomienda realizar las siguientes acciones:\n*Analizar el equipo de red interna con algún software Antivirus/Antimalware actualizado con las firmas más recientes en búsqueda de posibles infecciones por código malicioso.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Verificar que el equipo de la red interna ejecute únicamente aquellas aplicaciones, procesos, servicios, etc. que sean indispensables para realizar sus tareas asignadas, por lo cual es necesario deshabilitar o desinstalar toda aplicación o configuración que no sea requerida para tales fines.\n*Posterior al análisis de Malware se deberá verificar que el equipo cuente con las últimas actualizaciones proporcionadas por el fabricante. Es necesario realizar regularmente la actualización de las Aplicaciones y Sistema Operativo con la finalidad de mitigar las vulnerabilidades.",
                "risk" => "Robo de información sensible en el equipo afectado.",
                "reference" => "http://www.symantec.com/connect/articles/security-11-part-1-viruses-and-worms",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "WP Generic revslider Arbitrary File Download",
                "description" => "El servidor WordPress remoto utiliza el plugin “Slider Revolution” (también conocido como RevSlider) el cual es vulnerable a un ataque de tipo “Arbitrary File Download”_x000D_._x000D_\nLa vulnerabilidad permite la descarga del archivo “wp-config.php” mediante el parámetro “img=” del archivo “admin-ajax.php”_x000D_.\n_x000D_\nUn atacante capaz de aprovechar esta vulnerabilidad, puede obtener las credenciales de acceso a la base de datos SQL y comprometer el sitio en cuestión.",
                "recommendation" => "\n Validar si el equipo final tiene instalado Wordpress y de forma especifica el plugin Slider Revolution,  se recomiendar llevar a cabo las siguientes recomendaciones:\n\n* Actualizar de forma inmediata a la última versión de Wordpress.\n*Analizar el equipo de red interna con algún software Antivirus/Antimalware actualizado con las firmas más recientes en búsqueda de posibles infecciones por código malicioso.\n*Validar si el equipo presenta cambios en su configuración (modificación y creación de cuentas de usuarios, modificación en los permisos, configuraciones de sistema y seguridad, etc.) que no hayan sido autorizados.\n*Verificar que el equipo de la red interna ejecute únicamente aquellas aplicaciones, procesos, servicios, etc. que sean indispensables para realizar sus tareas asignadas, por lo cual es necesario deshabilitar o desinstalar toda aplicación o configuración que no sea requerida para tales fines.\n*Posterior al análisis de Malware se deberá verificar que el equipo cuente con las últimas actualizaciones proporcionadas por el fabricante. Es necesario realizar regularmente la actualización de las Aplicaciones y Sistema Operativo con la finalidad de mitigar las vulnerabilidades.",
                "risk" => "Robo de credenciales.\nRobo de información sensible en el equipo afectado.\nAcceso no autorizado al sistema comprometiendo el equipo .\nCambio en la configuración del servidor.",
                "reference" => "https://blog.sucuri.net/2014/09/slider-revolution-plugin-critical-vulnerability-being-exploited.html",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "TeamViewer Keep-alive inbound",
                "description" => "TeamViewer es un software cuya función es conectarse remotamente a otro equipo, la alerta keep-alive se muestra porque los equipos que se encuentran conectados de forma remota han perdido la conexión y no están conectados a ningún servidor. Esto es que los equipos han perdido toda comunicación para poder trabajar de forma remota.\n_x000D_\nBásicamente los programas que funcionan de forma remota suelen ser usados como objetivos de escaneos esto es identificar la versión que se encuentre instalada para después buscar algún exploit y con ello poder conseguir el acceso no autorizado al servicio, haciendo que el equipo al que se esté atacando sea vulnerable y el atacante tenga acceso total del equipo. _x000D_\n\n",
                "recommendation" => "Validar que el uso de la aplicación TeamViewer se encuentra permitida dentro de la institución, en caso de no estar permitida se sugiere desinstalar la aplicación del equipo.          \nUtilizar VPN y software de acceso remoto que se encuentre dentro de las políticas de seguridad de la empresa.\nRestringir en lo posible el uso de programas de acceso remoto, lo cual se logra llevando un control de aplicaciones permitidas.",
                "risk" => "Violación a las políticas de uso de software de la institución.   \nAcceso a usuarios no autorizado.\n Fuga de información sensible.",
                "reference" => "http://www.ixiacom.com/about-us/news-events/corporate-blog/magic-teamviewer\n",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Query to a Suspicious no-ip Domain",
                "description" => "Se identificó que dicho dominio es utilizado por diversos tipos de malware para conectar los equipos infectado pertenecientes a alguna botnet [1] a los C&C (Command and control) y poder transmitir información de los equipos [2]. Anteriormente varios proveedores de IP dinámicas fueron bloqueados, y los servicios de IP dinámicos eran utilizados por personas no autorizadas, para redirigir a páginas infectadas con malware.",
                "recommendation" => "    Validar si la comunicación que se reporta es legítima y está permitida en las políticas de uso de equipo de la institución.\n        De no ser así se recomienda identificar el equipo con dirección IP origen.\n        Realizar un análisis completo del equipo con un software antivirus actualizado, para descartar algún tipo de malware.\n    En caso de contar con un servidor de filtrado de contenido, bloquear la navegación hacia el dominio.\n    Bloquear el dominio desde el equipo mediante el archivo hosts, esto varía según el sistema operativo que se utiliza.[3][4]\n    Bloquear la dirección IP pública reportada en el Firewall perimetral.",
                "risk" => "",
                "reference" => "[1] https://www.microsoft.com/es-xl/security/resources/botnet-whatis.aspx\n[2] http://resources.infosecinstitute.com/dns-sinkhole/\n[3] http://norfipc.com/articulos/como-bloquear-impedir-acceso-paginas-sitios-web-internet.html\n[4] https://help.ubuntu.com/community/IptablesHowTo",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "Remote Desktop Administrator Login Request",
                "description" => "Se identificaron una conexión entre equipos a través del puerto 3389. Este puerto está asociado a la aplicación de escritorio remoto del Sistema Operativo “Windows” que se comunica a través del protocolo RDP. [1] [2]\n\nSe logró identificar en el parámetro msthash de la cookie [3] con la que se intenta realizar la conexión para tener acceso.\n\nEl uso de aplicaciones de acceso remoto puede poner en riesgo la integridad y confidencialidad de la información contenida en el equipo, así como causar fugas de información sensible y acceso de personal no autorizado.\n\n*Este evento se considera de severidad ALTA, debido a que la comunicación que se establece es entre direcciones IP de la red interna.",
                "recommendation" => "Validar que el uso de aplicaciones de acceso remoto estén permitidas dentro de las políticas de uso del equipo de la institución.\n\nEn caso contrario se recomienda identificar los equipos con las direcciones IP reportadas y desinstalar cualquier software de esta naturaleza.\n\nSi el acceso vía RDP está permitido, validar que la conexión entre los equipos reportados sea legítima.\n\nLa contraseña utilizada para el acceso vía RDP es la misma que la contraseña para ingresar al equipo de manera física, por lo que se recomienda que dicha contraseña tenga características de contraseña segura. [4]\n\nSi el servicio de Escritorio Remoto no está activo en el equipo con dirección IP local [IP], es recomendable cerrar el puerto 3389 TCP, para evitar futuros incidentes que intenten explotar alguna vulnerabilidad del protocolo RDP.",
                "risk" => "El uso de aplicaciones de acceso remoto puede poner en riesgo la integridad y confidencialidad de la información contenida en el equipo, así como causar fugas de información sensible y acceso de personal no autorizado.\n",
                "reference" => "[1] http://support.microsoft.com/kb/186607/es\n[2] http://practicasintermedias2012usac.blogspot.mx/2012/11/remote-desktop-protocol.html\n[3] http://www.snakelegs.org/2011/02/06/rdp-cookies-2/\n[4] https://support.google.com/accounts/answer/32040?hl=es",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ],
            [

                "name" => "ProxyReconBot CONNECT method to Mail",
                "description" => "este tipo de actividad puede estar relacionada a escaneos de vulnerabilidades a traves del servicio web ó solicitudes hacia el servidor Proxy para resolver hacia un servicio de correo.",
                "recommendation" => "    Se puede agregar una regla al archivo hosts del equipo local para negar el acceso al sitio reportado, la manera de hacer esto varia si se trata de un sistema operativo Windows o Linux. \n    Implementar una aplicación WAF (Web Application Firewall) con la que se pueden identificar y bloquear ataques a servidores web.\n    Como medida adicional, se sugiere bloquear la dirección IP pública en el firewall perimetral.",
                "risk" => "",
                "reference" => "",
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
                "deleted_at" => null
            ]

        ];
        foreach ($attackCategories as $attackCategory) {
            DB::table('attack_category')->insert($attackCategory);
        }
    }


}
