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

/* admin/tentative/show.html.twig */
class __TwigTemplate_e4a009d399f63d3b85f13146c039db15 extends Template
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
            'stylesheets' => [$this, 'block_stylesheets'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "admin/base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/tentative/show.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/tentative/show.html.twig"));

        $this->parent = $this->loadTemplate("admin/base.html.twig", "admin/tentative/show.html.twig", 1);
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

        yield "Détails de la tentative";
        
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
        yield "    <div class=\"container-fluid\">
        <h1 class=\"h3 mb-4 text-gray-800\">Détails de la tentative</h1>

        <div class=\"row\">
            <div class=\"col-lg-12\">
                <div class=\"card shadow mb-4\">
                    <div class=\"card-header py-3 d-flex justify-content-between align-items-center\">
                        <h6 class=\"m-0 font-weight-bold text-primary\">Informations de la tentative</h6>
                        <div>
                            <a href=\"";
        // line 15
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_tentative_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["tentative"]) || array_key_exists("tentative", $context) ? $context["tentative"] : (function () { throw new RuntimeError('Variable "tentative" does not exist.', 15, $this->source); })()), "id", [], "any", false, false, false, 15)]), "html", null, true);
        yield "\" class=\"btn btn-warning btn-sm mr-2\">
                                <i class=\"fas fa-edit\"></i> Modifier
                            </a>
                            <a href=\"";
        // line 18
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_tentative_index");
        yield "\" class=\"btn btn-secondary btn-sm\">
                                <i class=\"fas fa-arrow-left\"></i> Retour
                            </a>
                        </div>
                    </div>
                    <div class=\"card-body\">
                        <div class=\"row\">
                            <div class=\"col-md-6\">
                                <div class=\"info-box bg-light p-3 rounded shadow-sm mb-3\">
                                    <h5 class=\"text-primary\"><i class=\"fas fa-user me-2\"></i> Utilisateur</h5>
                                    <p class=\"mb-0\">";
        // line 28
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["tentative"]) || array_key_exists("tentative", $context) ? $context["tentative"] : (function () { throw new RuntimeError('Variable "tentative" does not exist.', 28, $this->source); })()), "user", [], "any", false, false, false, 28), "email", [], "any", false, false, false, 28), "html", null, true);
        yield "</p>
                                </div>
                            </div>
                            <div class=\"col-md-6\">
                                <div class=\"info-box bg-light p-3 rounded shadow-sm mb-3\">
                                    <h5 class=\"text-primary\"><i class=\"fas fa-book me-2\"></i> Exercice</h5>
                                    <p class=\"mb-0\">";
        // line 34
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["tentative"]) || array_key_exists("tentative", $context) ? $context["tentative"] : (function () { throw new RuntimeError('Variable "tentative" does not exist.', 34, $this->source); })()), "exercice", [], "any", false, false, false, 34), "titre", [], "any", false, false, false, 34), "html", null, true);
        yield "</p>
                                </div>
                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-md-6\">
                                <div class=\"info-box bg-light p-3 rounded shadow-sm mb-3\">
                                    <h5 class=\"text-primary\"><i class=\"fas fa-star me-2\"></i> Score</h5>
                                    <p class=\"mb-0\">
                                        <span class=\"badge ";
        // line 44
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["tentative"]) || array_key_exists("tentative", $context) ? $context["tentative"] : (function () { throw new RuntimeError('Variable "tentative" does not exist.', 44, $this->source); })()), "score", [], "any", false, false, false, 44) >= CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["tentative"]) || array_key_exists("tentative", $context) ? $context["tentative"] : (function () { throw new RuntimeError('Variable "tentative" does not exist.', 44, $this->source); })()), "exercice", [], "any", false, false, false, 44), "noteMinimale", [], "any", false, false, false, 44))) {
            yield "bg-success";
        } else {
            yield "bg-danger";
        }
        yield "\">
                                            ";
        // line 45
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["tentative"]) || array_key_exists("tentative", $context) ? $context["tentative"] : (function () { throw new RuntimeError('Variable "tentative" does not exist.', 45, $this->source); })()), "score", [], "any", false, false, false, 45), "html", null, true);
        yield "/100
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class=\"col-md-6\">
                                <div class=\"info-box bg-light p-3 rounded shadow-sm mb-3\">
                                    <h5 class=\"text-primary\"><i class=\"fas fa-graduation-cap me-2\"></i> Note</h5>
                                    <p class=\"mb-0\">
                                        <span class=\"badge ";
        // line 54
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["tentative"]) || array_key_exists("tentative", $context) ? $context["tentative"] : (function () { throw new RuntimeError('Variable "tentative" does not exist.', 54, $this->source); })()), "note", [], "any", false, false, false, 54) >= 10)) {
            yield "bg-success";
        } else {
            yield "bg-danger";
        }
        yield "\">
                                            ";
        // line 55
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(CoreExtension::getAttribute($this->env, $this->source, (isset($context["tentative"]) || array_key_exists("tentative", $context) ? $context["tentative"] : (function () { throw new RuntimeError('Variable "tentative" does not exist.', 55, $this->source); })()), "note", [], "any", false, false, false, 55), 2), "html", null, true);
        yield "/20
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-md-6\">
                                <div class=\"info-box bg-light p-3 rounded shadow-sm mb-3\">
                                    <h5 class=\"text-primary\"><i class=\"fas fa-info-circle me-2\"></i> Statut</h5>
                                    <p class=\"mb-0\">
                                        <span class=\"badge ";
        // line 67
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["tentative"]) || array_key_exists("tentative", $context) ? $context["tentative"] : (function () { throw new RuntimeError('Variable "tentative" does not exist.', 67, $this->source); })()), "statue", [], "any", false, false, false, 67) == "Réussi")) {
            yield "bg-success";
        } else {
            yield "bg-danger";
        }
        yield "\">
                                            ";
        // line 68
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["tentative"]) || array_key_exists("tentative", $context) ? $context["tentative"] : (function () { throw new RuntimeError('Variable "tentative" does not exist.', 68, $this->source); })()), "statue", [], "any", false, false, false, 68), "html", null, true);
        yield "
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class=\"col-md-6\">
                                <div class=\"info-box bg-light p-3 rounded shadow-sm mb-3\">
                                    <h5 class=\"text-primary\"><i class=\"fas fa-calendar me-2\"></i> Date</h5>
                                    <p class=\"mb-0\">";
        // line 76
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["tentative"]) || array_key_exists("tentative", $context) ? $context["tentative"] : (function () { throw new RuntimeError('Variable "tentative" does not exist.', 76, $this->source); })()), "date", [], "any", false, false, false, 76), "d/m/Y H:i"), "html", null, true);
        yield "</p>
                                </div>
                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-12\">
                                <div class=\"info-box bg-light p-3 rounded shadow-sm\">
                                    <h5 class=\"text-primary\"><i class=\"fas fa-comment me-2\"></i> Réponse</h5>
                                    <p class=\"mb-0\">";
        // line 85
        yield Twig\Extension\CoreExtension::nl2br($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["tentative"]) || array_key_exists("tentative", $context) ? $context["tentative"] : (function () { throw new RuntimeError('Variable "tentative" does not exist.', 85, $this->source); })()), "reponse", [], "any", false, false, false, 85), "html", null, true));
        yield "</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 96
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 97
        yield "    ";
        yield from $this->yieldParentBlock("stylesheets", $context, $blocks);
        yield "
    <style>
        .info-box {
            transition: all 0.3s ease;
        }
        .info-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .badge {
            font-size: 1rem;
            padding: 0.5rem 1rem;
        }
        .me-2 {
            margin-right: 0.5rem;
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
        return "admin/tentative/show.html.twig";
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
        return array (  261 => 97,  248 => 96,  227 => 85,  215 => 76,  204 => 68,  196 => 67,  181 => 55,  173 => 54,  161 => 45,  153 => 44,  140 => 34,  131 => 28,  118 => 18,  112 => 15,  101 => 6,  88 => 5,  65 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'admin/base.html.twig' %}

{% block title %}Détails de la tentative{% endblock %}

{% block content %}
    <div class=\"container-fluid\">
        <h1 class=\"h3 mb-4 text-gray-800\">Détails de la tentative</h1>

        <div class=\"row\">
            <div class=\"col-lg-12\">
                <div class=\"card shadow mb-4\">
                    <div class=\"card-header py-3 d-flex justify-content-between align-items-center\">
                        <h6 class=\"m-0 font-weight-bold text-primary\">Informations de la tentative</h6>
                        <div>
                            <a href=\"{{ path('admin_tentative_edit', {'id': tentative.id}) }}\" class=\"btn btn-warning btn-sm mr-2\">
                                <i class=\"fas fa-edit\"></i> Modifier
                            </a>
                            <a href=\"{{ path('admin_tentative_index') }}\" class=\"btn btn-secondary btn-sm\">
                                <i class=\"fas fa-arrow-left\"></i> Retour
                            </a>
                        </div>
                    </div>
                    <div class=\"card-body\">
                        <div class=\"row\">
                            <div class=\"col-md-6\">
                                <div class=\"info-box bg-light p-3 rounded shadow-sm mb-3\">
                                    <h5 class=\"text-primary\"><i class=\"fas fa-user me-2\"></i> Utilisateur</h5>
                                    <p class=\"mb-0\">{{ tentative.user.email }}</p>
                                </div>
                            </div>
                            <div class=\"col-md-6\">
                                <div class=\"info-box bg-light p-3 rounded shadow-sm mb-3\">
                                    <h5 class=\"text-primary\"><i class=\"fas fa-book me-2\"></i> Exercice</h5>
                                    <p class=\"mb-0\">{{ tentative.exercice.titre }}</p>
                                </div>
                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-md-6\">
                                <div class=\"info-box bg-light p-3 rounded shadow-sm mb-3\">
                                    <h5 class=\"text-primary\"><i class=\"fas fa-star me-2\"></i> Score</h5>
                                    <p class=\"mb-0\">
                                        <span class=\"badge {% if tentative.score >= tentative.exercice.noteMinimale %}bg-success{% else %}bg-danger{% endif %}\">
                                            {{ tentative.score }}/100
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class=\"col-md-6\">
                                <div class=\"info-box bg-light p-3 rounded shadow-sm mb-3\">
                                    <h5 class=\"text-primary\"><i class=\"fas fa-graduation-cap me-2\"></i> Note</h5>
                                    <p class=\"mb-0\">
                                        <span class=\"badge {% if tentative.note >= 10 %}bg-success{% else %}bg-danger{% endif %}\">
                                            {{ tentative.note|number_format(2) }}/20
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-md-6\">
                                <div class=\"info-box bg-light p-3 rounded shadow-sm mb-3\">
                                    <h5 class=\"text-primary\"><i class=\"fas fa-info-circle me-2\"></i> Statut</h5>
                                    <p class=\"mb-0\">
                                        <span class=\"badge {% if tentative.statue == 'Réussi' %}bg-success{% else %}bg-danger{% endif %}\">
                                            {{ tentative.statue }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class=\"col-md-6\">
                                <div class=\"info-box bg-light p-3 rounded shadow-sm mb-3\">
                                    <h5 class=\"text-primary\"><i class=\"fas fa-calendar me-2\"></i> Date</h5>
                                    <p class=\"mb-0\">{{ tentative.date|date('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-12\">
                                <div class=\"info-box bg-light p-3 rounded shadow-sm\">
                                    <h5 class=\"text-primary\"><i class=\"fas fa-comment me-2\"></i> Réponse</h5>
                                    <p class=\"mb-0\">{{ tentative.reponse|nl2br }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{% endblock %}

{% block stylesheets %}
    {{ parent() }}
    <style>
        .info-box {
            transition: all 0.3s ease;
        }
        .info-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .badge {
            font-size: 1rem;
            padding: 0.5rem 1rem;
        }
        .me-2 {
            margin-right: 0.5rem;
        }
    </style>
{% endblock %}
", "admin/tentative/show.html.twig", "C:\\Users\\maram\\pi_symfony_DevSphere1\\templates\\admin\\tentative\\show.html.twig");
    }
}
