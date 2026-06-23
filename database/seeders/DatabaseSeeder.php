<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\News;
use App\Models\WeeklySchedule;
use App\Models\DailyGospel;
use App\Models\CabinStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Admin User
        User::updateOrCreate(
            ['email' => 'admin@radiopax.com'],
            [
                'name' => 'Administrador Radio Pax',
                'password' => Hash::make('radiopax2026'),
            ]
        );

        // 2. Seed Cabin Status
        CabinStatus::truncate();
        CabinStatus::create([
            'mode' => 'auto',
            'current_program' => null,
            'current_host' => null,
            'is_streaming' => true,
            'banner_message' => '¡Bienvenidos a la señal digital de Radio Pax, anunciando la alegría del Evangelio!',
        ]);

        // 3. Seed News Items
        News::truncate();
        
        News::create([
            'title' => 'Gran Rifa Diocesana pro-Fondos Parroquiales',
            'content' => 'Invitamos a toda la feligresía a participar en nuestra gran rifa anual. Los fondos recaudados serán destinados a las obras de restauración de la capilla comunitaria y los salones pastorales. El boleto tiene un costo de Q25. Adquiérelos al salir de las eucaristías de fin de semana o en las oficinas parroquiales. ¡Agradecemos desde ya su inmensa generosidad!',
            'category' => 'Parroquial',
            'is_important' => true,
            'published_at' => Carbon::now()->subDays(1),
        ]);

        News::create([
            'title' => 'Nueva Programación de Radio Pax 91.9 FM',
            'content' => 'A partir de este mes de julio, iniciamos con nuevos segmentos enfocados en los jóvenes, música de adoración contemporánea y el micro-programa "Minuto de Paz" transmitido cada hora. Te invitamos a sintonizarnos y a compartir nuestra aplicación con familiares y amigos. Queremos llevar el Evangelio a más hogares con tu apoyo.',
            'category' => 'Radio',
            'is_important' => false,
            'published_at' => Carbon::now()->subDays(2),
        ]);

        News::create([
            'title' => 'Taller de Formación para Catequistas y Líderes',
            'content' => 'La Pastoral de Formación convoca al taller intensivo "Pedagogía de la Fe", que se llevará a cabo en el Salón Episcopal de Zacapa el próximo sábado de 08:30 a 13:00 horas. Está dirigido a catequistas de confirmación y comunión, así como a coordinadores de ministerios. La inscripción es gratuita e incluye materiales de estudio.',
            'category' => 'Comunidad',
            'is_important' => false,
            'published_at' => Carbon::now()->subDays(4),
        ]);

        News::create([
            'title' => 'Campaña de Oración Permanente por los Enfermos',
            'content' => 'Nos unimos en cadena de oración todas las tardes a las 3:00 PM durante el rezo de la Divina Misericordia. Si tienes algún familiar o conocido enfermo, por favor envíanos su nombre a través de la sección de contacto de esta App en la categoría "Petición de Oración" para incluirlo en nuestra lista de intenciones de la Santa Misa.',
            'category' => 'Parroquial',
            'is_important' => true,
            'published_at' => Carbon::now()->subDays(5),
        ]);

        News::create([
            'title' => 'Reunión de la Red de Medios Católicos de Guatemala',
            'content' => 'El equipo de producción de Radio Pax estará participando en el Encuentro Nacional de Emisoras Católicas, buscando compartir experiencias y capacitar a nuestro personal técnico para brindarte una señal móvil digital de mayor calidad técnica e inspiradora espiritualidad.',
            'category' => 'Radio',
            'is_important' => false,
            'published_at' => Carbon::now()->subDays(7),
        ]);

        // 4. Seed Weekly Schedules
        WeeklySchedule::truncate();

        WeeklySchedule::create([
            'name' => 'El Santo Rosario',
            'host' => 'Comunidad Parroquial',
            'start_time' => '05:00',
            'end_time' => '06:00',
            'days_of_week' => [1, 2, 3, 4, 5, 6, 7],
            'description' => 'Oración mariana comunitaria para iniciar el día en la gracia del Señor, pidiendo por la paz y las familias.',
        ]);

        WeeklySchedule::create([
            'name' => 'Santa Misa Diaria',
            'host' => 'Catedral de Zacapa',
            'start_time' => '07:00',
            'end_time' => '08:00',
            'days_of_week' => [1, 2, 3, 4, 5, 6, 7],
            'description' => 'Transmisión de la Eucaristía en vivo desde la Catedral, para comulgar espiritualmente con la palabra de Dios.',
        ]);

        WeeklySchedule::create([
            'name' => 'La Alegría del Evangelio',
            'host' => 'P. Juan Carlos Aguilar',
            'start_time' => '09:00',
            'end_time' => '10:30',
            'days_of_week' => [1, 3, 5],
            'description' => 'Estudio bíblico, reflexiones sobre las lecturas del día y cantos de alabanza para toda la familia.',
        ]);

        WeeklySchedule::create([
            'name' => 'Mensajes de Esperanza',
            'host' => 'Hnas. Misioneras de la Caridad',
            'start_time' => '10:30',
            'end_time' => '12:00',
            'days_of_week' => [2, 4],
            'description' => 'Testimonios de fe, ayuda social, catequesis básica y palabras alentadoras para superar las dificultades cotidianas.',
        ]);

        WeeklySchedule::create([
            'name' => 'Música que Alimenta el Alma',
            'host' => 'Locución General',
            'start_time' => '12:00',
            'end_time' => '14:30',
            'days_of_week' => [1, 2, 3, 4, 5, 6],
            'description' => 'Bloque de música católica contemporánea e instrumental, acompañado de pensamientos espirituales breves.',
        ]);

        WeeklySchedule::create([
            'name' => 'Hora de la Divina Misericordia',
            'host' => 'Ministerio de Intercesión',
            'start_time' => '15:00',
            'end_time' => '16:00',
            'days_of_week' => [1, 2, 3, 4, 5, 6, 7],
            'description' => 'Oración del Santo Rosario a la Divina Misericordia, pidiendo por la salud de los enfermos y la conversión del mundo.',
        ]);

        WeeklySchedule::create([
            'name' => 'Juventud con Propósito',
            'host' => 'Pastoral Juvenil Diocesana',
            'start_time' => '16:30',
            'end_time' => '18:00',
            'days_of_week' => [2, 4],
            'description' => 'Espacio dinámico dirigido a jóvenes con temas de valores, música juvenil cristiana y debates de interés social desde la fe.',
        ]);

        WeeklySchedule::create([
            'name' => 'Caminando con María',
            'host' => 'Legión de María',
            'start_time' => '16:30',
            'end_time' => '18:00',
            'days_of_week' => [5],
            'description' => 'Programa formativo mariano que profundiza en las virtudes de la Santísima Virgen y su rol en la Iglesia.',
        ]);

        WeeklySchedule::create([
            'name' => 'Asamblea de Oración Familiar',
            'host' => 'Renovación Carismática Católica',
            'start_time' => '18:00',
            'end_time' => '20:00',
            'days_of_week' => [7],
            'description' => 'Espacio de sanación, predicación ungida y adoración para fortalecer el núcleo del hogar en comunidad.',
        ]);

        WeeklySchedule::create([
            'name' => 'Encuentro con la Palabra',
            'host' => 'Mons. Ángel Antonio Recinos',
            'start_time' => '09:00',
            'end_time' => '11:00',
            'days_of_week' => [6],
            'description' => 'Análisis profundo de la doctrina de la Iglesia y las lecturas dominicales, dirigido por nuestro Obispo Diocesano.',
        ]);

        // 5. Seed Daily Gospels
        DailyGospel::truncate();

        DailyGospel::create([
            'date' => Carbon::today(),
            'title' => 'Lectura del Santo Evangelio según San Mateo',
            'passage' => 'Mt 10, 1-7',
            'content' => 'En aquel tiempo, Jesús llamó a sus doce discípulos y les dio autoridad para expulsar a los espíritus inmundos y curar toda enfermedad y dolencia. Los nombres de los doce apóstoles son estos: primero Simón, llamado Pedro, y Andrés su hermano; Santiago el de Zebedeo, y Juan su hermano; Felipe y Bartolomé; Tomás y Mateo el publicano; Santiago el de Alfeo, y Tadeo; Simón el cananeo, y Judas Iscariote, el que lo entregó. A estos doce los envió Jesús con estas instrucciones: "No vayan a tierra de paganos ni entren en ciudad de samaritanos; vayan más bien a las ovejas perdidas de la casa de Israel. Vayan y proclamen que el Reino de los cielos está cerca".',
            'reflection' => 'Jesús nos llama hoy a cada uno por nuestro nombre para ser heraldos de su paz. Nos envía no con nuestras propias fuerzas, sino investidos de su amor y autoridad para sanar corazones heridos y proclamar que el Reino de los cielos está cerca.',
        ]);
        
        DailyGospel::create([
            'date' => Carbon::yesterday(),
            'title' => 'Lectura del Santo Evangelio según San Lucas',
            'passage' => 'Lc 10, 1-9',
            'content' => 'En aquel tiempo, el Señor designó a otros setenta y dos discípulos y los mandó por delante, de dos en dos, a todos los pueblos y lugares a donde pensaba ir él. Y les decía: "La cosecha es abundante, pero los obreros son pocos; rueguen, por tanto, al dueño de la cosecha que mande obreros a su campo. Pónganse en camino; miren que los envío como corderos en medio de lobos. No lleven bolsa, ni alforja, ni sandalias, y no se detengan a saludar a nadie por el camino..."',
            'reflection' => 'La misión cristiana exige desapego y confianza absoluta en la providencia de Dios. Al ir "de dos en dos", Jesús nos enseña que el testimonio se vive y se proclama en comunidad, construyendo puentes de fraternidad y paz.',
        ]);
    }
}
