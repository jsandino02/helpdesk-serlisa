CREATE TABLE dg_zonas(
	id_zona INT PRIMARY KEY AUTO_INCREMENT
	,descripcion VARCHAR(100)
	,deleted INT NOT NULL DEFAULT 0
)

CREATE TABLE dg_dhl_rate (
	id INT PRIMARY KEY AUTO_INCREMENT 
	, peso_desde float
	, peso_hasta float
	,id_zona int
	,costo_envio float
);

CREATE TABLE dg_combutible(
	id INT PRIMARY KEY AUTO_INCREMENT
	,porcentaje float
);

ALTER TABLE dg_products ADD peso_kg FLOAT
ALTER TABLE dg_categories ADD peso_kg FLOAT
ALTER TABLE dg_country ADD zona_id INT 

INSERT INTO dg_zonas(descripcion) VALUES('ZONA 1 AM');
INSERT INTO dg_zonas(descripcion) VALUES('ZONA 2 EU');
INSERT INTO dg_zonas(descripcion) VALUES('ZONA 3 AP');
INSERT INTO dg_zonas(descripcion) VALUES('ZONA 4 ROW');

INSERT INTO dg_dhl_rate(peso_desde, peso_hasta, id_zona, costo_envio) VALUES (0, 0.5, 1, 22);
INSERT INTO dg_dhl_rate(peso_desde, peso_hasta, id_zona, costo_envio) VALUES (0.5, 1, 1, 22);
INSERT INTO dg_dhl_rate(peso_desde, peso_hasta, id_zona, costo_envio) VALUES (1, 1.5, 1, 22);
INSERT INTO dg_dhl_rate(peso_desde, peso_hasta, id_zona, costo_envio) VALUES (1.5, 2, 1 ,22);
INSERT INTO dg_dhl_rate(peso_desde, peso_hasta, id_zona, costo_envio) VALUES (2, 2.5, 1 ,22);
INSERT INTO dg_dhl_rate(peso_desde, peso_hasta, id_zona, costo_envio) VALUES (2.5, 3, 1 ,22);

CREATE TABLE tbl_temporal_paises(
 codigo VARCHAR(5)
 ,nombre VARCHAR(150)
 ,zona INT 
);

INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('AD', 'Andorra ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('AE', 'UAE ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('AF', 'Afghanistan ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('AG', 'Antigua ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('AI', 'Anguilla ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('AL', 'Albania ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('AM', 'Armenia ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('AO', 'Angola ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('AR', 'Argentina ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('AS', 'American Samoa ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('AT', 'Austria ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('AU', 'Australia ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('AW', 'Aruba ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('AZ', 'Azerbaijan ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('BA', 'Bosnia & Herzegovina ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('BB', 'Barbados ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('BD', 'Bangladesh ', 3);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('BE', 'Belgium ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('BF', 'Burkina Faso ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('BG', 'Bulgaria ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('BH', 'Bahrain ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('BI', 'Burundi ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('BJ', 'Benin ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('BM', 'Bermuda ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('BN', 'Brunei ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('BO', 'Bolivia ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('BR', 'Brazil ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('BS', 'Bahamas ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('BT', 'Bhutan ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('BW', 'Botswana ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('BY', 'Belarus ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('BZ', 'Belize ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('CA', 'Canada ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('CD', 'Congo, Dem Rep of ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('CF', 'Central African Rep ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('CG', 'Congo ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('CH', 'Switzerland ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('CI', 'Cote d\'Ivoire ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('CK', 'Cook Islands ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('CL', 'Chile ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('CM', 'Cameroon ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('CN', 'China, People\'s Rep ', 3);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('CO', 'Colombia ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('CR', 'Costa Rica ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('CU', 'Cuba ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('CV', 'Cape Verde ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('CY', 'Cyprus ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('CZ', 'Czech Republic ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('DE', 'Germany ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('DJ', 'Djibouti ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('DK', 'Denmark ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('DM', 'Dominica ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('DO', 'Dominican Republic ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('DZ', 'Algeria ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('EC', 'Ecuador ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('EE', 'Estonia ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('EG', 'Egypt ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('ER', 'Eritrea ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('ES', 'Spain ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('ET', 'Ethiopia ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('FI', 'Finland ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('FJ', 'Fiji ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('FK', 'Falkland Islands ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('FM', 'Micronesia ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('FO', 'Faroe Islands ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('FR', 'France ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('GA', 'Gabon ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('GB', 'United Kingdom ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('GD', 'Grenada ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('GE', 'Georgia ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('GF', 'French Guyana ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('GG', 'Guernsey ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('GH', 'Ghana ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('GI', 'Gibraltar ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('GL', 'Greenland ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('GM', 'Gambia ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('GN', 'Guinea Republic ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('GP', 'Guadeloupe ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('GQ', 'Guinea-Equatorial ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('GR', 'Greece ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('GT', 'Guatemala ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('GU', 'Guam ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('GW', 'Guinea-Bissau ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('GY', 'Guyana (British) ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('HK', 'Hong Kong ', 3);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('HN', 'Honduras ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('HR', 'Croatia ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('HT', 'Haiti ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('HU', 'Hungary ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('IC', 'Canary Islands ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('ID', 'Indonesia ', 3);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('IE', 'Ireland, Rep of ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('IL', 'Israel ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('IN', 'India ', 3);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('IQ', 'Iraq ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('IR', 'Iran ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('IS', 'Iceland ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('IT', 'Italy ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('JE', 'Jersey ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('JM', 'Jamaica ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('JO', 'Jordan ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('JP', 'Japan ', 3);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('KE', 'Kenya ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('KG', 'Kyrgyzstan ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('KH', 'Cambodia ', 3);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('KI', 'Kiribati ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('KM', 'Comoros ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('KN', 'St. Kitts ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('KP', 'Korea, D.P.R of ', 3);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('KR', 'Korea, Rep of ', 3);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('KV', 'Kosovo ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('KW', 'Kuwait ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('KY', 'Cayman Islands ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('KZ', 'Kazakhstan ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('LA', 'Laos ', 3);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('LB', 'Lebanon ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('LC', 'St. Lucia ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('LI', 'Liechtenstein ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('LK', 'Sri Lanka ', 3);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('LR', 'Liberia ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('LS', 'Lesotho ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('LT', 'Lithuania ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('LU', 'Luxembourg ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('LV', 'Latvia ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('LY', 'Libya ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('MA', 'Morocco ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('MC', 'Monaco ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('MD', 'Moldova, Rep Of ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('ME', 'Montenegro, Rep of ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('MG', 'Madagascar ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('MH', 'Marsh  Islands', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('MK', 'Macedonia, Rep of ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('ML', 'Mali ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('MM', 'Myanmar ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('MN', 'Mongolia ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('MO', 'Macau ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('MP', 'Saipan ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('MQ', 'Martinique ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('MR', 'Mauritania ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('MS', 'Montserrat ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('MT', 'Malta ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('MU', 'Mauritius ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('MV', 'Maldives ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('MW', 'Malawi ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('MX', 'Mexico ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('MY', 'Malaysia ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('MZ', 'Mozambique ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('NA', 'Namibia ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('NC', 'New Caledonia ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('NE', 'Niger ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('NG', 'Nigeria ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('NI', 'Nicaragua ', 0);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('NL', 'Netherlands ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('NO', 'Norway ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('NP', 'Nepal ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('NR', 'Nauru, Rep Of ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('NU', 'Niue ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('NZ', 'New Zealand ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('OM', 'Oman ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('PA', 'Panama ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('PE', 'Peru ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('PF', 'Tahiti ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('PG', 'Papua New Guinea ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('PH', 'Philippines ', 3);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('PK', 'Pakistan ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('PL', 'Poland ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('PR', 'Puerto Rico ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('PT', 'Portugal ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('PW', 'Palau ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('PY', 'Paraguay ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('QA', 'Qatar ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('RE', 'Reunion, Island Of ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('RO', 'Romania ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('RS', 'Serbia, Rep of ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('RU', 'Russian Federation ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('RW', 'Rwanda ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('SA', 'Saudi Arabia ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('SB', 'Solomon Islands ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('SC', 'Seychelles ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('SD', 'Sudan ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('SE', 'Sweden ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('SG', 'Singapore ', 3);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('SH', 'St. Helena ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('SI', 'Slovenia ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('SK', 'Slovakia ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('SL', 'Sierra Leone ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('SM', 'San Marino ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('SN', 'Senegal ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('SO', 'Somalia ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('SR', 'Suriname ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('SS', 'South Sudan ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('ST', 'Sao Tome & Principe ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('SV', 'El Salvador ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('SY', 'Syria ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('SZ', 'Swaziland ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('TC', 'Turks & Caicos Islands ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('TD', 'Chad ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('TG', 'Togo ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('TH', 'Thailand ', 3);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('TJ', 'Tajikistan ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('TL', 'East Timor ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('TN', 'Tunisia ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('TO', 'Tonga ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('TR', 'Turkey ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('TT', 'Trinidad & Tobago ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('TV', 'Tuvalu ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('TW', 'Taiwan ', 3);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('TZ', 'Tanzania ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('UA', 'Ukraine ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('UG', 'Uganda ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('US', 'USA ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('US', 'USA - Miami Area BCT', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('US', 'USA - Miami Area EYW', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('US', 'USA - Miami Area MIA', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('US', 'USA - Miami Area OPF', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('US', 'USA - Miami Area TMB', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('US', 'USA - New York Area JFB', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('US', 'USA - New York Area JFK', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('US', 'USA - New York Area JRA', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('US', 'USA - New York Area ELZ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('US', 'USA - New York Area TSS', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('US', 'USA - New York Area ZYP', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('UY', 'Uruguay ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('UZ', 'Uzbekistan ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('VA', 'Vatican ', 2);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('VC', 'St. Vincent ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('VE', 'Venezuela ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('VG', 'Virgin Islands (British) ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('VI', 'Virgin Islands (US) ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('VN', 'Vietnam ', 3);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('VU', 'Vanuatu ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('WS', 'Samoa ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('XB', 'Bonaire ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('XC', 'Curacao ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('XE', 'St. Eustatius ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('XM', 'St. Maarten ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('XN', 'Nevis ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('XS', 'Somaliland (N. Somalia) ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('XY', 'St. Barthelemy ', 1);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('YE', 'Yemen, Rep of ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('YT', 'Mayotte ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('ZA', 'South Africa ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('ZM', 'Zambia ', 4);
INSERT INTO `tbl_temporal_paises` (`codigo`, `nombre`, `zona`) VALUES ('ZW', 'Zimbabwe ', 4);

UPDATE dg_country,tbl_temporal_paises
SET dg_country.zona_id  = tbl_temporal_paises.zona
WHERE dg_country.code_2 = tbl_temporal_paises.codigo

SELECT c.*, t.zona
FROM dg_country c
INNER JOIN tbl_temporal_paises t ON t.codigo = c.code_2
























