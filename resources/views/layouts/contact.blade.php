<x-layout title="Contact Us">
    <section class="contact">

        {{-- Linkerkant: info --}}
        <aside class="contact__info">
            <img src="{{ asset('images/logo.webp') }}" alt="" class="contact__logo">
            <h1>Contact Us</h1>
            <p>
                Have a question, found a problem, or just want to share feedback?
                Fill in the form and we'll get back to you as soon as possible.
            </p>

            <ul class="contact__points">
                <li><span>💬</span> Questions about recipes</li>
                <li><span>🐞</span> Something not working</li>
                <li><span>💡</span> Ideas and feedback</li>
            </ul>
        </aside>

        {{-- Rechterkant: formulier --}}
        <div class="contact__form">
            @if (session('status'))
                <div class="contact__success">
                    <strong>Thank you!</strong>
                    <p>{{ session('status') }}</p>
                </div>
            @endif

            <form action="{{ route('contact.send') }}" method="POST">
                @csrf

                <div class="form-field">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', auth()->user()?->name) }}" placeholder="Your name" required>
                    @error('name')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', auth()->user()?->email) }}" placeholder="you@example.com" required>
                    @error('email')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-field">
                    <label for="issue">Issue</label>
                    <textarea id="issue" name="issue" rows="6" placeholder="Tell us what's going on..." required>{{ old('issue') }}</textarea>
                    @error('issue')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn btn--primary contact__submit">Send message</button>
            </form>
        </div>

    </section>
</x-layout>
