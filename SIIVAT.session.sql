-- CREATE OR REPLACE VIEW estadistico_vw AS
SELECT
  'Antecedentes Familiares' form,
  data.age,
  SUM(CASE data.gender WHEN 1 THEN 1 ELSE 0 END) 'feminine',
  SUM(CASE data.gender WHEN 2 THEN 1 ELSE 0 END) 'masculine',
  SUM(CASE data.gender WHEN 0 THEN 1 ELSE 0 END) 'gender_inv',
  COUNT(*) total
FROM(
SELECT
CASE
  WHEN ld.gender IN ('Mujer', 'FEMENINO') THEN 1
  WHEN ld.gender IN ('Hombre', 'MASCULINO') THEN 2
  ELSE 0
END gender,
CASE
  WHEN bp.age = 0 THEN 'Menor a 1 año'
  WHEN bp.age BETWEEN 1 AND 5 THEN 'Entre 1 y 5 años'
  WHEN bp.age BETWEEN 6 AND 12 THEN 'Entre 6 y 12 años'
  WHEN bp.age > 12 THEN 'Más de 12 años'
  ELSE 'Sin edad/No válido'
END age
FROM familyrecorddata fr
JOIN loaddata ld ON ld.id_data = fr.id_data
LEFT JOIN basicpatientdata bp ON bp.id = fr.id_patient
WHERE ld.id_form = 1) AS data GROUP BY data.age
  UNION
SELECT
  'DASS-21' form,
  data.age,
  SUM(CASE data.gender WHEN 1 THEN 1 ELSE 0 END) 'feminine',
  SUM(CASE data.gender WHEN 2 THEN 1 ELSE 0 END) 'masculine',
  SUM(CASE data.gender WHEN 0 THEN 1 ELSE 0 END) 'gender_inv',
  COUNT(*) total
FROM(
SELECT
CASE
  WHEN pw.gender IN ('Mujer', 'FEMENINO') THEN 1
  WHEN pw.gender IN ('Hombre', 'MASCULINO') THEN 2
  ELSE 0
END gender,
CASE
  WHEN pw.age = 0 THEN 'Menor a 1 año'
  WHEN pw.age BETWEEN 1 AND 5 THEN 'Entre 1 y 5 años'
  WHEN pw.age BETWEEN 6 AND 12 THEN 'Entre 6 y 12 años'
  WHEN pw.age > 12 THEN 'Más de 12 años'
  ELSE 'Sin edad/No válido'
END age
FROM dass21data fd
LEFT JOIN patients_vw pw on pw.id_patient = fd.id_patient
) AS data GROUP BY data.age
  UNION
SELECT
  'Medio ambiente' form,
  data.age,
  SUM(CASE data.gender WHEN 1 THEN 1 ELSE 0 END) 'feminine',
  SUM(CASE data.gender WHEN 2 THEN 1 ELSE 0 END) 'masculine',
  SUM(CASE data.gender WHEN 0 THEN 1 ELSE 0 END) 'gender_inv',
  COUNT(*) total
FROM(
SELECT
CASE
  WHEN pw.gender IN ('Mujer', 'FEMENINO') THEN 1
  WHEN pw.gender IN ('Hombre', 'MASCULINO') THEN 2
  ELSE 0
END gender,
CASE
  WHEN pw.age = 0 THEN 'Menor a 1 año'
  WHEN pw.age BETWEEN 1 AND 5 THEN 'Entre 1 y 5 años'
  WHEN pw.age BETWEEN 6 AND 12 THEN 'Entre 6 y 12 años'
  WHEN pw.age > 12 THEN 'Más de 12 años'
  ELSE 'Sin edad/No válido'
END age
FROM environmentdata fd
LEFT JOIN patients_vw pw on pw.id_patient = fd.id_patient
) AS data GROUP BY data.age
  UNION
SELECT
  'Depresión geriátrica' form,
  data.age,
  SUM(CASE data.gender WHEN 1 THEN 1 ELSE 0 END) 'feminine',
  SUM(CASE data.gender WHEN 2 THEN 1 ELSE 0 END) 'masculine',
  SUM(CASE data.gender WHEN 0 THEN 1 ELSE 0 END) 'gender_inv',
  COUNT(*) total
