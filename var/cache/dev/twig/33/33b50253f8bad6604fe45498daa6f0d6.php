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

/* login/index.html.twig */
class __TwigTemplate_cca3edf84051e1d59af4a44ec93246ff extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "login/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "login/index.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "login/index.html.twig", 1);
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

        yield "Log in";
        
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
        yield "<div class=\"login-container\">
    <div class=\"login-content\">
        <div class=\"login-form\">
            <div class=\"illustration\">
                <img src=\"";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/logo.png"), "html", null, true);
        yield "\" alt=\"DevSphere Logo\">
            </div>

            <form action=\"";
        // line 13
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
        yield "\" method=\"post\" class=\"form-login\">
                ";
        // line 14
        if ((isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 14, $this->source); })())) {
            // line 15
            yield "                    <div class=\"alert alert-error\">
                        ";
            // line 16
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(CoreExtension::getAttribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 16, $this->source); })()), "messageKey", [], "any", false, false, false, 16), CoreExtension::getAttribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 16, $this->source); })()), "messageData", [], "any", false, false, false, 16), "security"), "html", null, true);
            yield "
                    </div>
                ";
        }
        // line 19
        yield "
                <div class=\"form-group\">
                    <label for=\"username\">
                        <i class=\"fas fa-envelope\"></i>
                    </label>
                    <input type=\"email\" id=\"username\" name=\"_username\" value=\"";
        // line 24
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["last_username"]) || array_key_exists("last_username", $context) ? $context["last_username"] : (function () { throw new RuntimeError('Variable "last_username" does not exist.', 24, $this->source); })()), "html", null, true);
        yield "\" placeholder=\"Your Email\" required autofocus>
                </div>

                <div class=\"form-group\">
                    <label for=\"password\">
                        <i class=\"fas fa-lock\"></i>
                    </label>
                    <input type=\"password\" id=\"password\" name=\"_password\" placeholder=\"Password\" required>
                </div>

                <input type=\"hidden\" name=\"_csrf_token\" value=\"";
        // line 34
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken("authenticate"), "html", null, true);
        yield "\">

                <div class=\"form-check mb-3\">
                    <input type=\"checkbox\" id=\"remember_me\" name=\"_remember_me\" class=\"form-check-input\" checked>
                    <label class=\"form-check-label\" for=\"remember_me\">Remember me</label>
                </div>

                <div class=\"form-actions\">
                    <button type=\"submit\" class=\"btn-login\">Log in</button>
                    <a href=\"";
        // line 43
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_signup");
        yield "\" class=\"btn-signup\">Don't have an account?</a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.login-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f8f9fa;
    padding: 2rem;
}

.login-content {
    background: white;
    border-radius: 20px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 900px;
    overflow: hidden;
}

