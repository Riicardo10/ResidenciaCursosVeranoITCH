MATERIAS SOLICITADAS
+----+------------------------+----------------+---------------+-----------------------+----------+------+
| id | no_control_coordinador | clave_profesor | clave_materia | nombre_materia           | aprobada | anio |
+----+------------------------+----------------+---------------+-----------------------+----------+------+
|  3 | 123                    			    | NULL           	   | 18           		    | Calculo vectorial    		   |        0  	| 2018 |
|  7 | 123                    			    | NULL           	   | 8            		    | Estatica              	       |        0 		| 2018 |
| 12 | 1111                   			    | NULL           	   | 13           		    | Matematicas discretas |        0 		| 2018 |
| 13 | 1111                   			    | NULL           	   | 18           		    | Calculo vectorial     	   |        0 		| 2018 |
+----+------------------------+----------------+---------------+-----------------------+----------+------+



3		Yair Martinez Mesino			NULL	Calculo vectorial				0		2018
7		Yair Martinez Mesino			NULL	Estatica							0		2018
12		Juan Gutierrez Salmeron		NULL	Matematicas discretas		0		2018
13		Juan Gutierrez Salmeron		NULL	Calculo vectorial				0		2018


SELECT 
  MATERIAS_SOLICITADAS.id, 
  MATERIAS_SOLICITADAS.clave_materia, 
  MATERIAS_SOLICITADAS.nombre_materia, 
  MATERIAS_SOLICITADAS.aprobada, 
  MATERIAS_SOLICITADAS.anio, 
  MATERIAS.clave_carrera,  
  COORDINADORES.no_control,  
  COORDINADORES.nombre, 
  COORDINADORES.apellido_paterno, 
  COORDINADORES.apellido_materno 
  FROM MATERIAS_SOLICITADAS 
  JOIN MATERIAS 
  JOIN COORDINADORES  
  WHERE MATERIAS_SOLICITADAS.clave_materia = MATERIAS.clave 
  AND MATERIAS_SOLICITADAS.no_control_coordinador = COORDINADORES.no_control  
  AND clave_carrera = '1' 
  AND anio = '2018';





















  SELECT 
  MATERIAS_SOLICITADAS.id, 
  MATERIAS_SOLICITADAS.clave_profesor, 
  MATERIAS_SOLICITADAS.clave_materia, 
  MATERIAS_SOLICITADAS.nombre_materia, 
  MATERIAS_SOLICITADAS.aprobada, 
  MATERIAS_SOLICITADAS.anio, 
  MATERIAS.clave_carrera,  
  COORDINADORES.no_control,  
  COORDINADORES.nombre, 
  COORDINADORES.apellido_paterno, 
  COORDINADORES.apellido_materno, 
  PROFESORES.nombre, 
  PROFESORES.apellido_paterno, 
  PROFESORES.apellido_materno
  FROM MATERIAS_SOLICITADAS 
  JOIN MATERIAS 
  JOIN COORDINADORES 
  JOIN PROFESORES  
  WHERE MATERIAS_SOLICITADAS.clave_materia = MATERIAS.clave 
  AND MATERIAS_SOLICITADAS.no_control_coordinador = COORDINADORES.no_control  
  AND MATERIAS_SOLICITADAS.clave_profesor = PROFESORES.clave    
  AND clave_carrera = '1' 
  AND anio = '2018';






-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 
-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 
-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 
-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 
-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- 
  SELECT 
  MATERIAS_SOLICITADAS.id, 
  MATERIAS_SOLICITADAS.clave_materia, 
  MATERIAS_SOLICITADAS.nombre_materia, 
  MATERIAS_SOLICITADAS.aprobada, 
  MATERIAS_SOLICITADAS.anio, 
  MATERIAS.clave_carrera,  
  COORDINADORES.no_control,  
  COORDINADORES.nombre, 
  COORDINADORES.apellido_paterno, 
  COORDINADORES.apellido_materno, 
  MATERIAS_SOLICITADAS.clave_profesor 
  FROM MATERIAS_SOLICITADAS 
  JOIN MATERIAS 
  JOIN COORDINADORES 
  WHERE MATERIAS_SOLICITADAS.clave_materia = MATERIAS.clave 
  AND MATERIAS_SOLICITADAS.no_control_coordinador = COORDINADORES.no_control  
  AND clave_carrera = '1' 
  AND anio = '2018';