FROM(
SELECT
CASE
  WHEN pw.gender IN ('Mujer', 'FEMENINO') THEN 1
  WHEN pw.gender IN ('Hombre', 'MASCULINO') THEN 2
  ELSE 0
END gender,
CASE
  WHEN pw.age = 0 THEN 'Menor a 1 año'
  WHEN pw.age BETWEEN 1 AND 5 THEN 'Entre 1 y 5 años'
  WHEN pw.age BETWEEN 6 AND 12 THEN 'Entre 6 y 12 años'
  WHEN pw.age > 12 THEN 'Más de 12 años'
  ELSE 'Sin edad/No válido'
END age
FROM geriatricdepressiondata fd
LEFT JOIN patients_vw pw on pw.id_patient = fd.id_patient
) AS data GROUP BY data.age
  UNION
SELECT
  'Escala de Zarit' form,
  data.age,
  SUM(CASE data.gender WHEN 1 THEN 1 ELSE 0 END) 'feminine',
  SUM(CASE data.gender WHEN 2 THEN 1 ELSE 0 END) 'masculine',
  SUM(CASE data.gender WHEN 0 THEN 1 ELSE 0 END) 'gender_inv',
  COUNT(*) total
FROM(
SELECT
CASE
  WHEN pw.gender IN ('Mujer', 'FEMENINO') THEN 1
  WHEN pw.gender IN ('Hombre', 'MASCULINO') THEN 2
  ELSE 0
END gender,
CASE
  WHEN pw.age = 0 THEN 'Menor a 1 año'
  WHEN pw.age BETWEEN 1 AND 5 THEN 'Entre 1 y 5 años'
  WHEN pw.age BETWEEN 6 AND 12 THEN 'Entre 6 y 12 años'
  WHEN pw.age > 12 THEN 'Más de 12 años'
  ELSE 'Sin edad/No válido'
END age
FROM zarittscaledata fd
LEFT JOIN patients_vw pw on pw.id_patient = fd.id_patient
) AS data GROUP BY data.age
  UNION
SELECT
  'Enfermedades de transmisión sexual' form,
  data.age,
  SUM(CASE data.gender WHEN 1 THEN 1 ELSE 0 END) 'feminine',
  SUM(CASE data.gender WHEN 2 THEN 1 ELSE 0 END) 'masculine',
  SUM(CASE data.gender WHEN 0 THEN 1 ELSE 0 END) 'gender_inv',
  COUNT(*) total
FROM(
SELECT
CASE
  WHEN pw.gender IN ('Mujer', 'FEMENINO') THEN 1
  WHEN pw.gender IN ('Hombre', 'MASCULINO') THEN 2
  ELSE 0
END gender,
CASE
  WHEN pw.age = 0 THEN 'Menor a 1 año'
  WHEN pw.age BETWEEN 1 AND 5 THEN 'Entre 1 y 5 años'
  WHEN pw.age BETWEEN 6 AND 12 THEN 'Entre 6 y 12 años'
  WHEN pw.age > 12 THEN 'Más de 12 años'
  ELSE 'Sin edad/No válido'
END age
FROM etsdata fd
LEFT JOIN patients_vw pw on pw.id_patient = fd.id_patient
) AS data GROUP BY data.age
  UNION
SELECT
  'Cuestionario socio-cultural' form,
  data.age,
  SUM(CASE data.gender WHEN 1 THEN 1 ELSE 0 END) 'feminine',
  SUM(CASE data.gender WHEN 2 THEN 1 ELSE 0 END) 'masculine',
  SUM(CASE data.gender WHEN 0 THEN 1 ELSE 0 END) 'gender_inv',
  COUNT(*) total
FROM(
SELECT
CASE
  WHEN pw.gender IN ('Mujer', 'FEMENINO') THEN 1
  WHEN pw.gender IN ('Hombre', 'MASCULINO') THEN 2
  ELSE 0
END gender,
CASE
  WHEN pw.age = 0 THEN 'Menor a 1 año'
  WHEN pw.age BETWEEN 1 AND 5 THEN 'Entre 1 y 5 años'
  WHEN pw.age BETWEEN 6 AND 12 THEN 'Entre 6 y 12 años'
  WHEN pw.age > 12 THEN 'Más de 12 años'
  ELSE 'Sin edad/No válido'
END age
FROM socioculturaldata fd
LEFT JOIN patients_vw pw on pw.id_patient = fd.id_patient
) AS data GROUP BY data.age
  UNION
SELECT
  'Diabetes mellitus' form,
  data.age,
  SUM(CASE data.gender WHEN 1 THEN 1 ELSE 0 END) 'feminine',
  SUM(CASE data.gender WHEN 2 THEN 1 ELSE 0 END) 'masculine',
  SUM(CASE data.gender WHEN 0 THEN 1 ELSE 0 END) 'gender_inv',
  COUNT(*) total