.login-form {
    padding: 2rem;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.illustration {
    margin-bottom: 2rem;
    max-width: 400px;
}

.illustration img {
    width: 100%;
    height: auto;
}

.form-login {
    width: 100%;
    max-width: 400px;
}

.form-group {
    position: relative;
    margin-bottom: 1.5rem;
}

.form-group label {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d;
}

.form-group input {
    width: 100%;
    padding: 12px 40px;
    border: 1px solid #e0e0e0;
    border-radius: 25px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-group input:focus {
    border-color: #00bcd4;
    box-shadow: 0 0 0 2px rgba(0, 188, 212, 0.2);
    outline: none;
}

.form-check {
    padding-left: 1.5rem;
    margin-bottom: 1rem;
}

.form-check-input {
    margin-left: -1.5rem;
    margin-top: 0.2rem;
}

.form-check-label {
    color: #6c757d;
    font-size: 0.9rem;
    cursor: pointer;
}

.alert {
    width: 100%;
    margin-bottom: 1rem;
    padding: 1rem;
    border-radius: 10px;
    text-align: center;
}

.alert-error {
    background-color: #f8d7da;
    border-color: #f5c6cb;
    color: #721c24;
}

.form-actions {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    align-items: center;
    margin-top: 2rem;
}

.btn-login {
    background: #00bcd4;
    color: white;
    border: none;
    padding: 12px 40px;
    border-radius: 25px;
    font-size: 1rem;
    cursor: pointer;
    width: 100%;
    transition: background 0.3s ease;
}

.btn-login:hover {
    background: #008c9e;
}

.btn-signup {
    color: #6c757d;
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.btn-signup:hover {
    color: #00bcd4;
}

@media (max-width: 768px) {
    .login-container {
        padding: 1rem;
    }
    
    .login-form {
        padding: 1.5rem;
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
        return "login/index.html.twig";
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
        return array (  159 => 43,  147 => 34,  134 => 24,  127 => 19,  121 => 16,  118 => 15,  116 => 14,  112 => 13,  106 => 10,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Log in{% endblock %}

{% block content %}
<div class=\"login-container\">
    <div class=\"login-content\">
        <div class=\"login-form\">
            <div class=\"illustration\">
                <img src=\"{{ asset('img/logo.png') }}\" alt=\"DevSphere Logo\">
            </div>

            <form action=\"{{ path('app_login') }}\" method=\"post\" class=\"form-login\">
                {% if error %}
                    <div class=\"alert alert-error\">
                        {{ error.messageKey|trans(error.messageData, 'security') }}
                    </div>
                {% endif %}

                <div class=\"form-group\">
                    <label for=\"username\">
                        <i class=\"fas fa-envelope\"></i>
                    </label>
                    <input type=\"email\" id=\"username\" name=\"_username\" value=\"{{ last_username }}\" placeholder=\"Your Email\" required autofocus>
                </div>

                <div class=\"form-group\">
                    <label for=\"password\">
                        <i class=\"fas fa-lock\"></i>
                    </label>
                    <input type=\"password\" id=\"password\" name=\"_password\" placeholder=\"Password\" required>
                </div>

                <input type=\"hidden\" name=\"_csrf_token\" value=\"{{ csrf_token('authenticate') }}\">

                <div class=\"form-check mb-3\">
                    <input type=\"checkbox\" id=\"remember_me\" name=\"_remember_me\" class=\"form-check-input\" checked>
                    <label class=\"form-check-label\" for=\"remember_me\">Remember me</label>
                </div>

                <div class=\"form-actions\">
                    <button type=\"submit\" class=\"btn-login\">Log in</button>
                    <a href=\"{{ path('app_signup') }}\" class=\"btn-signup\">Don't have an account?</a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.login-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f8f9fa;
    padding: 2rem;
}

.login-content {
    background: white;
    border-radius: 20px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 900px;
    overflow: hidden;
}

.login-form {
    padding: 2rem;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.illustration {
    margin-bottom: 2rem;
    max-width: 400px;
}

.illustration img {
    width: 100%;
    height: auto;
}

.form-login {
    width: 100%;
    max-width: 400px;
}

.form-group {
    position: relative;
    margin-bottom: 1.5rem;
}

.form-group label {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d;
}

.form-group input {
    width: 100%;
    padding: 12px 40px;
    border: 1px solid #e0e0e0;
    border-radius: 25px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-group input:focus {
    border-color: #00bcd4;
    box-shadow: 0 0 0 2px rgba(0, 188, 212, 0.2);
    outline: none;
}

.form-check {
    padding-left: 1.5rem;
    margin-bottom: 1rem;
}

.form-check-input {
    margin-left: -1.5rem;
    margin-top: 0.2rem;
}

.form-check-label {
    color: #6c757d;
    font-size: 0.9rem;
    cursor: pointer;
}

.alert {
    width: 100%;
    margin-bottom: 1rem;
    padding: 1rem;
    border-radius: 10px;
    text-align: center;
}

.alert-error {
    background-color: #f8d7da;
    border-color: #f5c6cb;
    color: #721c24;
}

.form-actions {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    align-items: center;
    margin-top: 2rem;
}

.btn-login {
    background: #00bcd4;
    color: white;
    border: none;
    padding: 12px 40px;
    border-radius: 25px;
    font-size: 1rem;
    cursor: pointer;
    width: 100%;
    transition: background 0.3s ease;
}

.btn-login:hover {
    background: #008c9e;
}

.btn-signup {
    color: #6c757d;
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.btn-signup:hover {
    color: #00bcd4;
}

@media (max-width: 768px) {
    .login-container {
        padding: 1rem;
    }
    
    .login-form {
        padding: 1.5rem;
    }
}
</style>
{% endblock %}
", "login/index.html.twig", "C:\\Users\\maram\\pi_symfony_DevSphere1\\templates\\login\\index.html.twig");
    }
}
