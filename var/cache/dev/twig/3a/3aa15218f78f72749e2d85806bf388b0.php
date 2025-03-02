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

/* exercice/edit.html.twig */
class __TwigTemplate_f7d0589b0fd30627c0357249dc43fc5d extends Template
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
            'carousel' => [$this, 'block_carousel'],
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "exercice/edit.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "exercice/edit.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "exercice/edit.html.twig", 1);
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

        yield "Modifier l'exercice";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_carousel(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "carousel"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "carousel"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 7
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

        // line 8
        yield "    <div class=\"container-fluid bg-primary py-5 mb-5 page-header\">
        <div class=\"container py-5\">
            <div class=\"row justify-content-center\">
                <div class=\"col-lg-10 text-center\">
                    <h1 class=\"display-3 text-white\">Modifier l'exercice</h1>
                    <nav aria-label=\"breadcrumb\">
                        <ol class=\"breadcrumb justify-content-center\">
                            <li class=\"breadcrumb-item\"><a class=\"text-white\" href=\"";
        // line 15
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "\">Accueil</a></li>
                            <li class=\"breadcrumb-item\"><a class=\"text-white\" href=\"";
        // line 16
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_exercice_list");
        yield "\">Exercices</a></li>
                            <li class=\"breadcrumb-item text-white active\" aria-current=\"page\">Modifier</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class=\"container py-5\">
        <div class=\"row justify-content-center\">
            <div class=\"col-lg-8\">
                <div class=\"card shadow-lg border-0 rounded-lg\">
                    <div class=\"card-header bg-gradient-primary-to-secondary p-4\">
                        <h3 class=\"text-center font-weight-light my-2 text-white\">Modifier l'exercice</h3>
                    </div>
                    <div class=\"card-body\">
                        ";
        // line 33
        if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 33, $this->source); })()), "session", [], "any", false, false, false, 33), "flashBag", [], "any", false, false, false, 33), "has", ["success"], "method", false, false, false, 33)) {
            // line 34
            yield "                            <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                                <i class=\"fas fa-check-circle me-2\"></i>
                                ";
            // line 36
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 36, $this->source); })()), "session", [], "any", false, false, false, 36), "flashBag", [], "any", false, false, false, 36), "get", ["success"], "method", false, false, false, 36), 0, [], "array", false, false, false, 36), "html", null, true);
            yield "
                                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
                            </div>
                        ";
        }
        // line 40
        yield "                        ";
        if (CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 40, $this->source); })()), "session", [], "any", false, false, false, 40), "flashBag", [], "any", false, false, false, 40), "has", ["error"], "method", false, false, false, 40)) {
            // line 41
            yield "                            <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                                <i class=\"fas fa-exclamation-circle me-2\"></i>
                                ";
            // line 43
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 43, $this->source); })()), "session", [], "any", false, false, false, 43), "flashBag", [], "any", false, false, false, 43), "get", ["error"], "method", false, false, false, 43), 0, [], "array", false, false, false, 43), "html", null, true);
            yield "
                                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
                            </div>
                        ";
        }
        // line 47
        yield "
                        ";
        // line 48
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 48, $this->source); })()), 'form_start', ["attr" => ["class" => "needs-validation", "novalidate" => "novalidate"]]);
        yield "
                            <div class=\"row mb-3\">
                                <div class=\"col-12 mb-3\">
                                    ";
        // line 51
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 51, $this->source); })()), "titre", [], "any", false, false, false, 51), 'row', ["label" => "Titre", "label_attr" => ["class" => "form-label"], "attr" => ["class" => "form-control", "placeholder" => "Entrez le titre de l'exercice"]]);
        // line 55
        yield "
                                </div>
                            </div>

                            <div class=\"row mb-3\">
                                <div class=\"col-md-6 mb-3\">
                                    ";
        // line 61
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 61, $this->source); })()), "niveau_difficulte", [], "any", false, false, false, 61), 'row', ["label" => "Niveau de difficulté", "label_attr" => ["class" => "form-label"], "attr" => ["class" => "form-select"]]);
        // line 65
        yield "
                                </div>
                                <div class=\"col-md-6 mb-3\">
                                    ";
        // line 68
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 68, $this->source); })()), "type", [], "any", false, false, false, 68), 'row', ["label" => "Type d'exercice", "label_attr" => ["class" => "form-label"], "attr" => ["class" => "form-select"]]);
        // line 72
        yield "
                                </div>
                            </div>

                            <div class=\"row mb-3\">
                                <div class=\"col-md-6 mb-3\">
                                    ";
        // line 78
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 78, $this->source); })()), "note_minimale", [], "any", false, false, false, 78), 'row', ["label" => "Note minimale", "label_attr" => ["class" => "form-label"], "attr" => ["class" => "form-control", "min" => 0, "max" => 20, "step" => 0.5]]);
        // line 87
        yield "
                                </div>
                                <div class=\"col-md-6 mb-3\">
                                    ";
        // line 90
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 90, $this->source); })()), "temps_estime", [], "any", false, false, false, 90), 'row', ["label" => "Temps estimé (minutes)", "label_attr" => ["class" => "form-label"], "attr" => ["class" => "form-control", "min" => 1, "max" => 480]]);
        // line 98
        yield "
                                </div>
                            </div>

                            <div class=\"mb-4\">
                                ";
        // line 103
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 103, $this->source); })()), "fichier_pdf", [], "any", false, false, false, 103), 'row', ["label" => "Fichier PDF", "label_attr" => ["class" => "form-label"], "attr" => ["class" => "form-control"]]);
        // line 107
        yield "
                                ";
        // line 108
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 108, $this->source); })()), "fichierPdf", [], "any", false, false, false, 108)) {
            // line 109
            yield "                                    <div class=\"mt-2\">
                                        <p class=\"mb-1\"><strong>Fichier actuel :</strong></p>
                                        <div class=\"d-flex align-items-center\">
                                            <i class=\"fas fa-file-pdf text-danger me-2\"></i>
                                            <span>";
            // line 113
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 113, $this->source); })()), "fichierPdf", [], "any", false, false, false, 113), "html", null, true);
            yield "</span>
                                            <a href=\"";
            // line 114
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/exercices/" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 114, $this->source); })()), "fichierPdf", [], "any", false, false, false, 114))), "html", null, true);
            yield "\" class=\"btn btn-sm btn-outline-primary ms-2\" target=\"_blank\">
                                                <i class=\"fas fa-eye me-1\"></i>Voir
                                            </a>
                                        </div>
                                    </div>
                                ";
        }
        // line 120
        yield "                                <small class=\"text-muted\">Format accepté: PDF (max 5MB)</small>
                            </div>

                            <div class=\"d-flex justify-content-between align-items-center mt-4\">
                                <a href=\"";
        // line 124
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_exercice_list");
        yield "\" class=\"btn btn-outline-secondary\">
                                    <i class=\"fas fa-arrow-left me-2\"></i>Retour
                                </a>
                                <button class=\"btn btn-primary\" type=\"submit\">
                                    <i class=\"fas fa-save me-2\"></i>Enregistrer les modifications
                                </button>
                            </div>
                        ";
        // line 131
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 131, $this->source); })()), 'form_end');
        yield "
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-gradient-primary-to-secondary {
            background: linear-gradient(45deg, #0d6efd, #6610f2);
        }
        .form-label {
            font-weight: 500;
            color: #495057;
        }
        .form-control:focus, .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        .card {
            transition: all 0.3s ease;
        }
        .card:hover {
            box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
        }
        .btn {
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15);
        }
        .page-header {
            position: relative;
            overflow: hidden;
        }
        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.2);
            z-index: 1;
        }
        .page-header .container {
            position: relative;
            z-index: 2;
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
        return "exercice/edit.html.twig";
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
        return array (  277 => 131,  267 => 124,  261 => 120,  252 => 114,  248 => 113,  242 => 109,  240 => 108,  237 => 107,  235 => 103,  228 => 98,  226 => 90,  221 => 87,  219 => 78,  211 => 72,  209 => 68,  204 => 65,  202 => 61,  194 => 55,  192 => 51,  186 => 48,  183 => 47,  176 => 43,  172 => 41,  169 => 40,  162 => 36,  158 => 34,  156 => 33,  136 => 16,  132 => 15,  123 => 8,  110 => 7,  88 => 5,  65 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Modifier l'exercice{% endblock %}

{% block carousel %}{% endblock %}

{% block content %}
    <div class=\"container-fluid bg-primary py-5 mb-5 page-header\">
        <div class=\"container py-5\">
            <div class=\"row justify-content-center\">
                <div class=\"col-lg-10 text-center\">
                    <h1 class=\"display-3 text-white\">Modifier l'exercice</h1>
                    <nav aria-label=\"breadcrumb\">
                        <ol class=\"breadcrumb justify-content-center\">
                            <li class=\"breadcrumb-item\"><a class=\"text-white\" href=\"{{ path('app_home') }}\">Accueil</a></li>
                            <li class=\"breadcrumb-item\"><a class=\"text-white\" href=\"{{ path('app_exercice_list') }}\">Exercices</a></li>
                            <li class=\"breadcrumb-item text-white active\" aria-current=\"page\">Modifier</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class=\"container py-5\">
        <div class=\"row justify-content-center\">
            <div class=\"col-lg-8\">
                <div class=\"card shadow-lg border-0 rounded-lg\">
                    <div class=\"card-header bg-gradient-primary-to-secondary p-4\">
                        <h3 class=\"text-center font-weight-light my-2 text-white\">Modifier l'exercice</h3>
                    </div>
                    <div class=\"card-body\">
                        {% if app.session.flashBag.has('success') %}
                            <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                                <i class=\"fas fa-check-circle me-2\"></i>
                                {{ app.session.flashBag.get('success')[0] }}
                                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
                            </div>
                        {% endif %}
                        {% if app.session.flashBag.has('error') %}
                            <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                                <i class=\"fas fa-exclamation-circle me-2\"></i>
                                {{ app.session.flashBag.get('error')[0] }}
                                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
                            </div>
                        {% endif %}

                        {{ form_start(form, {'attr': {'class': 'needs-validation', 'novalidate': 'novalidate'}}) }}
                            <div class=\"row mb-3\">
                                <div class=\"col-12 mb-3\">
                                    {{ form_row(form.titre, {
                                        'label': 'Titre',
                                        'label_attr': {'class': 'form-label'},
                                        'attr': {'class': 'form-control', 'placeholder': 'Entrez le titre de l\\'exercice'}
                                    }) }}
                                </div>
                            </div>

                            <div class=\"row mb-3\">
                                <div class=\"col-md-6 mb-3\">
                                    {{ form_row(form.niveau_difficulte, {
                                        'label': 'Niveau de difficulté',
                                        'label_attr': {'class': 'form-label'},
                                        'attr': {'class': 'form-select'}
                                    }) }}
                                </div>
                                <div class=\"col-md-6 mb-3\">
                                    {{ form_row(form.type, {
                                        'label': 'Type d\\'exercice',
                                        'label_attr': {'class': 'form-label'},
                                        'attr': {'class': 'form-select'}
                                    }) }}
                                </div>
                            </div>

                            <div class=\"row mb-3\">
                                <div class=\"col-md-6 mb-3\">
                                    {{ form_row(form.note_minimale, {
                                        'label': 'Note minimale',
                                        'label_attr': {'class': 'form-label'},
                                        'attr': {
                                            'class': 'form-control',
                                            'min': 0,
                                            'max': 20,
                                            'step': 0.5
                                        }
                                    }) }}
                                </div>
                                <div class=\"col-md-6 mb-3\">
                                    {{ form_row(form.temps_estime, {
                                        'label': 'Temps estimé (minutes)',
                                        'label_attr': {'class': 'form-label'},
                                        'attr': {
                                            'class': 'form-control',
                                            'min': 1,
                                            'max': 480
                                        }
                                    }) }}
                                </div>
                            </div>

                            <div class=\"mb-4\">
                                {{ form_row(form.fichier_pdf, {
                                    'label': 'Fichier PDF',
                                    'label_attr': {'class': 'form-label'},
                                    'attr': {'class': 'form-control'}
                                }) }}
                                {% if exercice.fichierPdf %}
                                    <div class=\"mt-2\">
                                        <p class=\"mb-1\"><strong>Fichier actuel :</strong></p>
                                        <div class=\"d-flex align-items-center\">
                                            <i class=\"fas fa-file-pdf text-danger me-2\"></i>
                                            <span>{{ exercice.fichierPdf }}</span>
                                            <a href=\"{{ asset('uploads/exercices/' ~ exercice.fichierPdf) }}\" class=\"btn btn-sm btn-outline-primary ms-2\" target=\"_blank\">
                                                <i class=\"fas fa-eye me-1\"></i>Voir
                                            </a>
                                        </div>
                                    </div>
                                {% endif %}
                                <small class=\"text-muted\">Format accepté: PDF (max 5MB)</small>
                            </div>

                            <div class=\"d-flex justify-content-between align-items-center mt-4\">
                                <a href=\"{{ path('app_exercice_list') }}\" class=\"btn btn-outline-secondary\">
                                    <i class=\"fas fa-arrow-left me-2\"></i>Retour
                                </a>
                                <button class=\"btn btn-primary\" type=\"submit\">
                                    <i class=\"fas fa-save me-2\"></i>Enregistrer les modifications
                                </button>
                            </div>
                        {{ form_end(form) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-gradient-primary-to-secondary {
            background: linear-gradient(45deg, #0d6efd, #6610f2);
        }
        .form-label {
            font-weight: 500;
            color: #495057;
        }
        .form-control:focus, .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        .card {
            transition: all 0.3s ease;
        }
        .card:hover {
            box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
        }
        .btn {
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15);
        }
        .page-header {
            position: relative;
            overflow: hidden;
        }
        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.2);
            z-index: 1;
        }
        .page-header .container {
            position: relative;
            z-index: 2;
        }
    </style>
{% endblock %}
", "exercice/edit.html.twig", "C:\\Users\\maram\\pi_symfony_DevSphere1\\templates\\exercice\\edit.html.twig");
    }
}
