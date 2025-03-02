<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* home/index.html.twig */
class __TwigTemplate_dcf1861628d29e3103b57e40d5a13b52 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "home/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "home/index.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "home/index.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Welcome to DevSphere";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        // line 6
        yield "<div class=\"home-container\">
    <header class=\"hero\">
        <h1>Welcome to DevSphere</h1>
        <p class=\"subtitle\">Your Professional Development Community</p>
    </header>

    <section class=\"features\">
        <div class=\"feature-card\">
            <i class=\"fas fa-users\"></i>
            <h3>Connect</h3>
            <p>Connect with fellow developers and expand your professional network</p>
        </div>
        <div class=\"feature-card\">
            <i class=\"fas fa-lightbulb\"></i>
            <h3>Learn</h3>
            <p>Access resources and share knowledge with the community</p>
        </div>
        <div class=\"feature-card\">
            <i class=\"fas fa-code\"></i>
            <h3>Grow</h3>
            <p>Enhance your skills and advance your career in technology</p>
        </div>
    </section>

    <section class=\"cta\">
        <h2>Start Your Journey Today</h2>
        <div class=\"cta-buttons\">
            <a href=\"";
        // line 33
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_signup");
        yield "\" class=\"btn-primary\">Sign Up</a>
            <a href=\"";
        // line 34
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
        yield "\" class=\"btn-secondary\">Log In</a>
        </div>
    </section>
</div>

<style>
.home-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.hero {
    text-align: center;
    padding: 4rem 0;
    background: linear-gradient(135deg, #00bcd4 0%, #007b8a 100%);
    color: white;
    border-radius: 20px;
    margin-bottom: 4rem;
}

.hero h1 {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.subtitle {
    font-size: 1.5rem;
    opacity: 0.9;
}

.features {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin-bottom: 4rem;
}

.feature-card {
    background: white;
    padding: 2rem;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-5px);
}

.feature-card i {
    font-size: 2.5rem;
    color: #00bcd4;
    margin-bottom: 1rem;
}

.feature-card h3 {
    font-size: 1.5rem;
    margin-bottom: 1rem;
    color: #333;
}

.feature-card p {
    color: #666;
    line-height: 1.6;
}

.cta {
    text-align: center;
    padding: 4rem 0;
}

.cta h2 {
    font-size: 2rem;
    margin-bottom: 2rem;
    color: #333;
}

.cta-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
}

.btn-primary, .btn-secondary {
    padding: 12px 30px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary {
    background: #00bcd4;
    color: white;
}

.btn-primary:hover {
    background: #008c9e;
}

.btn-secondary {
    background: white;
    color: #00bcd4;
    border: 2px solid #00bcd4;
}

.btn-secondary:hover {
    background: #f8f9fa;
}

@media (max-width: 768px) {
    .home-container {
        padding: 1rem;
    }

    .hero {
        padding: 3rem 1rem;
    }

    .hero h1 {
        font-size: 2.5rem;
    }

    .subtitle {
        font-size: 1.2rem;
    }

    .features {
        grid-template-columns: 1fr;
    }

    .cta-buttons {
        flex-direction: column;
    }

    .btn-primary, .btn-secondary {
        width: 100%;
        text-align: center;
    }
}
</style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "home/index.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  133 => 34,  129 => 33,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Welcome to DevSphere{% endblock %}

{% block content %}
<div class=\"home-container\">
    <header class=\"hero\">
        <h1>Welcome to DevSphere</h1>
        <p class=\"subtitle\">Your Professional Development Community</p>
    </header>

    <section class=\"features\">
        <div class=\"feature-card\">
            <i class=\"fas fa-users\"></i>
            <h3>Connect</h3>
            <p>Connect with fellow developers and expand your professional network</p>
        </div>
        <div class=\"feature-card\">
            <i class=\"fas fa-lightbulb\"></i>
            <h3>Learn</h3>
            <p>Access resources and share knowledge with the community</p>
        </div>
        <div class=\"feature-card\">
            <i class=\"fas fa-code\"></i>
            <h3>Grow</h3>
            <p>Enhance your skills and advance your career in technology</p>
        </div>
    </section>

    <section class=\"cta\">
        <h2>Start Your Journey Today</h2>
        <div class=\"cta-buttons\">
            <a href=\"{{ path('app_signup') }}\" class=\"btn-primary\">Sign Up</a>
            <a href=\"{{ path('app_login') }}\" class=\"btn-secondary\">Log In</a>
        </div>
    </section>
</div>

<style>
.home-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.hero {
    text-align: center;
    padding: 4rem 0;
    background: linear-gradient(135deg, #00bcd4 0%, #007b8a 100%);
    color: white;
    border-radius: 20px;
    margin-bottom: 4rem;
}

.hero h1 {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.subtitle {
    font-size: 1.5rem;
    opacity: 0.9;
}

.features {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin-bottom: 4rem;
}

.feature-card {
    background: white;
    padding: 2rem;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-5px);
}

.feature-card i {
    font-size: 2.5rem;
    color: #00bcd4;
    margin-bottom: 1rem;
}

.feature-card h3 {
    font-size: 1.5rem;
    margin-bottom: 1rem;
    color: #333;
}

.feature-card p {
    color: #666;
    line-height: 1.6;
}

.cta {
    text-align: center;
    padding: 4rem 0;
}

.cta h2 {
    font-size: 2rem;
    margin-bottom: 2rem;
    color: #333;
}

.cta-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
}

.btn-primary, .btn-secondary {
    padding: 12px 30px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary {
    background: #00bcd4;
    color: white;
}

.btn-primary:hover {
    background: #008c9e;
}

.btn-secondary {
    background: white;
    color: #00bcd4;
    border: 2px solid #00bcd4;
}

.btn-secondary:hover {
    background: #f8f9fa;
}

@media (max-width: 768px) {
    .home-container {
        padding: 1rem;
    }

    .hero {
        padding: 3rem 1rem;
    }

    .hero h1 {
        font-size: 2.5rem;
    }

    .subtitle {
        font-size: 1.2rem;
    }

    .features {
        grid-template-columns: 1fr;
    }

    .cta-buttons {
        flex-direction: column;
    }

    .btn-primary, .btn-secondary {
        width: 100%;
        text-align: center;
    }
}
</style>
{% endblock %}
", "home/index.html.twig", "C:\\Users\\maram\\pi_symfony_DevSphere1\\templates\\home\\index.html.twig");
    }
}
