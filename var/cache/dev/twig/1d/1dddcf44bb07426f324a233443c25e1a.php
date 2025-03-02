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

/* signup/index.html.twig */
class __TwigTemplate_1b00b86b9e143a535874c155d4240ccb extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "signup/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "signup/index.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "signup/index.html.twig", 1);
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

        yield "Sign Up";
        
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
        yield "<div class=\"signup-container\">
    <div class=\"signup-content\">
        <div class=\"signup-form\">
            ";
        // line 10
        yield "            ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 10, $this->source); })()), "flashes", [], "any", false, false, false, 10));
        foreach ($context['_seq'] as $context["label"] => $context["messages"]) {
            // line 11
            yield "                ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 12
                yield "                    <div class=\"alert alert-";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"], "html", null, true);
                yield " alert-dismissible fade show\" role=\"alert\">
                        ";
                // line 13
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
                yield "
                        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
                    </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 17
            yield "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['label'], $context['messages'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 18
        yield "
            <div class=\"illustration\">
                <img src=\"";
        // line 20
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("assets/images/signup-illustration.png"), "html", null, true);
        yield "\" alt=\"Sign up illustration\">
            </div>
            
            <form method=\"POST\" action=\"";
        // line 23
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_signup");
        yield "\" class=\"form-signup\" enctype=\"multipart/form-data\">
                <div class=\"form-group\">
                    <label for=\"name\">
                        <i class=\"fas fa-user\"></i>
                    </label>
                    <input type=\"text\" id=\"name\" name=\"name\" placeholder=\"Your Name\" required>
                </div>

                <div class=\"form-group\">
                    <label for=\"phone\">
                        <i class=\"fas fa-phone\"></i>
                    </label>
                    <input type=\"tel\" id=\"phone\" name=\"phone\" placeholder=\"Your Phone Number\" required>
                </div>

                <div class=\"form-group\">
                    <label for=\"cin\">
                        <i class=\"fas fa-id-card\"></i>
                    </label>
                    <input type=\"text\" id=\"cin\" name=\"cin\" placeholder=\"Your CIN\" required>
                </div>

                <div class=\"form-group file-group\">
                    <label for=\"image\" class=\"file-label\">
                        <i class=\"fas fa-image\"></i>
                        <span>Upload Profile Image</span>
                    </label>
                    <input type=\"file\" id=\"image\" name=\"image\" accept=\"image/*\" required>
                    <div class=\"file-name\">No file chosen</div>
                </div>

                <div class=\"form-group\">
                    <label for=\"role\">
                        <i class=\"fas fa-user-tag\"></i>
                    </label>
                    <select id=\"role\" name=\"role\" required>
                        <option value=\"\" disabled selected>Select Your Role</option>
                        <option value=\"user\">User</option>
                    </select>
                </div>

                <div class=\"form-group\">
                    <label for=\"email\">
                        <i class=\"fas fa-envelope\"></i>
                    </label>
                    <input type=\"email\" id=\"email\" name=\"email\" placeholder=\"Your Email\" required>
                </div>

                <div class=\"form-group\">
                    <label for=\"password\">
                        <i class=\"fas fa-lock\"></i>
                    </label>
                    <input type=\"password\" id=\"password\" name=\"password\" placeholder=\"Password\" required>
                </div>

                <div class=\"form-group\">
                    <label for=\"confirm_password\">
                        <i class=\"fas fa-key\"></i>
                    </label>
                    <input type=\"password\" id=\"confirm_password\" name=\"confirm_password\" placeholder=\"Confirm Password\" required>
                </div>

                <div class=\"form-actions\">
                    <button type=\"submit\" class=\"btn-signup\">Sign Up</button>
                    <a href=\"";
        // line 87
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
        yield "\" class=\"btn-login\">Already have an account?</a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.signup-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f8f9fa;
    padding: 2rem;
}

.signup-content {
    background: white;
    border-radius: 20px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 900px;
    overflow: hidden;
}