FROM(
SELECT
CASE
  WHEN pw.gender IN ('Mujer', 'FEMENINO') THEN 1
  WHEN pw.gender IN ('Hombre', 'MASCULINO') THEN 2
  ELSE 0
END gender,
CASE
  WHEN pw.age = 0 THEN 'Menor a 1 año'
  WHEN pw.age BETWEEN 1 AND 5 THEN 'Entre 1 y 5 años'
  WHEN pw.age BETWEEN 6 AND 12 THEN 'Entre 6 y 12 años'
  WHEN pw.age > 12 THEN 'Más de 12 años'
  ELSE 'Sin edad/No válido'
END age
FROM diabetesdata fd
LEFT JOIN patients_vw pw on pw.id_patient = fd.id_patient
) AS data GROUP BY data.age
  UNION
SELECT
  'Hipertensión Arterial Sistémica' form,
  data.age,
  SUM(CASE data.gender WHEN 1 THEN 1 ELSE 0 END) 'feminine',
  SUM(CASE data.gender WHEN 2 THEN 1 ELSE 0 END) 'masculine',
  SUM(CASE data.gender WHEN 0 THEN 1 ELSE 0 END) 'gender_inv',
  COUNT(*) total
FROM(
SELECT
CASE
  WHEN pw.gender IN ('Mujer', 'FEMENINO') THEN 1
  WHEN pw.gender IN ('Hombre', 'MASCULINO') THEN 2
  ELSE 0
END gender,
CASE
  WHEN pw.age = 0 THEN 'Menor a 1 año'
  WHEN pw.age BETWEEN 1 AND 5 THEN 'Entre 1 y 5 años'
  WHEN pw.age BETWEEN 6 AND 12 THEN 'Entre 6 y 12 años'
  WHEN pw.age > 12 THEN 'Más de 12 años'
  ELSE 'Sin edad/No válido'
END age
FROM hypertensiondata fd
LEFT JOIN patients_vw pw on pw.id_patient = fd.id_patient
) AS data GROUP BY data.age
  UNION
SELECT
  'Estilo de vida personal de [0-1] años' form,
  data.age,
  SUM(CASE data.gender WHEN 1 THEN 1 ELSE 0 END) 'feminine',
  SUM(CASE data.gender WHEN 2 THEN 1 ELSE 0 END) 'masculine',
  SUM(CASE data.gender WHEN 0 THEN 1 ELSE 0 END) 'gender_inv',
  COUNT(*) total
FROM(
SELECT
CASE
  WHEN pw.gender IN ('Mujer', 'FEMENINO') THEN 1
  WHEN pw.gender IN ('Hombre', 'MASCULINO') THEN 2
  ELSE 0
END gender,
CASE
  WHEN pw.age = 0 THEN 'Menor a 1 año'
  WHEN pw.age BETWEEN 1 AND 5 THEN 'Entre 1 y 5 años'
  WHEN pw.age BETWEEN 6 AND 12 THEN 'Entre 6 y 12 años'
  WHEN pw.age > 12 THEN 'Más de 12 años'
  ELSE 'Sin edad/No válido'
END age
FROM bornlifestyledata fd
LEFT JOIN patients_vw pw on pw.id_patient = fd.id_patient
) AS data GROUP BY data.age
  UNION
SELECT
  'Estilo de vida personal de [6-12] años' form,
  data.age,
  SUM(CASE data.gender WHEN 1 THEN 1 ELSE 0 END) 'feminine',
  SUM(CASE data.gender WHEN 2 THEN 1 ELSE 0 END) 'masculine',
  SUM(CASE data.gender WHEN 0 THEN 1 ELSE 0 END) 'gender_inv',
  COUNT(*) total
FROM(
SELECT
CASE
  WHEN pw.gender IN ('Mujer', 'FEMENINO') THEN 1
  WHEN pw.gender IN ('Hombre', 'MASCULINO') THEN 2
  ELSE 0
END gender,
CASE
  WHEN pw.age = 0 THEN 'Menor a 1 año'
  WHEN pw.age BETWEEN 1 AND 5 THEN 'Entre 1 y 5 años'
  WHEN pw.age BETWEEN 6 AND 12 THEN 'Entre 6 y 12 años'
  WHEN pw.age > 12 THEN 'Más de 12 años'
  ELSE 'Sin edad/No válido'
END age
FROM childlifestyledata fd
LEFT JOIN patients_vw pw on pw.id_patient = fd.id_patient
) AS data GROUP BY data.age
  UNION
