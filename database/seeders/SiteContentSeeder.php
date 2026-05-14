<?php

namespace Database\Seeders;

use App\Models\MediaFile;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\PageSectionItem;
use App\Models\PageTextSnippet;
use Illuminate\Database\Seeder;

class SiteContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedMedia();
        $imageId = static fn (string $filename): ?int => MediaFile::query()
            ->where('filename', $filename)
            ->value('id');

        $welcome = Page::query()->create([
            'slug' => 'welcome',
            'name' => 'Home',
            'meta_title' => 'Twins Garage Doors — DFW',
            'meta_description' => 'Garage door and gate installation, repair, and service in the Dallas–Fort Worth area.',
            'is_published' => true,
        ]);
        $this->snippet($welcome, 'hero_title_main', 'Serving Your Home and Business');
        $this->snippet($welcome, 'hero_title_accent', 'One Door at a Time.');
        $this->snippet($welcome, 'hero_lead', 'Licensed, experienced, and ready to take care of any job — big or small. Twins Garage Doors LLC is your trusted local expert for garage door and gate installation, repair, and service — for homes and businesses of all sizes. Service area: DFW. English & Spanish.');
        $this->snippet($welcome, 'hero_cta_phone_label', 'Call Us Today For a Free Quote');
        $this->snippet($welcome, 'hero_cta_secondary_label', 'Our Models');

        $secWelcomeServices = PageSection::query()->create([
            'page_id' => $welcome->id,
            'section_key' => 'services_preview',
            'sort_order' => 0,
            'settings' => ['columns' => 3],
        ]);
        $this->card($secWelcomeServices, 0, 'Garage door installation', 'Residential and commercial installation and replacement.', 'Read more', '#contacto', 'service1.jpg', $imageId);
        $this->card($secWelcomeServices, 1, 'Repair & maintenance', 'Springs, panels, openers, and preventive maintenance.', 'Read more', '#contacto', 'service2.jpg', $imageId);
        $this->card($secWelcomeServices, 2, 'Gates & openers', 'Gate automation and opener service for security and convenience.', 'Read more', '#contacto', 'service3.jpg', $imageId);

        $about = Page::query()->create([
            'slug' => 'about-us',
            'name' => 'About Us',
            'meta_title' => 'About Us — Twins Garage Doors',
            'meta_description' => 'Family-owned garage door and gate company serving DFW.',
            'is_published' => true,
        ]);
        $this->snippet($about, 'hero_eyebrow', 'About Twins Garage Doors');
        $this->snippet($about, 'hero_title', 'Built on family, trust, and craftsmanship.');
        $this->snippet($about, 'intro', 'Twins Garage Doors LLC is a family-owned garage door and gate company serving residential and commercial customers across DFW.');

        $secAboutValues = PageSection::query()->create([
            'page_id' => $about->id,
            'section_key' => 'value_cards',
            'sort_order' => 0,
            'settings' => null,
        ]);
        $this->card($secAboutValues, 0, 'Our mission', 'Reliable, high-quality garage door and gate solutions with honest service and lasting value.', 'Learn more', '/#contacto', 'lifting-gates-garage.jpg', $imageId);
        $this->card($secAboutValues, 1, 'Our vision', 'To be the most trusted name in garage door and gate services through integrity and innovation.', 'Learn more', '/#contacto', '3.jpg', $imageId);
        $this->card($secAboutValues, 2, 'Why choose us', 'Licensed & insured, fast response, quality workmanship, and customer satisfaction first.', 'Learn more', '/#contacto', 'instalacion-de-puertas-automaticas.jpg.webp', $imageId);

        $services = Page::query()->create([
            'slug' => 'services',
            'name' => 'Services',
            'meta_title' => 'Services — Twins Garage Doors',
            'meta_description' => 'Installation, repair, gates, and openers.',
            'is_published' => true,
        ]);
        $this->snippet($services, 'page_kicker', 'Services you need');
        $this->snippet($services, 'page_title', 'What we do for homes and businesses');

        $secServices = PageSection::query()->create([
            'page_id' => $services->id,
            'section_key' => 'service_cards',
            'sort_order' => 0,
            'settings' => null,
        ]);
        $this->card($secServices, 0, 'Garage door installation', 'New installs and replacements tailored to your style and budget.', 'Get a quote', '/contact', 'service1.jpg', $imageId);
        $this->card($secServices, 1, 'Repair & maintenance', 'Springs, cables, panels, openers, and tune-ups to extend door life.', 'Get a quote', '/contact', 'service2.jpg', $imageId);
        $this->card($secServices, 2, 'Gates & openers', 'Gate automation, access control, and opener upgrades.', 'Get a quote', '/contact', 'service3.jpg', $imageId);

        $ourWork = Page::query()->create([
            'slug' => 'our-work',
            'name' => 'Our Work',
            'meta_title' => 'Our Work — Twins Garage Doors',
            'meta_description' => 'Recent garage door projects in DFW.',
            'is_published' => true,
        ]);
        $this->snippet($ourWork, 'hero_title_line1', 'Our');
        $this->snippet($ourWork, 'hero_title_line2', 'Work');
        $this->snippet($ourWork, 'hero_lead', 'A selection of residential and commercial installations we are proud to stand behind.');

        $secProjects = PageSection::query()->create([
            'page_id' => $ourWork->id,
            'section_key' => 'project_cards',
            'sort_order' => 0,
            'settings' => null,
        ]);
        $this->card($secProjects, 0, 'Modern residential install', 'Full replacement with insulated sectional door and quiet opener.', 'View details', '/contact', 'service1.jpg', $imageId);
        $this->card($secProjects, 1, 'Commercial bay service', 'Heavy-duty doors tuned for high-cycle daily use.', 'View details', '/contact', 'service2.jpg', $imageId);
        $this->card($secProjects, 2, 'Curb appeal upgrade', 'Custom door style matched to the home exterior.', 'View details', '/contact', 'service3.jpg', $imageId);

        $contact = Page::query()->create([
            'slug' => 'contact',
            'name' => 'Contact',
            'meta_title' => 'Contact Us — Twins Garage Doors',
            'meta_description' => 'Call, email, or send a message — DFW garage doors and gates.',
            'is_published' => true,
        ]);
        $this->snippet($contact, 'hero_title', 'Contact us');
        $this->snippet($contact, 'get_in_touch_lead', 'Our team is ready to help with garage door and gate installation, repairs, and support.');
        $this->snippet($contact, 'service_area_line', 'Dallas–Fort Worth metro area, Texas');
        $this->snippet($contact, 'phone_display', '469-288-8881');
        $this->snippet($contact, 'email_display', 'twinsgaragedoors@gmail.com');
        $this->snippet($contact, 'map_overlay_title', 'We serve the Dallas–Fort Worth metro area');

        $reviews = Page::query()->create([
            'slug' => 'reviews',
            'name' => 'Reviews',
            'meta_title' => 'Reviews — Twins Garage Doors',
            'meta_description' => 'Customer testimonials for Twins Garage Doors.',
            'is_published' => true,
        ]);
        $this->snippet($reviews, 'hero_title_line1', 'What our customers say');
        $this->snippet($reviews, 'hero_title_line2', 'Reviews & testimonials');
        $this->snippet($reviews, 'cta_title', 'Call for service');
        $this->snippet($reviews, 'cta_phone', '469-288-8881');
        $this->snippet($reviews, 'cta_email', 'twinsgaragedoors@gmail.com');

        $secReviews = PageSection::query()->create([
            'page_id' => $reviews->id,
            'section_key' => 'testimonials',
            'sort_order' => 0,
            'settings' => null,
        ]);
        $this->testimonial($secReviews, 0, 'Professional installation and spotless cleanup.', 'From the first call to the final walkthrough, the crew was on time and respectful of our property.', 'Maria G.', 5, 'service1.jpg', $imageId);
        $this->testimonial($secReviews, 1, 'Fast response when our spring failed.', 'They diagnosed the issue quickly and had us back in business the same day.', 'James T.', 5, 'service2.jpg', $imageId);
        $this->testimonial($secReviews, 2, 'Beautiful modern doors.', 'Twins helped us pick the right style; installation was smooth.', 'Elena R.', 5, 'service3.jpg', $imageId);
    }

    private function seedMedia(): void
    {
        $rows = [
            ['filename' => 'lifting-gates-garage.jpg', 'alt_text' => 'Garage door technician at work'],
            ['filename' => 'instalacion-de-puertas-automaticas.jpg.webp', 'alt_text' => 'Automatic garage door installation'],
            ['filename' => '3.jpg', 'alt_text' => 'Team with tablet on site'],
            ['filename' => 'service1.jpg', 'alt_text' => 'Residential garage door'],
            ['filename' => 'service2.jpg', 'alt_text' => 'Garage door repair'],
            ['filename' => 'service3.jpg', 'alt_text' => 'Gate and garage services'],
        ];

        foreach ($rows as $row) {
            MediaFile::query()->firstOrCreate(
                ['filename' => $row['filename'], 'path' => 'images'],
                [
                    'disk' => 'public',
                    'alt_text' => $row['alt_text'],
                    'mime_type' => null,
                    'size_bytes' => null,
                ]
            );
        }
    }

    private function snippet(Page $page, string $key, string $value, string $locale = 'en'): void
    {
        PageTextSnippet::query()->updateOrCreate(
            ['page_id' => $page->id, 'field_key' => $key, 'locale' => $locale],
            ['value' => $value]
        );
    }

    /**
     * @param  callable(string): ?int  $imageId
     */
    private function card(PageSection $section, int $order, string $title, string $body, ?string $linkLabel, ?string $linkUrl, string $filename, callable $imageId): void
    {
        PageSectionItem::query()->create([
            'page_section_id' => $section->id,
            'sort_order' => $order,
            'item_type' => 'card',
            'title' => $title,
            'subtitle' => null,
            'body' => $body,
            'link_label' => $linkLabel,
            'link_url' => $linkUrl,
            'image_id' => $imageId($filename),
            'image_filename' => $filename,
            'extra' => null,
        ]);
    }

    /**
     * @param  callable(string): ?int  $imageId
     */
    private function testimonial(PageSection $section, int $order, string $title, string $body, string $name, int $stars, string $filename, callable $imageId): void
    {
        PageSectionItem::query()->create([
            'page_section_id' => $section->id,
            'sort_order' => $order,
            'item_type' => 'testimonial',
            'title' => $title,
            'subtitle' => $name,
            'body' => $body,
            'link_label' => null,
            'link_url' => null,
            'image_id' => $imageId($filename),
            'image_filename' => $filename,
            'extra' => ['stars' => $stars],
        ]);
    }
}
