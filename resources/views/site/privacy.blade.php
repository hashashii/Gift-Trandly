@extends('layouts.site')

@section('title', 'Privacy Policy | Gift Trandly')

@section('meta_description', 'Read the Gift Trandly Privacy Policy to learn how information, cookies, analytics and third-party services may be used on our website.')

@section('content')

<section class="bg-linen">
    <div class="mx-auto max-w-4xl px-4 py-14 sm:px-6 sm:py-16">

        <span class="inline-flex rounded-full bg-blush-50 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-blush-600">
            Legal
        </span>

        <h1 class="mt-4 font-serif text-4xl font-semibold text-ink sm:text-5xl">
            Privacy Policy
        </h1>

        <p class="mt-4 max-w-2xl text-sm leading-7 text-gray-600">
            This Privacy Policy explains how Gift Trandly may collect, use and
            protect information when you visit our website.
        </p>

        <p class="mt-2 text-xs text-gray-500">
            Last updated: September 27, 2026
        </p>

    </div>
</section>


<div class="mx-auto max-w-4xl px-4 py-12 sm:px-6">

    <div class="space-y-10 text-[15px] leading-7 text-gray-600">

        {{-- Information We Collect --}}
        <section>
            <h2 class="font-serif text-2xl font-semibold text-ink">
                Information We Collect
            </h2>

            <p class="mt-3">
                You can browse Gift Trandly without directly providing personal
                information. However, we may receive information that you
                voluntarily provide, such as your email address when you subscribe
                to updates or information you provide when contacting us.
            </p>

            <p class="mt-3">
                Certain technical information may also be collected automatically,
                such as browser type, device type, referring pages, pages visited
                and general usage information.
            </p>
        </section>


        {{-- How Information Is Used --}}
        <section>
            <h2 class="font-serif text-2xl font-semibold text-ink">
                How We Use Information
            </h2>

            <p class="mt-3">
                Information may be used to operate and improve Gift Trandly,
                understand how visitors use the website, respond to messages,
                provide requested updates and maintain the security and performance
                of the site.
            </p>
        </section>


        {{-- Cookies --}}
        <section>
            <h2 class="font-serif text-2xl font-semibold text-ink">
                Cookies and Similar Technologies
            </h2>

            <p class="mt-3">
                Gift Trandly and third-party services used by the website may use
                cookies or similar technologies. These technologies can help
                remember preferences, understand website traffic and measure how
                visitors interact with pages and links.
            </p>

            <p class="mt-3">
                You can control or delete cookies through your browser settings.
                Disabling some cookies may affect how certain website features work.
            </p>
        </section>


        {{-- Analytics --}}
        <section>
            <h2 class="font-serif text-2xl font-semibold text-ink">
                Analytics
            </h2>

            <p class="mt-3">
                We may use analytics services to understand website traffic and
                visitor interactions. These services may collect information such
                as device information, approximate location, pages visited and
                referral information according to their own privacy practices.
            </p>
        </section>


        {{-- Affiliate Links --}}
        <section>
            <h2 class="font-serif text-2xl font-semibold text-ink">
                Affiliate Links
            </h2>

            <p class="mt-3">
                Gift Trandly may contain affiliate links to third-party websites.
                When you click an affiliate link, the third party may use cookies
                or other tracking technologies to determine that your visit or
                purchase originated from Gift Trandly.
            </p>

            <p class="mt-3">
                We may receive a commission from qualifying purchases made through
                affiliate links, at no additional cost to you.
            </p>
        </section>


        {{-- Third Party Websites --}}
        <section>
            <h2 class="font-serif text-2xl font-semibold text-ink">
                Third-Party Websites
            </h2>

            <p class="mt-3">
                Our website may contain links to websites operated by other
                companies. Gift Trandly does not control the privacy practices of
                those websites. We encourage you to review the privacy policy of
                any third-party website you visit.
            </p>
        </section>


        {{-- Data Retention --}}
        <section>
            <h2 class="font-serif text-2xl font-semibold text-ink">
                Data Retention
            </h2>

            <p class="mt-3">
                Information is retained only for as long as reasonably necessary
                for the purposes described in this policy, including operating the
                website, responding to requests and complying with applicable
                obligations.
            </p>
        </section>


        {{-- Privacy Choices --}}
        <section>
            <h2 class="font-serif text-2xl font-semibold text-ink">
                Your Privacy Choices
            </h2>

            <p class="mt-3">
                Depending on where you live, you may have certain rights regarding
                your personal information. You may also unsubscribe from optional
                email communications and manage cookies through your browser or
                available website controls.
            </p>
        </section>


        {{-- Children --}}
        <section>
            <h2 class="font-serif text-2xl font-semibold text-ink">
                Children's Privacy
            </h2>

            <p class="mt-3">
                Gift Trandly is not intended to knowingly collect personal
                information from children where parental consent or other
                authorization is required by applicable law.
            </p>
        </section>


        {{-- Changes --}}
        <section>
            <h2 class="font-serif text-2xl font-semibold text-ink">
                Changes to This Privacy Policy
            </h2>

            <p class="mt-3">
                We may update this Privacy Policy when our website, services or
                privacy practices change. The latest version will be posted on this
                page with an updated date.
            </p>
        </section>


        {{-- Contact --}}
        <section class="rounded-2xl border border-blush-100 bg-linen p-6 sm:p-8">

            <h2 class="font-serif text-2xl font-semibold text-ink">
                Contact Us
            </h2>

            <p class="mt-3">
                If you have questions about this Privacy Policy or how information
                is handled on Gift Trandly, please contact us through our contact
                page.
            </p>

            <a href="{{ route('contact') }}"
               class="btn-pink mt-5 inline-flex">
                Contact Gift Trandly
            </a>

        </section>

    </div>

</div>

@endsection