.signup-form {
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

.form-signup {
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
    z-index: 1;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 12px 40px;
    border: 1px solid #e0e0e0;
    border-radius: 25px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background-color: white;
}

.form-group input:focus,
.form-group select:focus {
    border-color: #00bcd4;
    box-shadow: 0 0 0 2px rgba(0, 188, 212, 0.2);
    outline: none;
}

/* File input styling */
.file-group {
    border: 1px solid #e0e0e0;
    border-radius: 25px;
    padding: 8px;
}

.file-group input[type=\"file\"] {
    display: none;
}

.file-label {
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    position: static;
    transform: none;
    padding: 8px 15px;
}

.file-name {
    margin-left: 40px;
    font-size: 0.9rem;
    color: #6c757d;
}

.form-actions {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    align-items: center;
    margin-top: 2rem;
}

.btn-signup {
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

.btn-signup:hover {
    background: #008c9e;
}

.btn-login {
    color: #6c757d;
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.btn-login:hover {
    color: #00bcd4;
}

.alert {
    width: 100%;
    max-width: 400px;
    margin-bottom: 1rem;
    padding: 1rem;
    border-radius: 10px;
    text-align: center;
}

.alert-success {
    background-color: #d4edda;
    border-color: #c3e6cb;
    color: #155724;
}

.alert-error {
    background-color: #f8d7da;
    border-color: #f5c6cb;
    color: #721c24;
}

.btn-close {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    opacity: 0.5;
}

.btn-close:hover {
    opacity: 1;
}

@media (max-width: 768px) {
    .signup-container {
        padding: 1rem;
    }
    
    .signup-form {
        padding: 1.5rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('image');
    const fileName = document.querySelector('.file-name');
    
    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            fileName.textContent = this.files[0].name;
        } else {
            fileName.textContent = 'No file chosen';
        }
    });
});