SELECT
  'Estilo de vida personal de [12+] años.' form,
  data.age,
  SUM(CASE data.gender WHEN 1 THEN 1 ELSE 0 END) 'feminine',
  SUM(CASE data.gender WHEN 2 THEN 1 ELSE 0 END) 'masculine',
  SUM(CASE data.gender WHEN 0 THEN 1 ELSE 0 END) 'gender_inv',
  COUNT(*) total
FROM(
SELECT
CASE
  WHEN pw.gender IN ('Mujer', 'FEMENINO') THEN 1
  WHEN pw.gender IN ('Hombre', 'MASCULINO') THEN 2
  ELSE 0
END gender,
CASE
  WHEN pw.age = 0 THEN 'Menor a 1 año'
  WHEN pw.age BETWEEN 1 AND 5 THEN 'Entre 1 y 5 años'
  WHEN pw.age BETWEEN 6 AND 12 THEN 'Entre 6 y 12 años'
  WHEN pw.age > 12 THEN 'Más de 12 años'
  ELSE 'Sin edad/No válido'
END age
FROM younglifestyledata fd
LEFT JOIN patients_vw pw on pw.id_patient = fd.id_patient
) AS data GROUP BY data.age
  UNION
SELECT
  'Estilo de vida personal de [1-5] años' form,
  data.age,
  SUM(CASE data.gender WHEN 1 THEN 1 ELSE 0 END) 'feminine',
  SUM(CASE data.gender WHEN 2 THEN 1 ELSE 0 END) 'masculine',
  SUM(CASE data.gender WHEN 0 THEN 1 ELSE 0 END) 'gender_inv',
  COUNT(*) total
FROM(
SELECT
CASE
  WHEN pw.gender IN ('Mujer', 'FEMENINO') THEN 1
  WHEN pw.gender IN ('Hombre', 'MASCULINO') THEN 2
  ELSE 0
END gender,
CASE
  WHEN pw.age = 0 THEN 'Menor a 1 año'
  WHEN pw.age BETWEEN 1 AND 5 THEN 'Entre 1 y 5 años'
  WHEN pw.age BETWEEN 6 AND 12 THEN 'Entre 6 y 12 años'
  WHEN pw.age > 12 THEN 'Más de 12 años'
  ELSE 'Sin edad/No válido'
END age
FROM babylifestyledata fd
LEFT JOIN patients_vw pw on pw.id_patient = fd.id_patient
) AS data GROUP BY data.age
  UNION
SELECT
  'Ginecología' form,
  data.age,
  SUM(CASE data.gender WHEN 1 THEN 1 ELSE 0 END) 'feminine',
  SUM(CASE data.gender WHEN 2 THEN 1 ELSE 0 END) 'masculine',
  SUM(CASE data.gender WHEN 0 THEN 1 ELSE 0 END) 'gender_inv',
  COUNT(*) total
FROM(
SELECT
CASE
  WHEN pw.gender IN ('Mujer', 'FEMENINO') THEN 1
  WHEN pw.gender IN ('Hombre', 'MASCULINO') THEN 2
  ELSE 0
END gender,
CASE
  WHEN pw.age = 0 THEN 'Menor a 1 año'
  WHEN pw.age BETWEEN 1 AND 5 THEN 'Entre 1 y 5 años'
  WHEN pw.age BETWEEN 6 AND 12 THEN 'Entre 6 y 12 años'
  WHEN pw.age > 12 THEN 'Más de 12 años'
  ELSE 'Sin edad/No válido'
END age
FROM gynecologydata fd
LEFT JOIN patients_vw pw on pw.id_patient = fd.id_patient
) AS data GROUP BY data.age
  UNION
SELECT
  'PBIQ' form,
  data.age,
  SUM(CASE data.gender WHEN 1 THEN 1 ELSE 0 END) 'feminine',
  SUM(CASE data.gender WHEN 2 THEN 1 ELSE 0 END) 'masculine',
  SUM(CASE data.gender WHEN 0 THEN 1 ELSE 0 END) 'gender_inv',
  COUNT(*) total
