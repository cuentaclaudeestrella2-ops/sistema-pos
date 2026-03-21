<?php

namespace Database\Seeders;

use App\Models\Inventario;
use Illuminate\Database\Seeder;

class FullStockSeeder extends Seeder
{
    public function run(): void
    {
        $productos = [
            // ═══════════════════════════════════════════
            // 🔥 1. MOTOR (AMPLIADO)
            // ═══════════════════════════════════════════
            ['codigo'=>'MOT-001','nombre'=>'Pistón Motor Estándar 0.25mm','categoria'=>'Motor','marca'=>'Takumi','unidad'=>'Unidad','precio1'=>85,'precio2'=>75,'precio3'=>68,'stock'=>20,'stockMin'=>5],
            ['codigo'=>'MOT-002','nombre'=>'Juego Anillos de Pistón 0.50mm','categoria'=>'Motor','marca'=>'NPR','unidad'=>'Juego','precio1'=>45,'precio2'=>38,'precio3'=>35,'stock'=>30,'stockMin'=>8],
            ['codigo'=>'MOT-003','nombre'=>'Biela Motor Completa con Casquillo','categoria'=>'Motor','marca'=>'OEM','unidad'=>'Unidad','precio1'=>120,'precio2'=>105,'precio3'=>95,'stock'=>10,'stockMin'=>3],
            ['codigo'=>'MOT-004','nombre'=>'Cigüeñal Motor Rectificado','categoria'=>'Motor','marca'=>'OEM','unidad'=>'Unidad','precio1'=>350,'precio2'=>320,'precio3'=>290,'stock'=>4,'stockMin'=>2],
            ['codigo'=>'MOT-005','nombre'=>'Árbol de Levas Admisión','categoria'=>'Motor','marca'=>'INA','unidad'=>'Unidad','precio1'=>280,'precio2'=>250,'precio3'=>230,'stock'=>6,'stockMin'=>2],
            ['codigo'=>'MOT-006','nombre'=>'Kit Taqués Hidráulicos (Juego 8)','categoria'=>'Motor','marca'=>'INA','unidad'=>'Juego','precio1'=>150,'precio2'=>130,'precio3'=>120,'stock'=>8,'stockMin'=>3],
            ['codigo'=>'MOT-007','nombre'=>'Válvula Admisión Motor','categoria'=>'Motor','marca'=>'TRW','unidad'=>'Unidad','precio1'=>35,'precio2'=>30,'precio3'=>28,'stock'=>40,'stockMin'=>10],
            ['codigo'=>'MOT-008','nombre'=>'Válvula Escape Motor','categoria'=>'Motor','marca'=>'TRW','unidad'=>'Unidad','precio1'=>38,'precio2'=>33,'precio3'=>30,'stock'=>40,'stockMin'=>10],
            ['codigo'=>'MOT-009','nombre'=>'Guías de Válvula (Juego)','categoria'=>'Motor','marca'=>'OEM','unidad'=>'Juego','precio1'=>60,'precio2'=>52,'precio3'=>48,'stock'=>15,'stockMin'=>4],
            ['codigo'=>'MOT-010','nombre'=>'Retén de Válvula (juego 8)','categoria'=>'Motor','marca'=>'Victor Reinz','unidad'=>'Juego','precio1'=>25,'precio2'=>20,'precio3'=>18,'stock'=>30,'stockMin'=>8],
            ['codigo'=>'MOT-011','nombre'=>'Culata Completa Motor','categoria'=>'Motor','marca'=>'OEM','unidad'=>'Unidad','precio1'=>650,'precio2'=>600,'precio3'=>550,'stock'=>3,'stockMin'=>1],
            ['codigo'=>'MOT-012','nombre'=>'Juego Empaques Completo Motor','categoria'=>'Motor','marca'=>'Victor Reinz','unidad'=>'Kit','precio1'=>180,'precio2'=>160,'precio3'=>145,'stock'=>12,'stockMin'=>4],
            ['codigo'=>'MOT-013','nombre'=>'Junta de Culata Grafitada','categoria'=>'Motor','marca'=>'Victor Reinz','unidad'=>'Unidad','precio1'=>95,'precio2'=>85,'precio3'=>78,'stock'=>15,'stockMin'=>5],
            ['codigo'=>'MOT-014','nombre'=>'Bomba de Aceite Motor','categoria'=>'Motor','marca'=>'Melling','unidad'=>'Unidad','precio1'=>120,'precio2'=>105,'precio3'=>95,'stock'=>8,'stockMin'=>3],
            ['codigo'=>'MOT-015','nombre'=>'Bomba de Agua Motor','categoria'=>'Motor','marca'=>'GMB','unidad'=>'Unidad','precio1'=>85,'precio2'=>75,'precio3'=>68,'stock'=>12,'stockMin'=>4],
            ['codigo'=>'MOT-016','nombre'=>'Radiador Aluminio/Plástico','categoria'=>'Motor','marca'=>'Denso','unidad'=>'Unidad','precio1'=>220,'precio2'=>195,'precio3'=>180,'stock'=>6,'stockMin'=>2],
            ['codigo'=>'MOT-017','nombre'=>'Ventilador Eléctrico Radiador','categoria'=>'Motor','marca'=>'Denso','unidad'=>'Unidad','precio1'=>150,'precio2'=>130,'precio3'=>120,'stock'=>5,'stockMin'=>2],
            ['codigo'=>'MOT-018','nombre'=>'Termostato Motor 82°C','categoria'=>'Motor','marca'=>'Gates','unidad'=>'Unidad','precio1'=>25,'precio2'=>20,'precio3'=>18,'stock'=>25,'stockMin'=>8],
            ['codigo'=>'MOT-019','nombre'=>'Sensor Temperatura Motor ECT','categoria'=>'Motor','marca'=>'Bosch','unidad'=>'Unidad','precio1'=>35,'precio2'=>30,'precio3'=>28,'stock'=>20,'stockMin'=>6],
            ['codigo'=>'MOT-020','nombre'=>'Sensor de Oxígeno Lambda','categoria'=>'Motor','marca'=>'Bosch','unidad'=>'Unidad','precio1'=>85,'precio2'=>75,'precio3'=>68,'stock'=>15,'stockMin'=>5],
            ['codigo'=>'MOT-021','nombre'=>'Sensor MAP/MAF Flujo de Aire','categoria'=>'Motor','marca'=>'Bosch','unidad'=>'Unidad','precio1'=>120,'precio2'=>105,'precio3'=>95,'stock'=>10,'stockMin'=>3],
            ['codigo'=>'MOT-022','nombre'=>'Correa de Distribución','categoria'=>'Motor','marca'=>'Gates','unidad'=>'Unidad','precio1'=>65,'precio2'=>55,'precio3'=>50,'stock'=>18,'stockMin'=>6],
            ['codigo'=>'MOT-023','nombre'=>'Tensor Correa Distribución','categoria'=>'Motor','marca'=>'Gates','unidad'=>'Unidad','precio1'=>75,'precio2'=>65,'precio3'=>58,'stock'=>12,'stockMin'=>4],
            ['codigo'=>'MOT-024','nombre'=>'Polea Cigüeñal Damper','categoria'=>'Motor','marca'=>'OEM','unidad'=>'Unidad','precio1'=>90,'precio2'=>80,'precio3'=>72,'stock'=>8,'stockMin'=>3],

            // ═══════════════════════════════════════════
            // 🛢️ 2. MANTENIMIENTO (AMPLIADO)
            // ═══════════════════════════════════════════
            ['codigo'=>'MNT-001','nombre'=>'Aceite Motor Motul 7100 10W40 1L (Sintético)','categoria'=>'Mantenimiento','marca'=>'Motul','unidad'=>'Litro','precio1'=>65,'precio2'=>58,'precio3'=>55,'stock'=>50,'stockMin'=>15],
            ['codigo'=>'MNT-002','nombre'=>'Aceite Motor Mineral 20W50 1L','categoria'=>'Mantenimiento','marca'=>'Castrol','unidad'=>'Litro','precio1'=>35,'precio2'=>30,'precio3'=>28,'stock'=>60,'stockMin'=>20],
            ['codigo'=>'MNT-003','nombre'=>'Aceite Semisintético 10W30 1L','categoria'=>'Mantenimiento','marca'=>'Shell','unidad'=>'Litro','precio1'=>48,'precio2'=>42,'precio3'=>38,'stock'=>40,'stockMin'=>12],
            ['codigo'=>'MNT-004','nombre'=>'Filtro de Aceite Original','categoria'=>'Mantenimiento','marca'=>'Toyota Gen','unidad'=>'Unidad','precio1'=>35,'precio2'=>30,'precio3'=>28,'stock'=>45,'stockMin'=>10],
            ['codigo'=>'MNT-005','nombre'=>'Filtro de Aire Motor','categoria'=>'Mantenimiento','marca'=>'Fram','unidad'=>'Unidad','precio1'=>28,'precio2'=>24,'precio3'=>22,'stock'=>35,'stockMin'=>10],
            ['codigo'=>'MNT-006','nombre'=>'Filtro de Gasolina Universal','categoria'=>'Mantenimiento','marca'=>'Fram','unidad'=>'Unidad','precio1'=>15,'precio2'=>12,'precio3'=>10,'stock'=>50,'stockMin'=>15],
            ['codigo'=>'MNT-007','nombre'=>'Filtro de Cabina Antipolen','categoria'=>'Mantenimiento','marca'=>'Bosch','unidad'=>'Unidad','precio1'=>30,'precio2'=>25,'precio3'=>22,'stock'=>25,'stockMin'=>8],
            ['codigo'=>'MNT-008','nombre'=>'Refrigerante Coolant Verde 1GL','categoria'=>'Mantenimiento','marca'=>'Prestone','unidad'=>'Galón','precio1'=>35,'precio2'=>30,'precio3'=>28,'stock'=>30,'stockMin'=>10],
            ['codigo'=>'MNT-009','nombre'=>'Líquido de Frenos DOT4 500ml','categoria'=>'Mantenimiento','marca'=>'Wagner','unidad'=>'Botella','precio1'=>20,'precio2'=>17,'precio3'=>15,'stock'=>40,'stockMin'=>12],
            ['codigo'=>'MNT-010','nombre'=>'Aditivo Motor Pro-Engine','categoria'=>'Mantenimiento','marca'=>'STP','unidad'=>'Unidad','precio1'=>25,'precio2'=>22,'precio3'=>20,'stock'=>30,'stockMin'=>8],
            ['codigo'=>'MNT-011','nombre'=>'Limpiador de Inyectores Concentrado','categoria'=>'Mantenimiento','marca'=>'Wynn\'s','unidad'=>'Botella','precio1'=>35,'precio2'=>30,'precio3'=>28,'stock'=>25,'stockMin'=>8],
            ['codigo'=>'MNT-012','nombre'=>'Limpiador de Carburador Spray','categoria'=>'Mantenimiento','marca'=>'CRC','unidad'=>'Lata','precio1'=>22,'precio2'=>18,'precio3'=>16,'stock'=>35,'stockMin'=>10],

            // ═══════════════════════════════════════════
            // ⚡ 3. SISTEMA ELÉCTRICO (PRO)
            // ═══════════════════════════════════════════
            ['codigo'=>'ELC-001','nombre'=>'Batería 12V 60Ah Libre Mantenimiento','categoria'=>'Eléctrico','marca'=>'Bosch','unidad'=>'Unidad','precio1'=>320,'precio2'=>290,'precio3'=>270,'stock'=>8,'stockMin'=>3],
            ['codigo'=>'ELC-002','nombre'=>'Alternador Reconstruido 90A','categoria'=>'Eléctrico','marca'=>'Denso','unidad'=>'Unidad','precio1'=>280,'precio2'=>250,'precio3'=>230,'stock'=>5,'stockMin'=>2],
            ['codigo'=>'ELC-003','nombre'=>'Motor de Arranque Reconstruido','categoria'=>'Eléctrico','marca'=>'Bosch','unidad'=>'Unidad','precio1'=>250,'precio2'=>220,'precio3'=>200,'stock'=>5,'stockMin'=>2],
            ['codigo'=>'ELC-004','nombre'=>'Relé Multifunción 12V 40A','categoria'=>'Eléctrico','marca'=>'Hella','unidad'=>'Unidad','precio1'=>12,'precio2'=>10,'precio3'=>8,'stock'=>50,'stockMin'=>15],
            ['codigo'=>'ELC-005','nombre'=>'Kit Fusibles Surtidos (100 pcs)','categoria'=>'Eléctrico','marca'=>'Generic','unidad'=>'Kit','precio1'=>18,'precio2'=>15,'precio3'=>12,'stock'=>30,'stockMin'=>10],
            ['codigo'=>'ELC-006','nombre'=>'Arnés Eléctrico Principal Motor','categoria'=>'Eléctrico','marca'=>'OEM','unidad'=>'Unidad','precio1'=>180,'precio2'=>160,'precio3'=>145,'stock'=>4,'stockMin'=>2],
            ['codigo'=>'ELC-007','nombre'=>'Sensor CKP Posición Cigüeñal','categoria'=>'Eléctrico','marca'=>'Bosch','unidad'=>'Unidad','precio1'=>65,'precio2'=>55,'precio3'=>50,'stock'=>12,'stockMin'=>4],
            ['codigo'=>'ELC-008','nombre'=>'Bujía Iridium CR8EIX Alto Cilindraje','categoria'=>'Eléctrico','marca'=>'NGK','unidad'=>'Unidad','precio1'=>45,'precio2'=>38,'precio3'=>35,'stock'=>50,'stockMin'=>15],
            ['codigo'=>'ELC-009','nombre'=>'Cable de Bujía Silicona (Juego 4)','categoria'=>'Eléctrico','marca'=>'NGK','unidad'=>'Juego','precio1'=>65,'precio2'=>55,'precio3'=>50,'stock'=>15,'stockMin'=>5],
            ['codigo'=>'ELC-010','nombre'=>'Bobina de Encendido Individual','categoria'=>'Eléctrico','marca'=>'Denso','unidad'=>'Unidad','precio1'=>85,'precio2'=>75,'precio3'=>68,'stock'=>12,'stockMin'=>4],
            ['codigo'=>'ELC-011','nombre'=>'Switch de Encendido con Llave','categoria'=>'Eléctrico','marca'=>'OEM','unidad'=>'Unidad','precio1'=>45,'precio2'=>38,'precio3'=>35,'stock'=>10,'stockMin'=>3],
            ['codigo'=>'ELC-012','nombre'=>'Faro Delantero LED Ojo de Ángel 7"','categoria'=>'Eléctrico','marca'=>'HJG','unidad'=>'Unidad','precio1'=>120,'precio2'=>100,'precio3'=>90,'stock'=>8,'stockMin'=>3],
            ['codigo'=>'ELC-013','nombre'=>'Faros LED Completos Proyector','categoria'=>'Eléctrico','marca'=>'OEM','unidad'=>'Par','precio1'=>350,'precio2'=>310,'precio3'=>280,'stock'=>4,'stockMin'=>2],
            ['codigo'=>'ELC-014','nombre'=>'Intermitentes LED Universal','categoria'=>'Eléctrico','marca'=>'Generic','unidad'=>'Par','precio1'=>25,'precio2'=>20,'precio3'=>18,'stock'=>20,'stockMin'=>6],
            ['codigo'=>'ELC-015','nombre'=>'Bocina Eléctrica 12V Doble Tono','categoria'=>'Eléctrico','marca'=>'Hella','unidad'=>'Unidad','precio1'=>35,'precio2'=>30,'precio3'=>28,'stock'=>15,'stockMin'=>5],

            // ═══════════════════════════════════════════
            // 🛑 4. FRENOS (COMPLETO)
            // ═══════════════════════════════════════════
            ['codigo'=>'FRN-001','nombre'=>'Pastillas de Freno Delantero Cerámicas','categoria'=>'Frenos','marca'=>'Brembo','unidad'=>'Juego','precio1'=>120,'precio2'=>105,'precio3'=>95,'stock'=>15,'stockMin'=>5],
            ['codigo'=>'FRN-002','nombre'=>'Pastillas de Freno Trasero Semi-Metálicas','categoria'=>'Frenos','marca'=>'TRW','unidad'=>'Juego','precio1'=>85,'precio2'=>75,'precio3'=>68,'stock'=>15,'stockMin'=>5],
            ['codigo'=>'FRN-003','nombre'=>'Disco de Freno Ventilado Delantero','categoria'=>'Frenos','marca'=>'Brembo','unidad'=>'Unidad','precio1'=>150,'precio2'=>130,'precio3'=>120,'stock'=>8,'stockMin'=>3],
            ['codigo'=>'FRN-004','nombre'=>'Tambor de Freno Trasero','categoria'=>'Frenos','marca'=>'OEM','unidad'=>'Unidad','precio1'=>95,'precio2'=>85,'precio3'=>78,'stock'=>6,'stockMin'=>2],
            ['codigo'=>'FRN-005','nombre'=>'Bomba de Freno Principal','categoria'=>'Frenos','marca'=>'TRW','unidad'=>'Unidad','precio1'=>180,'precio2'=>160,'precio3'=>145,'stock'=>5,'stockMin'=>2],
            ['codigo'=>'FRN-006','nombre'=>'Bombín de Freno Trasero','categoria'=>'Frenos','marca'=>'TRW','unidad'=>'Unidad','precio1'=>45,'precio2'=>38,'precio3'=>35,'stock'=>10,'stockMin'=>4],
            ['codigo'=>'FRN-007','nombre'=>'Caliper de Freno Delantero','categoria'=>'Frenos','marca'=>'Brembo','unidad'=>'Unidad','precio1'=>250,'precio2'=>220,'precio3'=>200,'stock'=>4,'stockMin'=>2],
            ['codigo'=>'FRN-008','nombre'=>'Servofreno Booster','categoria'=>'Frenos','marca'=>'Bosch','unidad'=>'Unidad','precio1'=>320,'precio2'=>290,'precio3'=>260,'stock'=>3,'stockMin'=>1],
            ['codigo'=>'FRN-009','nombre'=>'Línea de Freno Metálica Flexible','categoria'=>'Frenos','marca'=>'Goodridge','unidad'=>'Unidad','precio1'=>35,'precio2'=>30,'precio3'=>28,'stock'=>20,'stockMin'=>6],
            ['codigo'=>'FRN-010','nombre'=>'Sensor ABS Rueda','categoria'=>'Frenos','marca'=>'Bosch','unidad'=>'Unidad','precio1'=>75,'precio2'=>65,'precio3'=>58,'stock'=>8,'stockMin'=>3],
            ['codigo'=>'FRN-011','nombre'=>'Módulo ABS Electrónico','categoria'=>'Frenos','marca'=>'Bosch','unidad'=>'Unidad','precio1'=>450,'precio2'=>400,'precio3'=>370,'stock'=>2,'stockMin'=>1],

            // ═══════════════════════════════════════════
            // 🛞 5. SUSPENSIÓN Y DIRECCIÓN
            // ═══════════════════════════════════════════
            ['codigo'=>'SUS-001','nombre'=>'Amortiguador Delantero Gas','categoria'=>'Suspensión','marca'=>'Monroe','unidad'=>'Unidad','precio1'=>150,'precio2'=>130,'precio3'=>120,'stock'=>10,'stockMin'=>4],
            ['codigo'=>'SUS-002','nombre'=>'Amortiguador Trasero Gas','categoria'=>'Suspensión','marca'=>'Monroe','unidad'=>'Unidad','precio1'=>120,'precio2'=>105,'precio3'=>95,'stock'=>10,'stockMin'=>4],
            ['codigo'=>'SUS-003','nombre'=>'Resorte Espiral Delantero','categoria'=>'Suspensión','marca'=>'OEM','unidad'=>'Unidad','precio1'=>85,'precio2'=>75,'precio3'=>68,'stock'=>8,'stockMin'=>3],
            ['codigo'=>'SUS-004','nombre'=>'Brazo de Suspensión Inferior','categoria'=>'Suspensión','marca'=>'Moog','unidad'=>'Unidad','precio1'=>120,'precio2'=>105,'precio3'=>95,'stock'=>6,'stockMin'=>2],
            ['codigo'=>'SUS-005','nombre'=>'Rótula de Suspensión Superior','categoria'=>'Suspensión','marca'=>'Moog','unidad'=>'Unidad','precio1'=>55,'precio2'=>48,'precio3'=>42,'stock'=>12,'stockMin'=>4],
            ['codigo'=>'SUS-006','nombre'=>'Terminal de Dirección','categoria'=>'Suspensión','marca'=>'Moog','unidad'=>'Unidad','precio1'=>45,'precio2'=>38,'precio3'=>35,'stock'=>15,'stockMin'=>5],
            ['codigo'=>'SUS-007','nombre'=>'Cremallera de Dirección Completa','categoria'=>'Suspensión','marca'=>'TRW','unidad'=>'Unidad','precio1'=>450,'precio2'=>400,'precio3'=>370,'stock'=>3,'stockMin'=>1],
            ['codigo'=>'SUS-008','nombre'=>'Barra Estabilizadora Delantera','categoria'=>'Suspensión','marca'=>'OEM','unidad'=>'Unidad','precio1'=>95,'precio2'=>85,'precio3'=>78,'stock'=>6,'stockMin'=>2],
            ['codigo'=>'SUS-009','nombre'=>'Buje de Suspensión Poliuretano','categoria'=>'Suspensión','marca'=>'Energy','unidad'=>'Par','precio1'=>35,'precio2'=>30,'precio3'=>28,'stock'=>20,'stockMin'=>6],

            // ═══════════════════════════════════════════
            // ⚙️ 6. TRANSMISIÓN (FULL)
            // ═══════════════════════════════════════════
            ['codigo'=>'TRA-001','nombre'=>'Kit de Embrague Completo','categoria'=>'Transmisión','marca'=>'Valeo','unidad'=>'Kit','precio1'=>350,'precio2'=>310,'precio3'=>280,'stock'=>5,'stockMin'=>2],
            ['codigo'=>'TRA-002','nombre'=>'Disco de Embrague','categoria'=>'Transmisión','marca'=>'Valeo','unidad'=>'Unidad','precio1'=>120,'precio2'=>105,'precio3'=>95,'stock'=>8,'stockMin'=>3],
            ['codigo'=>'TRA-003','nombre'=>'Prensa de Embrague','categoria'=>'Transmisión','marca'=>'Valeo','unidad'=>'Unidad','precio1'=>150,'precio2'=>130,'precio3'=>120,'stock'=>6,'stockMin'=>2],
            ['codigo'=>'TRA-004','nombre'=>'Collarín de Embrague Hidráulico','categoria'=>'Transmisión','marca'=>'Valeo','unidad'=>'Unidad','precio1'=>85,'precio2'=>75,'precio3'=>68,'stock'=>8,'stockMin'=>3],
            ['codigo'=>'TRA-005','nombre'=>'Kit de Arrastre Racing (Cadena+Piñón+Corona)','categoria'=>'Transmisión','marca'=>'RIZOMA','unidad'=>'Kit','precio1'=>280,'precio2'=>250,'precio3'=>230,'stock'=>6,'stockMin'=>2],
            ['codigo'=>'TRA-006','nombre'=>'Eje de Transmisión Homocinético','categoria'=>'Transmisión','marca'=>'OEM','unidad'=>'Unidad','precio1'=>220,'precio2'=>195,'precio3'=>180,'stock'=>4,'stockMin'=>2],
            ['codigo'=>'TRA-007','nombre'=>'Junta Homocinética Interna','categoria'=>'Transmisión','marca'=>'OEM','unidad'=>'Unidad','precio1'=>90,'precio2'=>80,'precio3'=>72,'stock'=>8,'stockMin'=>3],
            ['codigo'=>'TRA-008','nombre'=>'Diferencial Aceite SAE 90 1L','categoria'=>'Transmisión','marca'=>'Castrol','unidad'=>'Litro','precio1'=>35,'precio2'=>30,'precio3'=>28,'stock'=>20,'stockMin'=>6],
            ['codigo'=>'TRA-009','nombre'=>'Soporte de Caja de Cambios','categoria'=>'Transmisión','marca'=>'OEM','unidad'=>'Unidad','precio1'=>65,'precio2'=>55,'precio3'=>50,'stock'=>8,'stockMin'=>3],

            // ═══════════════════════════════════════════
            // 🚗 7. CARROCERÍA (AMPLIADO)
            // ═══════════════════════════════════════════
            ['codigo'=>'CAR-001','nombre'=>'Parachoques Delantero Universal','categoria'=>'Carrocería','marca'=>'OEM','unidad'=>'Unidad','precio1'=>280,'precio2'=>250,'precio3'=>230,'stock'=>4,'stockMin'=>1],
            ['codigo'=>'CAR-002','nombre'=>'Capot Universal Acero','categoria'=>'Carrocería','marca'=>'OEM','unidad'=>'Unidad','precio1'=>350,'precio2'=>310,'precio3'=>290,'stock'=>3,'stockMin'=>1],
            ['codigo'=>'CAR-003','nombre'=>'Puerta Delantera Izquierda','categoria'=>'Carrocería','marca'=>'OEM','unidad'=>'Unidad','precio1'=>450,'precio2'=>400,'precio3'=>370,'stock'=>2,'stockMin'=>1],
            ['codigo'=>'CAR-004','nombre'=>'Guardafango Delantero','categoria'=>'Carrocería','marca'=>'OEM','unidad'=>'Unidad','precio1'=>120,'precio2'=>105,'precio3'=>95,'stock'=>6,'stockMin'=>2],
            ['codigo'=>'CAR-005','nombre'=>'Espejo Retrovisor Eléctrico','categoria'=>'Carrocería','marca'=>'OEM','unidad'=>'Par','precio1'=>180,'precio2'=>160,'precio3'=>145,'stock'=>5,'stockMin'=>2],
            ['codigo'=>'CAR-006','nombre'=>'Parrilla Frontal Cromada','categoria'=>'Carrocería','marca'=>'OEM','unidad'=>'Unidad','precio1'=>95,'precio2'=>85,'precio3'=>78,'stock'=>6,'stockMin'=>2],
            ['codigo'=>'CAR-007','nombre'=>'Moldura Lateral Protectora','categoria'=>'Carrocería','marca'=>'Generic','unidad'=>'Juego','precio1'=>45,'precio2'=>38,'precio3'=>35,'stock'=>10,'stockMin'=>3],
            ['codigo'=>'CAR-008','nombre'=>'Calavera Trasera LED','categoria'=>'Carrocería','marca'=>'OEM','unidad'=>'Unidad','precio1'=>150,'precio2'=>130,'precio3'=>120,'stock'=>6,'stockMin'=>2],

            // ═══════════════════════════════════════════
            // 🛞 8. RUEDAS
            // ═══════════════════════════════════════════
            ['codigo'=>'RUE-001','nombre'=>'Llanta 185/65 R15 All Season','categoria'=>'Ruedas','marca'=>'Bridgestone','unidad'=>'Unidad','precio1'=>250,'precio2'=>220,'precio3'=>200,'stock'=>12,'stockMin'=>4],
            ['codigo'=>'RUE-002','nombre'=>'Aro de Aluminio 15" 5 Huecos','categoria'=>'Ruedas','marca'=>'OEM','unidad'=>'Unidad','precio1'=>180,'precio2'=>160,'precio3'=>145,'stock'=>8,'stockMin'=>4],
            ['codigo'=>'RUE-003','nombre'=>'Pernos de Rueda Cromados (20pcs)','categoria'=>'Ruedas','marca'=>'McGard','unidad'=>'Juego','precio1'=>35,'precio2'=>30,'precio3'=>28,'stock'=>15,'stockMin'=>5],
            ['codigo'=>'RUE-004','nombre'=>'Rodamiento de Rueda Delantera','categoria'=>'Ruedas','marca'=>'SKF','unidad'=>'Unidad','precio1'=>65,'precio2'=>55,'precio3'=>50,'stock'=>12,'stockMin'=>4],
            ['codigo'=>'RUE-005','nombre'=>'Tapacubos Universales 14" (Juego 4)','categoria'=>'Ruedas','marca'=>'Generic','unidad'=>'Juego','precio1'=>45,'precio2'=>38,'precio3'=>35,'stock'=>10,'stockMin'=>3],

            // ═══════════════════════════════════════════
            // 🏍️ 9. TRANSMISIÓN MOTO
            // ═══════════════════════════════════════════
            ['codigo'=>'MTR-001','nombre'=>'Cadena Moto 428H 120 Eslabones','categoria'=>'Moto Transmisión','marca'=>'DID','unidad'=>'Unidad','precio1'=>65,'precio2'=>55,'precio3'=>50,'stock'=>15,'stockMin'=>5],
            ['codigo'=>'MTR-002','nombre'=>'Catalina Trasera Moto Z42','categoria'=>'Moto Transmisión','marca'=>'JT Sprockets','unidad'=>'Unidad','precio1'=>35,'precio2'=>30,'precio3'=>28,'stock'=>20,'stockMin'=>6],
            ['codigo'=>'MTR-003','nombre'=>'Piñón Delantero Moto 14T','categoria'=>'Moto Transmisión','marca'=>'JT Sprockets','unidad'=>'Unidad','precio1'=>22,'precio2'=>18,'precio3'=>16,'stock'=>25,'stockMin'=>8],
            ['codigo'=>'MTR-004','nombre'=>'Kit Transmisión Moto Completo 428','categoria'=>'Moto Transmisión','marca'=>'DID','unidad'=>'Kit','precio1'=>110,'precio2'=>95,'precio3'=>85,'stock'=>10,'stockMin'=>4],

            // ═══════════════════════════════════════════
            // ⚙️ 10. MOTOR MOTO
            // ═══════════════════════════════════════════
            ['codigo'=>'MMT-001','nombre'=>'Pistón Moto 150cc Estándar','categoria'=>'Moto Motor','marca'=>'Takumi','unidad'=>'Unidad','precio1'=>45,'precio2'=>38,'precio3'=>35,'stock'=>20,'stockMin'=>6],
            ['codigo'=>'MMT-002','nombre'=>'Anillos Pistón Moto 150cc','categoria'=>'Moto Motor','marca'=>'NPR','unidad'=>'Juego','precio1'=>22,'precio2'=>18,'precio3'=>16,'stock'=>30,'stockMin'=>8],
            ['codigo'=>'MMT-003','nombre'=>'Culata Moto 150-200cc','categoria'=>'Moto Motor','marca'=>'OEM','unidad'=>'Unidad','precio1'=>180,'precio2'=>160,'precio3'=>145,'stock'=>5,'stockMin'=>2],
            ['codigo'=>'MMT-004','nombre'=>'Carburador Moto 26mm','categoria'=>'Moto Motor','marca'=>'Keihin','unidad'=>'Unidad','precio1'=>120,'precio2'=>105,'precio3'=>95,'stock'=>8,'stockMin'=>3],
            ['codigo'=>'MMT-005','nombre'=>'Inyector Moto 200cc','categoria'=>'Moto Motor','marca'=>'OEM','unidad'=>'Unidad','precio1'=>85,'precio2'=>75,'precio3'=>68,'stock'=>10,'stockMin'=>3],
            ['codigo'=>'MMT-006','nombre'=>'CDI Moto Racing Programable','categoria'=>'Moto Motor','marca'=>'Racing','unidad'=>'Unidad','precio1'=>65,'precio2'=>55,'precio3'=>50,'stock'=>12,'stockMin'=>4],
            ['codigo'=>'MMT-007','nombre'=>'Bobina Moto Alta Tensión','categoria'=>'Moto Motor','marca'=>'NGK','unidad'=>'Unidad','precio1'=>35,'precio2'=>30,'precio3'=>28,'stock'=>15,'stockMin'=>5],
            ['codigo'=>'MMT-008','nombre'=>'Bujía Moto Iridium CR8EIX','categoria'=>'Moto Motor','marca'=>'NGK','unidad'=>'Unidad','precio1'=>28,'precio2'=>24,'precio3'=>22,'stock'=>40,'stockMin'=>12],

            // ═══════════════════════════════════════════
            // 🛑 11. FRENOS MOTO
            // ═══════════════════════════════════════════
            ['codigo'=>'MFR-001','nombre'=>'Pastillas Freno Moto Delanteras','categoria'=>'Moto Frenos','marca'=>'EBC','unidad'=>'Juego','precio1'=>35,'precio2'=>30,'precio3'=>28,'stock'=>25,'stockMin'=>8],
            ['codigo'=>'MFR-002','nombre'=>'Disco Freno Moto Delantero','categoria'=>'Moto Frenos','marca'=>'EBC','unidad'=>'Unidad','precio1'=>85,'precio2'=>75,'precio3'=>68,'stock'=>10,'stockMin'=>3],
            ['codigo'=>'MFR-003','nombre'=>'Bomba Freno Moto Delantera','categoria'=>'Moto Frenos','marca'=>'Brembo','unidad'=>'Unidad','precio1'=>120,'precio2'=>105,'precio3'=>95,'stock'=>6,'stockMin'=>2],
            ['codigo'=>'MFR-004','nombre'=>'Línea de Freno Moto Trenzada','categoria'=>'Moto Frenos','marca'=>'Goodridge','unidad'=>'Unidad','precio1'=>45,'precio2'=>38,'precio3'=>35,'stock'=>12,'stockMin'=>4],

            // ═══════════════════════════════════════════
            // 🛞 12. SUSPENSIÓN MOTO
            // ═══════════════════════════════════════════
            ['codigo'=>'MSU-001','nombre'=>'Amortiguador Trasero Moto Gas','categoria'=>'Moto Suspensión','marca'=>'YSS','unidad'=>'Unidad','precio1'=>180,'precio2'=>160,'precio3'=>145,'stock'=>8,'stockMin'=>3],
            ['codigo'=>'MSU-002','nombre'=>'Horquillas Delanteras Moto (Par)','categoria'=>'Moto Suspensión','marca'=>'OEM','unidad'=>'Par','precio1'=>250,'precio2'=>220,'precio3'=>200,'stock'=>4,'stockMin'=>2],
            ['codigo'=>'MSU-003','nombre'=>'Barras de Horquilla Repuesto','categoria'=>'Moto Suspensión','marca'=>'OEM','unidad'=>'Par','precio1'=>150,'precio2'=>130,'precio3'=>120,'stock'=>5,'stockMin'=>2],

            // ═══════════════════════════════════════════
            // 🧱 13. ESTRUCTURA MOTO
            // ═══════════════════════════════════════════
            ['codigo'=>'MES-001','nombre'=>'Manubrio Moto Aluminio Racing','categoria'=>'Moto Estructura','marca'=>'ProTaper','unidad'=>'Unidad','precio1'=>85,'precio2'=>75,'precio3'=>68,'stock'=>10,'stockMin'=>3],
            ['codigo'=>'MES-002','nombre'=>'Asiento Moto Ergonómico','categoria'=>'Moto Estructura','marca'=>'OEM','unidad'=>'Unidad','precio1'=>65,'precio2'=>55,'precio3'=>50,'stock'=>8,'stockMin'=>3],
            ['codigo'=>'MES-003','nombre'=>'Pedal de Freno Moto','categoria'=>'Moto Estructura','marca'=>'OEM','unidad'=>'Unidad','precio1'=>25,'precio2'=>20,'precio3'=>18,'stock'=>15,'stockMin'=>5],
            ['codigo'=>'MES-004','nombre'=>'Soporte Motor Moto','categoria'=>'Moto Estructura','marca'=>'OEM','unidad'=>'Unidad','precio1'=>45,'precio2'=>38,'precio3'=>35,'stock'=>8,'stockMin'=>3],

            // ═══════════════════════════════════════════
            // ⚡ 14. ELÉCTRICO MOTO
            // ═══════════════════════════════════════════
            ['codigo'=>'MEL-001','nombre'=>'Batería Moto 12V 7Ah YTX7A','categoria'=>'Moto Eléctrico','marca'=>'Yuasa','unidad'=>'Unidad','precio1'=>85,'precio2'=>75,'precio3'=>68,'stock'=>12,'stockMin'=>4],
            ['codigo'=>'MEL-002','nombre'=>'Luces LED Moto Faro Delantero','categoria'=>'Moto Eléctrico','marca'=>'HJG','unidad'=>'Unidad','precio1'=>65,'precio2'=>55,'precio3'=>50,'stock'=>10,'stockMin'=>3],
            ['codigo'=>'MEL-003','nombre'=>'Intermitentes LED Moto (Par)','categoria'=>'Moto Eléctrico','marca'=>'Generic','unidad'=>'Par','precio1'=>22,'precio2'=>18,'precio3'=>16,'stock'=>20,'stockMin'=>6],
            ['codigo'=>'MEL-004','nombre'=>'Regulador de Voltaje Moto','categoria'=>'Moto Eléctrico','marca'=>'OEM','unidad'=>'Unidad','precio1'=>35,'precio2'=>30,'precio3'=>28,'stock'=>12,'stockMin'=>4],

            // ═══════════════════════════════════════════
            // 💣 15. ACCESORIOS
            // ═══════════════════════════════════════════
            ['codigo'=>'ACC-001','nombre'=>'Funda Protectora Moto Impermeable','categoria'=>'Accesorios','marca'=>'Generic','unidad'=>'Unidad','precio1'=>45,'precio2'=>38,'precio3'=>35,'stock'=>15,'stockMin'=>5],
            ['codigo'=>'ACC-002','nombre'=>'Casco Integral Certificado DOT','categoria'=>'Accesorios','marca'=>'LS2','unidad'=>'Unidad','precio1'=>220,'precio2'=>195,'precio3'=>180,'stock'=>8,'stockMin'=>3],
            ['codigo'=>'ACC-003','nombre'=>'Guantes Moto Cuero/Kevlar','categoria'=>'Accesorios','marca'=>'Alpinestars','unidad'=>'Par','precio1'=>85,'precio2'=>75,'precio3'=>68,'stock'=>12,'stockMin'=>4],
            ['codigo'=>'ACC-004','nombre'=>'Alarma Auto/Moto con Control','categoria'=>'Accesorios','marca'=>'Viper','unidad'=>'Kit','precio1'=>120,'precio2'=>105,'precio3'=>95,'stock'=>10,'stockMin'=>3],
            ['codigo'=>'ACC-005','nombre'=>'Cámara de Reversa HD con Pantalla','categoria'=>'Accesorios','marca'=>'Generic','unidad'=>'Kit','precio1'=>95,'precio2'=>85,'precio3'=>78,'stock'=>8,'stockMin'=>3],
            ['codigo'=>'ACC-006','nombre'=>'Radio Auto Bluetooth USB MP3','categoria'=>'Accesorios','marca'=>'Pioneer','unidad'=>'Unidad','precio1'=>150,'precio2'=>130,'precio3'=>120,'stock'=>6,'stockMin'=>2],
            ['codigo'=>'ACC-007','nombre'=>'Cargador USB Auto 12V Dual','categoria'=>'Accesorios','marca'=>'Anker','unidad'=>'Unidad','precio1'=>18,'precio2'=>15,'precio3'=>12,'stock'=>30,'stockMin'=>10],
            ['codigo'=>'ACC-008','nombre'=>'Soporte Celular Moto/Auto Universal','categoria'=>'Accesorios','marca'=>'RAM Mount','unidad'=>'Unidad','precio1'=>35,'precio2'=>30,'precio3'=>28,'stock'=>20,'stockMin'=>6],
            ['codigo'=>'ACC-009','nombre'=>'Luces LED Decorativas Interior Auto','categoria'=>'Accesorios','marca'=>'Generic','unidad'=>'Kit','precio1'=>25,'precio2'=>20,'precio3'=>18,'stock'=>25,'stockMin'=>8],

            // ═══════════════════════════════════════════
            // 🧠 16. HERRAMIENTAS (NIVEL NEGOCIO REAL)
            // ═══════════════════════════════════════════
            ['codigo'=>'HER-001','nombre'=>'Gata Hidráulica 3 Toneladas','categoria'=>'Herramientas','marca'=>'Truper','unidad'=>'Unidad','precio1'=>180,'precio2'=>160,'precio3'=>145,'stock'=>5,'stockMin'=>2],
            ['codigo'=>'HER-002','nombre'=>'Juego Llaves Combinadas 8-24mm','categoria'=>'Herramientas','marca'=>'Stanley','unidad'=>'Juego','precio1'=>120,'precio2'=>105,'precio3'=>95,'stock'=>8,'stockMin'=>3],
            ['codigo'=>'HER-003','nombre'=>'Juego Dados y Ratchet 1/2" (32pcs)','categoria'=>'Herramientas','marca'=>'Stanley','unidad'=>'Juego','precio1'=>150,'precio2'=>130,'precio3'=>120,'stock'=>6,'stockMin'=>2],
            ['codigo'=>'HER-004','nombre'=>'Compresor de Aire 50L 2.5HP','categoria'=>'Herramientas','marca'=>'Campbell','unidad'=>'Unidad','precio1'=>650,'precio2'=>600,'precio3'=>550,'stock'=>2,'stockMin'=>1],
            ['codigo'=>'HER-005','nombre'=>'Multímetro Digital Automotriz','categoria'=>'Herramientas','marca'=>'Fluke','unidad'=>'Unidad','precio1'=>180,'precio2'=>160,'precio3'=>145,'stock'=>4,'stockMin'=>2],
            ['codigo'=>'HER-006','nombre'=>'Escáner Automotriz OBD2 Bluetooth','categoria'=>'Herramientas','marca'=>'Launch','unidad'=>'Unidad','precio1'=>350,'precio2'=>310,'precio3'=>280,'stock'=>3,'stockMin'=>1],

            // ═══════════════════════════════════════════
            // 🧴 17. LIMPIEZA Y CUIDADO
            // ═══════════════════════════════════════════
            ['codigo'=>'LIM-001','nombre'=>'Shampoo Auto Concentrado 1L','categoria'=>'Limpieza','marca'=>'Meguiars','unidad'=>'Botella','precio1'=>35,'precio2'=>30,'precio3'=>28,'stock'=>20,'stockMin'=>6],
            ['codigo'=>'LIM-002','nombre'=>'Cera Pulidora Brillo Diamante','categoria'=>'Limpieza','marca'=>'Meguiars','unidad'=>'Lata','precio1'=>45,'precio2'=>38,'precio3'=>35,'stock'=>15,'stockMin'=>5],
            ['codigo'=>'LIM-003','nombre'=>'Silicona Protectora Tablero Spray','categoria'=>'Limpieza','marca'=>'Armor All','unidad'=>'Lata','precio1'=>22,'precio2'=>18,'precio3'=>16,'stock'=>25,'stockMin'=>8],
            ['codigo'=>'LIM-004','nombre'=>'Limpia Llantas Espuma Activa','categoria'=>'Limpieza','marca'=>'Sonax','unidad'=>'Botella','precio1'=>28,'precio2'=>24,'precio3'=>22,'stock'=>20,'stockMin'=>6],
            ['codigo'=>'LIM-005','nombre'=>'Ambientador Auto Premium California','categoria'=>'Limpieza','marca'=>'California','unidad'=>'Unidad','precio1'=>12,'precio2'=>10,'precio3'=>8,'stock'=>40,'stockMin'=>12],
        ];

        foreach ($productos as $p) {
            Inventario::firstOrCreate(
                ['codigo' => $p['codigo']],
                array_merge($p, ['estado' => 'activo'])
            );
        }
    }
}
