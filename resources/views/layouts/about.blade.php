<x-layout title="About Us">

    {{-- Header met foto --}}
    <header class="about-hero" style="background-image: url('{{ asset('images/About-image3.jpg') }}')">
        <div class="about-hero__content">
            <p class="about-hero__eyebrow">About Us</p>
            <h1>Welcome to The Cozy Kitchen</h1>
            <p>
                The Cozy Kitchen was created with one simple idea in mind: cooking should be enjoyable,
                affordable, and accessible to everyone. We believe that you don't need to be a professional
                chef or have expensive ingredients to prepare a delicious meal.
            </p>
        </div>
    </header>

    {{-- Waarom --}}
    <section class="about-split">
        <figure class="about-split__image">
            <img src="{{ asset('images/About-image2.jpg') }}" alt="An open notebook with a handwritten focaccia recipe">
        </figure>

        <div class="about-split__text">
            <h2>Why We Built This Website</h2>
            <p>
                The idea behind The Cozy Kitchen came from the everyday challenge of deciding what to cook.
                Many people have busy schedules, limited budgets, or little experience in the kitchen.
                Finding recipes that are easy to follow and use everyday ingredients can sometimes be difficult.
            </p>
            <p>
                We created this cookbook website to make that process easier. Our goal is to bring different
                recipes together in one place, helping people discover new meals, learn basic cooking skills,
                and feel more confident in the kitchen.
            </p>
        </div>
    </section>

    {{-- Wat je hier vindt --}}
    <section class="about-split about-split--reverse">
        <figure class="about-split__image">
            <img src="{{ asset('images/About-image1.jpg') }}" alt="A colourful bowl with chicken, quinoa, avocado and vegetables">
        </figure>

        <div class="about-split__text">
            <h2>What You'll Find Here</h2>
            <p>
                Our collection includes quick weekday dinners, comforting homemade meals, tasty desserts,
                healthy options, and recipes inspired by different food cultures. Each recipe is designed to
                be clear and practical, with ingredients and step-by-step instructions to help you get started.
            </p>
            <p>
                Whether you're cooking for yourself, preparing a meal for friends, or sharing dinner with your
                family, there's always something new to try.
            </p>

            <ul class="about-tags">
                <li>Quick weekday dinners</li>
                <li>Homemade comfort food</li>
                <li>Desserts</li>
                <li>Healthy options</li>
                <li>World flavours</li>
            </ul>
        </div>
    </section>

    {{-- Missie --}}
    <section class="about-mission">
        <h2>Our Mission</h2>
        <p>
            Our mission is to inspire more people to cook at home, experiment with new flavors, and enjoy the
            experience of making food. We want to show that great cooking isn't about perfection. It's about
            creativity, learning, and bringing people together.
        </p>
    </section>

    {{-- Afsluiting --}}
    <section class="card about-cta">
        <img src="{{ asset('images/logo.webp') }}" alt="" class="about-cta__logo">
        <h2>Let's Cook Something Delicious</h2>
        <p>
            The kitchen is a place to try new things, make mistakes, and create memories. Explore our recipes,
            find your next favorite dish, and make yourself at home.
        </p>
        <p class="about-cta__closing">Welcome to The Cozy Kitchen — where every recipe brings people together.</p>

        <div class="about-cta__buttons">
            <a href="{{ route('products.index') }}" class="btn btn--primary">Explore our recipes</a>
            @guest
                <a href="{{ route('register') }}" class="btn btn--outline">Join the kitchen</a>
            @endguest
        </div>
    </section>

</x-layout>