FROM(
SELECT
CASE
  WHEN pw.gender IN ('Mujer', 'FEMENINO') THEN 1
  WHEN pw.gender IN ('Hombre', 'MASCULINO') THEN 2
  ELSE 0
END gender,
CASE
  WHEN pw.age = 0 THEN 'Menor a 1 año'
  WHEN pw.age BETWEEN 1 AND 5 THEN 'Entre 1 y 5 años'
  WHEN pw.age BETWEEN 6 AND 12 THEN 'Entre 6 y 12 años'
  WHEN pw.age > 12 THEN 'Más de 12 años'
  ELSE 'Sin edad/No válido'
END age
FROM healthcaredata fd
LEFT JOIN patients_vw pw on pw.id_patient = fd.id_patient
) AS data GROUP BY data.age
  UNION
SELECT
  'Signos vitales + Laboratorio' form,
  data.age,
  SUM(CASE data.gender WHEN 1 THEN 1 ELSE 0 END) 'feminine',
  SUM(CASE data.gender WHEN 2 THEN 1 ELSE 0 END) 'masculine',
  SUM(CASE data.gender WHEN 0 THEN 1 ELSE 0 END) 'gender_inv',
  COUNT(*) total
FROM(
SELECT
CASE
  WHEN pw.gender IN ('Mujer', 'FEMENINO') THEN 1
  WHEN pw.gender IN ('Hombre', 'MASCULINO') THEN 2
  ELSE 0
END gender,
CASE
  WHEN pw.age = 0 THEN 'Menor a 1 año'
  WHEN pw.age BETWEEN 1 AND 5 THEN 'Entre 1 y 5 años'
  WHEN pw.age BETWEEN 6 AND 12 THEN 'Entre 6 y 12 años'
  WHEN pw.age > 12 THEN 'Más de 12 años'
  ELSE 'Sin edad/No válido'
END age
FROM vitalsigndata fd
LEFT JOIN patients_vw pw on pw.id_patient = fd.id_patient
) AS data GROUP BY data.age
  UNION
SELECT
  'Violencia de género' form,
  data.age,
  SUM(CASE data.gender WHEN 1 THEN 1 ELSE 0 END) 'feminine',
  SUM(CASE data.gender WHEN 2 THEN 1 ELSE 0 END) 'masculine',
  SUM(CASE data.gender WHEN 0 THEN 1 ELSE 0 END) 'gender_inv',
  COUNT(*) total
FROM(
SELECT
CASE
  WHEN pw.gender IN ('Mujer', 'FEMENINO') THEN 1
  WHEN pw.gender IN ('Hombre', 'MASCULINO') THEN 2
  ELSE 0
END gender,
CASE
  WHEN pw.age = 0 THEN 'Menor a 1 año'
  WHEN pw.age BETWEEN 1 AND 5 THEN 'Entre 1 y 5 años'
  WHEN pw.age BETWEEN 6 AND 12 THEN 'Entre 6 y 12 años'
  WHEN pw.age > 12 THEN 'Más de 12 años'
  ELSE 'Sin edad/No válido'
END age
FROM genderviolencedata fd
LEFT JOIN patients_vw pw on pw.id_patient = fd.id_patient
) AS data GROUP BY data.age
  UNION
SELECT
  'Esquema de vacunación de [0-9] años' form,
  data.age,
  SUM(CASE data.gender WHEN 1 THEN 1 ELSE 0 END) 'feminine',
  SUM(CASE data.gender WHEN 2 THEN 1 ELSE 0 END) 'masculine',
  SUM(CASE data.gender WHEN 0 THEN 1 ELSE 0 END) 'gender_inv',
  COUNT(*) total
FROM(
SELECT
CASE
  WHEN pw.gender IN ('Mujer', 'FEMENINO') THEN 1
  WHEN pw.gender IN ('Hombre', 'MASCULINO') THEN 2
  ELSE 0
END gender,
CASE
  WHEN pw.age < 10 THEN 'Hasta 9 años'
  WHEN pw.age BETWEEN 10 AND 19 THEN 'Entre 10 y 19 años'
  WHEN pw.age BETWEEN 20 AND 59 THEN 'Entre 20 y 59 años'
  WHEN pw.age > 59 THEN '60 o más años'
  ELSE 'Sin edad/No válido'
END age
FROM childvaccinationdata fd
LEFT JOIN patients_vw pw on pw.id_patient = fd.id_patient
) AS data GROUP BY data.age
  UNION
SELECT
  'Esquema de vacunación de [10-19] años' form,
  data.age,
  SUM(CASE data.gender WHEN 1 THEN 1 ELSE 0 END) 'feminine',
  SUM(CASE data.gender WHEN 2 THEN 1 ELSE 0 END) 'masculine',
  SUM(CASE data.gender WHEN 0 THEN 1 ELSE 0 END) 'gender_inv',
  COUNT(*) total
