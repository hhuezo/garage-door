<?php

namespace Database\Seeders;

use App\Models\AboutUsCard;
use App\Models\AboutUsContent;
use App\Models\OurWorkContent;
use App\Models\OurWorkProject;
use App\Models\Page;
use App\Models\ServicesCard;
use App\Models\ServicesContent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SiteContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->truncateSiteContentTables();

        $this->insertSitePages();

        $page = Page::query()->where('slug', 'about-us')->firstOrFail();

        $aboutContent = AboutUsContent::query()->create([
            'page_id' => $page->id,
            'hero_eyebrow' => 'About Twins Garage Doors',
            'hero_title' => 'Built on family, trust, and craftsmanship.',
            'intro' => 'Twins Garage Doors LLC is a family-owned garage door and gate company serving residential and commercial customers across DFW.',
            'hero_image_filename' => 'lifting-gates-garage.jpg',
            'intro_icon' => 'engineering',
            'values_section_heading' => 'Valores',
            'values_section_logo_filename' => null,
        ]);

        $this->aboutUsCard($aboutContent, 0, 'Our mission', 'Reliable, high-quality garage door and gate solutions with honest service and lasting value.', 'garage');
        $this->aboutUsCard($aboutContent, 1, 'Our vision', 'To be the most trusted name in garage door and gate services through integrity and innovation.', 'construction');
        $this->aboutUsCard($aboutContent, 2, 'Why choose us', 'Licensed & insured, fast response, quality workmanship, and customer satisfaction first.', 'handyman');

        $servicesPage = Page::query()->where('slug', 'services')->firstOrFail();
        $servicesContent = ServicesContent::query()->create([
            'page_id' => $servicesPage->id,
            'hero_title' => 'Servicios',
            'hero_lead' => 'Ofrecemos soluciones integrales para todas sus necesidades de puertas de garaje. Desde instalaciones expertas hasta reparaciones de emergencia, nuestro equipo técnico altamente capacitado garantiza durabilidad y seguridad en cada proyecto. Con años de experiencia y un enfoque en la calidad arquitectónica, Twins Garage Doors es su socio de confianza para el mantenimiento residencial y comercial.',
            'hero_image_filename' => 'lifting-gates-garage.jpg',
        ]);

        $this->servicesCard($servicesContent, 0, 'Instalación Residencial', 'Instalación experta de puertas de garaje modernas y duraderas, adaptadas al estilo arquitectónico de su hogar.', 'garage', 'service1.jpg', 'light');
        $this->servicesCard($servicesContent, 1, 'Servicio Técnico', 'Mantenimiento preventivo y diagnóstico preciso para asegurar el funcionamiento óptimo de sus sistemas.', 'engineering', 'service2.jpg', 'light');
        $this->servicesCard($servicesContent, 2, 'Reparaciones 24/7', 'Atención inmediata para emergencias, resortes rotos, cables sueltos o motores averiados en cualquier momento.', 'build', 'service3.jpg', 'accent');
        $this->servicesCard($servicesContent, 3, 'Automatización', 'Sistemas inteligentes de apertura remota y control desde smartphone para máxima comodidad y seguridad.', 'settings_input_component', 'service1.jpg', 'light');
        $this->servicesCard($servicesContent, 4, 'Seguridad y Control', 'Refuerzos de seguridad y sensores de movimiento para proteger lo que más importa en su propiedad.', 'security', 'service2.jpg', 'light');
        $this->servicesCard($servicesContent, 5, 'Soluciones Comerciales', 'Puertas de alto tráfico y gran escala para almacenes, naves industriales y centros comerciales.', 'factory', 'service3.jpg', 'light');

        $ourWorkPage = Page::query()->where('slug', 'our-work')->firstOrFail();
        $ourWorkContent = OurWorkContent::query()->create([
            'page_id' => $ourWorkPage->id,
            'hero_title_primary' => 'Our',
            'hero_title_accent' => 'Work',
            'hero_icon' => 'tune',
            'hero_intro' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat.',
            'hero_cta_label' => 'Leer más',
            'hero_cta_url' => '/#contacto',
            'hero_main_image_filename' => 'lifting-gates-garage.jpg',
            'hero_inset_image_filename' => 'service2.jpg',
            'stat_value' => '+100',
            'stat_caption' => 'Proyectos en DFW',
        ]);

        $this->ourWorkProject($ourWorkContent, 0, 'Instalación residencial', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt', 'home', 'service1.jpg');
        $this->ourWorkProject($ourWorkContent, 1, 'Puerta seccional', 'Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip', 'garage', 'service2.jpg');
        $this->ourWorkProject($ourWorkContent, 2, 'Comercial', 'Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat', 'warehouse', 'service3.jpg');
        $this->ourWorkProject($ourWorkContent, 3, 'Modernización', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt', 'engineering', 'service1.jpg');
        $this->ourWorkProject($ourWorkContent, 4, 'Mantenimiento', 'Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl', 'handyman', 'service2.jpg');
        $this->ourWorkProject($ourWorkContent, 5, 'Control de acceso', 'Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat', 'security', 'service3.jpg');

        $this->logLine(sprintf(
            'SiteContentSeeder OK. pages=%d, about_us_contents=%d, about_us_cards=%d, services_contents=%d, services_cards=%d, our_work_contents=%d, our_work_projects=%d.',
            DB::table('pages')->count(),
            DB::table('about_us_contents')->count(),
            DB::table('about_us_cards')->count(),
            DB::table('services_contents')->count(),
            DB::table('services_cards')->count(),
            Schema::hasTable('our_work_contents') ? DB::table('our_work_contents')->count() : 0,
            Schema::hasTable('our_work_projects') ? DB::table('our_work_projects')->count() : 0,
        ));
    }

    private function logLine(string $message): void
    {
        if ($this->command !== null) {
            $this->command->info($message);
        }
    }

    private function truncateSiteContentTables(): void
    {
        $p = DB::getTablePrefix();
        $tAboutCards = "`{$p}about_us_cards`";
        $tAboutContents = "`{$p}about_us_contents`";
        $tServCards = "`{$p}services_cards`";
        $tServContents = "`{$p}services_contents`";
        $tOurWorkProjects = "`{$p}our_work_projects`";
        $tOurWorkContents = "`{$p}our_work_contents`";
        $tPages = "`{$p}pages`";

        $driver = Schema::getConnection()->getDriverName();

        if (in_array($driver, ['mysql', 'mariadb'], true)) {
            DB::unprepared('SET FOREIGN_KEY_CHECKS=0');
            try {
                DB::unprepared("TRUNCATE TABLE {$tAboutCards}");
                DB::unprepared("TRUNCATE TABLE {$tAboutContents}");
                if (Schema::hasTable('our_work_projects')) {
                    DB::unprepared("TRUNCATE TABLE {$tOurWorkProjects}");
                }
                if (Schema::hasTable('our_work_contents')) {
                    DB::unprepared("TRUNCATE TABLE {$tOurWorkContents}");
                }
                if (Schema::hasTable('services_cards')) {
                    DB::unprepared("TRUNCATE TABLE {$tServCards}");
                }
                if (Schema::hasTable('services_contents')) {
                    DB::unprepared("TRUNCATE TABLE {$tServContents}");
                }
                DB::unprepared("TRUNCATE TABLE {$tPages}");
            } finally {
                DB::unprepared('SET FOREIGN_KEY_CHECKS=1');
            }
        } elseif ($driver === 'sqlite') {
            Schema::disableForeignKeyConstraints();
            try {
                if (Schema::hasTable('our_work_projects')) {
                    DB::table('our_work_projects')->delete();
                }
                if (Schema::hasTable('our_work_contents')) {
                    DB::table('our_work_contents')->delete();
                }
                if (Schema::hasTable('services_cards')) {
                    DB::table('services_cards')->delete();
                }
                if (Schema::hasTable('services_contents')) {
                    DB::table('services_contents')->delete();
                }
                DB::table('about_us_cards')->delete();
                DB::table('about_us_contents')->delete();
                DB::table('pages')->delete();
            } finally {
                Schema::enableForeignKeyConstraints();
            }
        } else {
            Schema::disableForeignKeyConstraints();
            try {
                if (Schema::hasTable('our_work_projects')) {
                    DB::table('our_work_projects')->truncate();
                }
                if (Schema::hasTable('our_work_contents')) {
                    DB::table('our_work_contents')->truncate();
                }
                if (Schema::hasTable('services_cards')) {
                    DB::table('services_cards')->truncate();
                }
                if (Schema::hasTable('services_contents')) {
                    DB::table('services_contents')->truncate();
                }
                DB::table('about_us_cards')->truncate();
                DB::table('about_us_contents')->truncate();
                DB::table('pages')->truncate();
            } finally {
                Schema::enableForeignKeyConstraints();
            }
        }

        $this->logLine('Truncadas tablas: about_us_*, our_work_*, services_*, pages.');
    }

    /**
     * Inserta filas en pages (tras truncate).
     */
    private function insertSitePages(): void
    {
        $now = now();
        $rows = [
            [
                'slug' => 'welcome',
                'name' => 'Home',
                'meta_title' => 'Twins Garage Doors — DFW',
                'meta_description' => 'Garage door and gate installation, repair, and service in the Dallas–Fort Worth area.',
                'is_published' => true,
            ],
            [
                'slug' => 'about-us',
                'name' => 'About Us',
                'meta_title' => 'About Us — Twins Garage Doors',
                'meta_description' => 'Family-owned garage door and gate company serving DFW.',
                'is_published' => true,
            ],
            [
                'slug' => 'services',
                'name' => 'Services',
                'meta_title' => 'Services — Twins Garage Doors',
                'meta_description' => 'Installation, repair, gates, and openers.',
                'is_published' => true,
            ],
            [
                'slug' => 'our-work',
                'name' => 'Our Work',
                'meta_title' => 'Our Work — Twins Garage Doors',
                'meta_description' => 'Recent garage door projects in DFW.',
                'is_published' => true,
            ],
            [
                'slug' => 'contact',
                'name' => 'Contact',
                'meta_title' => 'Contact Us — Twins Garage Doors',
                'meta_description' => 'Call, email, or send a message — DFW garage doors and gates.',
                'is_published' => true,
            ],
            [
                'slug' => 'reviews',
                'name' => 'Reviews',
                'meta_title' => 'Reviews — Twins Garage Doors',
                'meta_description' => 'Customer testimonials for Twins Garage Doors.',
                'is_published' => true,
            ],
        ];

        $batch = [];
        foreach ($rows as $row) {
            $batch[] = [
                'slug' => $row['slug'],
                'name' => $row['name'],
                'meta_title' => $row['meta_title'],
                'meta_description' => $row['meta_description'],
                'is_published' => $row['is_published'] ? 1 : 0,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('pages')->insert($batch);

        $this->logLine('Insertadas '.count($batch).' filas en pages.');
    }

    private function aboutUsCard(AboutUsContent $content, int $order, string $title, string $body, string $icon): void
    {
        AboutUsCard::query()->create([
            'about_us_content_id' => $content->id,
            'sort_order' => $order,
            'title' => $title,
            'body' => $body,
            'link_label' => null,
            'link_url' => null,
            'image_filename' => null,
            'icon' => $icon,
        ]);
    }

    private function servicesCard(ServicesContent $content, int $order, string $title, string $body, string $icon, string $imagePath, string $theme): void
    {
        ServicesCard::query()->create([
            'services_content_id' => $content->id,
            'sort_order' => $order,
            'title' => $title,
            'body' => $body,
            'icon' => $icon,
            'image_path' => $imagePath,
            'theme' => $theme,
        ]);
    }

    private function ourWorkProject(OurWorkContent $content, int $order, string $title, string $body, string $icon, string $imagePath): void
    {
        OurWorkProject::query()->create([
            'our_work_content_id' => $content->id,
            'sort_order' => $order,
            'title' => $title,
            'body' => $body,
            'icon' => $icon,
            'image_path' => $imagePath,
            'link_label' => 'Leer más',
            'link_url' => '/#contacto',
        ]);
    }
}