// Auto-hide alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            const closeButton = alert.querySelector('.btn-close');
            if (closeButton) {
                closeButton.click();
            }
        });
    }, 5000);
});
</script>
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
        return "signup/index.html.twig";
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
        return array (  213 => 87,  146 => 23,  140 => 20,  136 => 18,  130 => 17,  120 => 13,  115 => 12,  110 => 11,  105 => 10,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Sign Up{% endblock %}

{% block content %}
<div class=\"signup-container\">
    <div class=\"signup-content\">
        <div class=\"signup-form\">
            {# Flash Messages #}
            {% for label, messages in app.flashes %}
                {% for message in messages %}
                    <div class=\"alert alert-{{ label }} alert-dismissible fade show\" role=\"alert\">
                        {{ message }}
                        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
                    </div>
                {% endfor %}
            {% endfor %}

            <div class=\"illustration\">
                <img src=\"{{ asset('assets/images/signup-illustration.png') }}\" alt=\"Sign up illustration\">
            </div>
            
            <form method=\"POST\" action=\"{{ path('app_signup') }}\" class=\"form-signup\" enctype=\"multipart/form-data\">
                <div class=\"form-group\">
                    <label for=\"name\">
                        <i class=\"fas fa-user\"></i>
                    </label>
                    <input type=\"text\" id=\"name\" name=\"name\" placeholder=\"Your Name\" required>
                </div>

                <div class=\"form-group\">
                    <label for=\"phone\">
                        <i class=\"fas fa-phone\"></i>
                    </label>
                    <input type=\"tel\" id=\"phone\" name=\"phone\" placeholder=\"Your Phone Number\" required>
                </div>

                <div class=\"form-group\">
                    <label for=\"cin\">
                        <i class=\"fas fa-id-card\"></i>
                    </label>
                    <input type=\"text\" id=\"cin\" name=\"cin\" placeholder=\"Your CIN\" required>
                </div>

                <div class=\"form-group file-group\">
                    <label for=\"image\" class=\"file-label\">
                        <i class=\"fas fa-image\"></i>
                        <span>Upload Profile Image</span>
                    </label>
                    <input type=\"file\" id=\"image\" name=\"image\" accept=\"image/*\" required>
                    <div class=\"file-name\">No file chosen</div>
                </div>

                <div class=\"form-group\">
                    <label for=\"role\">
                        <i class=\"fas fa-user-tag\"></i>
                    </label>
                    <select id=\"role\" name=\"role\" required>
                        <option value=\"\" disabled selected>Select Your Role</option>
                        <option value=\"user\">User</option>
                    </select>
                </div>

                <div class=\"form-group\">
                    <label for=\"email\">
                        <i class=\"fas fa-envelope\"></i>
                    </label>
                    <input type=\"email\" id=\"email\" name=\"email\" placeholder=\"Your Email\" required>
                </div>

                <div class=\"form-group\">
                    <label for=\"password\">
                        <i class=\"fas fa-lock\"></i>
                    </label>
                    <input type=\"password\" id=\"password\" name=\"password\" placeholder=\"Password\" required>
                </div>

                <div class=\"form-group\">
                    <label for=\"confirm_password\">
                        <i class=\"fas fa-key\"></i>
                    </label>
                    <input type=\"password\" id=\"confirm_password\" name=\"confirm_password\" placeholder=\"Confirm Password\" required>
                </div>

                <div class=\"form-actions\">
                    <button type=\"submit\" class=\"btn-signup\">Sign Up</button>
                    <a href=\"{{ path('app_login') }}\" class=\"btn-login\">Already have an account?</a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.signup-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f8f9fa;
    padding: 2rem;
}

.signup-content {
    background: white;
    border-radius: 20px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 900px;
    overflow: hidden;
}

.signup-form {
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

.form-signup {
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
    z-index: 1;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 12px 40px;
    border: 1px solid #e0e0e0;
    border-radius: 25px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background-color: white;
}

.form-group input:focus,
.form-group select:focus {
    border-color: #00bcd4;
    box-shadow: 0 0 0 2px rgba(0, 188, 212, 0.2);
    outline: none;
}

/* File input styling */
.file-group {
    border: 1px solid #e0e0e0;
    border-radius: 25px;
    padding: 8px;
}

.file-group input[type=\"file\"] {
    display: none;
}

.file-label {
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    position: static;
    transform: none;
    padding: 8px 15px;
}

.file-name {
    margin-left: 40px;
    font-size: 0.9rem;
    color: #6c757d;
}

.form-actions {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    align-items: center;
    margin-top: 2rem;
}

.btn-signup {
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

.btn-signup:hover {
    background: #008c9e;
}

.btn-login {
    color: #6c757d;
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.btn-login:hover {
    color: #00bcd4;
}

.alert {
    width: 100%;
    max-width: 400px;
    margin-bottom: 1rem;
    padding: 1rem;
    border-radius: 10px;
    text-align: center;
}

.alert-success {
    background-color: #d4edda;
    border-color: #c3e6cb;
    color: #155724;
}

.alert-error {
    background-color: #f8d7da;
    border-color: #f5c6cb;
    color: #721c24;
}

.btn-close {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    opacity: 0.5;
}

.btn-close:hover {
    opacity: 1;
}

@media (max-width: 768px) {
    .signup-container {
        padding: 1rem;
    }
    
    .signup-form {
        padding: 1.5rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('image');
    const fileName = document.querySelector('.file-name');
    
    fileInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            fileName.textContent = this.files[0].name;
        } else {
            fileName.textContent = 'No file chosen';
        }
    });
});

// Auto-hide alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            const closeButton = alert.querySelector('.btn-close');
            if (closeButton) {
                closeButton.click();
            }
        });
    }, 5000);
});
</script>
{% endblock %}
", "signup/index.html.twig", "C:\\Users\\maram\\pi_symfony_DevSphere1\\templates\\signup\\index.html.twig");
    }
}