FROM(
SELECT
CASE
  WHEN pw.gender IN ('Mujer', 'FEMENINO') THEN 1
  WHEN pw.gender IN ('Hombre', 'MASCULINO') THEN 2
  ELSE 0
END gender,
CASE
  WHEN pw.age < 10 THEN 'Hasta 9 años'
  WHEN pw.age BETWEEN 10 AND 19 THEN 'Entre 10 y 19 años'
  WHEN pw.age BETWEEN 20 AND 59 THEN 'Entre 20 y 59 años'
  WHEN pw.age > 59 THEN '60 o más años'
  ELSE 'Sin edad/No válido'
END age
FROM youngvaccinationdata fd
LEFT JOIN patients_vw pw on pw.id_patient = fd.id_patient
) AS data GROUP BY data.age
  UNION
SELECT
  'Esquema de vacunación de [20-59] años' form,
  data.age,
  SUM(CASE data.gender WHEN 1 THEN 1 ELSE 0 END) 'feminine',
  SUM(CASE data.gender WHEN 2 THEN 1 ELSE 0 END) 'masculine',
  SUM(CASE data.gender WHEN 0 THEN 1 ELSE 0 END) 'gender_inv',
  COUNT(*) total
FROM(
SELECT
CASE
  WHEN pw.gender IN ('Mujer', 'FEMENINO') THEN 1
  WHEN pw.gender IN ('Hombre', 'MASCULINO') THEN 2
  ELSE 0
END gender,
CASE
  WHEN pw.age < 10 THEN 'Hasta 9 años'
  WHEN pw.age BETWEEN 10 AND 19 THEN 'Entre 10 y 19 años'
  WHEN pw.age BETWEEN 20 AND 59 THEN 'Entre 20 y 59 años'
  WHEN pw.age > 59 THEN '60 o más años'
  ELSE 'Sin edad/No válido'
END age
FROM adultvaccinationdata fd
LEFT JOIN patients_vw pw on pw.id_patient = fd.id_patient
) AS data GROUP BY data.age
  UNION
SELECT
  'Esquema de vacunación de [60+] años' form,
  data.age,
  SUM(CASE data.gender WHEN 1 THEN 1 ELSE 0 END) 'feminine',
  SUM(CASE data.gender WHEN 2 THEN 1 ELSE 0 END) 'masculine',
  SUM(CASE data.gender WHEN 0 THEN 1 ELSE 0 END) 'gender_inv',
  COUNT(*) total
FROM(
SELECT
CASE
  WHEN pw.gender IN ('Mujer', 'FEMENINO') THEN 1
  WHEN pw.gender IN ('Hombre', 'MASCULINO') THEN 2
  ELSE 0
END gender,
CASE
  WHEN pw.age < 10 THEN 'Hasta 9 años'
  WHEN pw.age BETWEEN 10 AND 19 THEN 'Entre 10 y 19 años'
  WHEN pw.age BETWEEN 20 AND 59 THEN 'Entre 20 y 59 años'
  WHEN pw.age > 59 THEN '60 o más años'
  ELSE 'Sin edad/No válido'
END age
FROM eldervaccinationdata fd
LEFT JOIN patients_vw pw on pw.id_patient = fd.id_patient
) AS data GROUP BY data.age
  UNION
SELECT
  'Desesperanza de Beck' form,
  data.age,
  SUM(CASE data.gender WHEN 1 THEN 1 ELSE 0 END) 'feminine',
  SUM(CASE data.gender WHEN 2 THEN 1 ELSE 0 END) 'masculine',
  SUM(CASE data.gender WHEN 0 THEN 1 ELSE 0 END) 'gender_inv',
  COUNT(*) total
FROM(
SELECT
CASE
  WHEN pw.gender IN ('Mujer', 'FEMENINO') THEN 1
  WHEN pw.gender IN ('Hombre', 'MASCULINO') THEN 2
  ELSE 0
END gender,
CASE
  WHEN pw.age = 0 THEN 'Menor a 1 año'
  WHEN pw.age BETWEEN 1 AND 5 THEN 'Entre 1 y 5 años'
  WHEN pw.age BETWEEN 6 AND 12 THEN 'Entre 6 y 12 años'
  WHEN pw.age > 12 THEN 'Más de 12 años'
  ELSE 'Sin edad/No válido'
END age
FROM hopelessdata fd
LEFT JOIN patients_vw pw on pw.id_patient = fd.id_patient
) AS data GROUP BY data.age