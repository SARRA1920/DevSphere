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

/* admin/exercice/list.html.twig */
class __TwigTemplate_cc93134c2964f92396aef5b5a9103441 extends Template
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
        return "admin/base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/exercice/list.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/exercice/list.html.twig"));

        $this->parent = $this->loadTemplate("admin/base.html.twig", "admin/exercice/list.html.twig", 1);
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

        yield "Liste des exercices";
        
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
                    <h1 class=\"display-3 text-white animated slideInDown\">Liste des Exercices</h1>
                    <nav aria-label=\"breadcrumb animated slideInDown\">
                        <ol class=\"breadcrumb justify-content-center mb-4\">
                            <li class=\"breadcrumb-item\"><a href=\"";
        // line 15
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "\">Accueil</a></li>
                            <li class=\"breadcrumb-item active\" aria-current=\"page\">Exercices</li>
                        </ol>
                    </nav>
                    <a href=\"";
        // line 19
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_exercice_new");
        yield "\" class=\"btn btn-light btn-lg animated slideInUp\">
                        <i class=\"fas fa-plus-circle me-2\"></i>Ajouter un exercice
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class=\"container py-5\">
        ";
        // line 28
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 28, $this->source); })()), "flashes", [], "any", false, false, false, 28));
        foreach ($context['_seq'] as $context["label"] => $context["messages"]) {
            // line 29
            yield "            ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 30
                yield "                <div class=\"alert alert-";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"], "html", null, true);
                yield " alert-dismissible fade show\" role=\"alert\">
                    <i class=\"fas fa-";
                // line 31
                if (($context["label"] == "success")) {
                    yield "check-circle";
                } else {
                    yield "exclamation-circle";
                }
                yield " me-2\"></i>
                    ";
                // line 32
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
                yield "
                    <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
                </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 36
            yield "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['label'], $context['messages'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 37
        yield "
        <div class=\"row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4\">
            ";
        // line 39
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["exercices"]) || array_key_exists("exercices", $context) ? $context["exercices"] : (function () { throw new RuntimeError('Variable "exercices" does not exist.', 39, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["exercice"]) {
            // line 40
            yield "                <div class=\"col animated fadeIn\">
                    <div class=\"card h-100 shadow-sm hover-card\">
                        <div class=\"card-header bg-gradient-primary-to-secondary text-white p-3\">
                            <h5 class=\"card-title mb-0 text-truncate\">";
            // line 43
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "titre", [], "any", false, false, false, 43), "html", null, true);
            yield "</h5>
                        </div>
                        <div class=\"card-body\">
                            <div class=\"badge-container mb-3\">
                                <span class=\"badge ";
            // line 47
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "niveauDifficulte", [], "any", false, false, false, 47) == "facile")) {
                yield "bg-success";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "niveauDifficulte", [], "any", false, false, false, 47) == "moyen")) {
                yield "bg-warning";
            } else {
                yield "bg-danger";
            }
            yield " mb-2\">
                                    <i class=\"fas fa-layer-group me-1\"></i>";
            // line 48
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "niveauDifficulte", [], "any", false, false, false, 48)), "html", null, true);
            yield "
                                </span>
                                <span class=\"badge bg-info ms-2\">
                                    <i class=\"fas fa-tasks me-1\"></i>";
            // line 51
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "typeExercice", [], "any", false, false, false, 51)), "html", null, true);
            yield "
                                </span>
                            </div>
                            
                            <div class=\"info-item mb-2\">
                                <i class=\"fas fa-clock text-primary me-2\"></i>
                                <span>";
            // line 57
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "tempsEstime", [], "any", false, false, false, 57), "html", null, true);
            yield " minutes</span>
                            </div>
                            
                            <div class=\"info-item mb-3\">
                                <i class=\"fas fa-star text-primary me-2\"></i>
                                <span>Note minimale: ";
            // line 62
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "noteMinimale", [], "any", false, false, false, 62), "html", null, true);
            yield "/20</span>
                            </div>

                            ";
            // line 65
            if (CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "fichierPdf", [], "any", false, false, false, 65)) {
                // line 66
                yield "                                <div class=\"pdf-button mb-3\">
                                    <a href=\"";
                // line 67
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/exercices/" . CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "fichierPdf", [], "any", false, false, false, 67))), "html", null, true);
                yield "\" 
                                       class=\"btn btn-outline-primary btn-sm w-100\" 
                                       target=\"_blank\">
                                        <i class=\"fas fa-file-pdf me-1\"></i>Voir le PDF
                                    </a>
                                </div>
                            ";
            }
            // line 74
            yield "                        </div>
                        <div class=\"card-footer bg-transparent border-0 pt-0\">
                            <div class=\"d-flex justify-content-between align-items-center\">
                                <a href=\"";
            // line 77
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_exercice_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "id", [], "any", false, false, false, 77)]), "html", null, true);
            yield "\" 
                                   class=\"btn btn-primary btn-sm\">
                                    <i class=\"fas fa-eye me-1\"></i>Détails
                                </a>
                                <div class=\"btn-group\">
                                    <a href=\"";
            // line 82
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_exercice_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "id", [], "any", false, false, false, 82)]), "html", null, true);
            yield "\" 
                                       class=\"btn btn-warning btn-sm\">
                                        <i class=\"fas fa-edit me-1\"></i>Modifier
                                    </a>
                                    <form method=\"post\" 
                                          action=\"";
            // line 87
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_exercice_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "id", [], "any", false, false, false, 87)]), "html", null, true);
            yield "\" 
                                          class=\"d-inline\" 
                                          onsubmit=\"return confirm('Êtes-vous sûr de vouloir supprimer cet exercice ?');\">
                                        <input type=\"hidden\" name=\"_token\" value=\"";
            // line 90
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "id", [], "any", false, false, false, 90))), "html", null, true);
            yield "\">
                                        <button class=\"btn btn-danger btn-sm\">
                                            <i class=\"fas fa-trash me-1\"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ";
            $context['_iterated'] = true;
        }
        // line 106
        if (!$context['_iterated']) {
            // line 101
            yield "                <div class=\"col-12\">
                    <div class=\"alert alert-info text-center\" role=\"alert\">
                        <i class=\"fas fa-info-circle me-2\"></i>Aucun exercice n'a été trouvé.
                    </div>
                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['exercice'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 107
        yield "        </div>
    </div>

    <style>
        .bg-gradient-primary-to-secondary {
            background: linear-gradient(45deg, #0d6efd, #6610f2);
        }
        .page-header {
            position: relative;
            background-size: cover;
            background-position: center;
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
        .hover-card {
            transition: all 0.3s ease;
            border: none;
        }
        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 2rem rgba(0,0,0,0.15)!important;
        }
        .card-header {
            border-bottom: none;
        }
        .badge {
            padding: 0.5em 1em;
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        .info-item {
            font-size: 0.9rem;
            color: #6c757d;
            display: flex;
            align-items: center;
        }
        .btn {
            padding: 0.5rem 1rem;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.25rem 0.5rem rgba(0,0,0,0.1);
        }
        .btn-group .btn {
            margin-left: 0.25rem;
        }
        .pdf-button .btn {
            transition: all 0.3s ease;
        }
        .pdf-button .btn:hover {
            background-color: #0d6efd;
            color: white;
        }
        .breadcrumb {
            background: rgba(255, 255, 255, 0.1);
            padding: 0.75rem 1rem;
            border-radius: 2rem;
        }
        .breadcrumb-item a {
            color: white;
            text-decoration: none;
        }
        .breadcrumb-item.active {
            color: rgba(255, 255, 255, 0.8);
        }
        .animated {
            animation-duration: 1s;
            animation-fill-mode: both;
        }
        @keyframes slideInDown {
            from {
                transform: translate3d(0, -100%, 0);
                visibility: visible;
            }
            to {
                transform: translate3d(0, 0, 0);
            }
        }
        .slideInDown {
            animation-name: slideInDown;
        }
        @keyframes slideInUp {
            from {
                transform: translate3d(0, 100%, 0);
                visibility: visible;
            }
            to {
                transform: translate3d(0, 0, 0);
            }
        }
        .slideInUp {
            animation-name: slideInUp;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        .fadeIn {
            animation-name: fadeIn;
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
        return "admin/exercice/list.html.twig";
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
        return array (  319 => 107,  308 => 101,  306 => 106,  291 => 90,  285 => 87,  277 => 82,  269 => 77,  264 => 74,  254 => 67,  251 => 66,  249 => 65,  243 => 62,  235 => 57,  226 => 51,  220 => 48,  210 => 47,  203 => 43,  198 => 40,  193 => 39,  189 => 37,  183 => 36,  173 => 32,  165 => 31,  160 => 30,  155 => 29,  151 => 28,  139 => 19,  132 => 15,  123 => 8,  110 => 7,  88 => 5,  65 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'admin/base.html.twig' %}

{% block title %}Liste des exercices{% endblock %}

{% block carousel %}{% endblock %}

{% block content %}
    <div class=\"container-fluid bg-primary py-5 mb-5 page-header\">
        <div class=\"container py-5\">
            <div class=\"row justify-content-center\">
                <div class=\"col-lg-10 text-center\">
                    <h1 class=\"display-3 text-white animated slideInDown\">Liste des Exercices</h1>
                    <nav aria-label=\"breadcrumb animated slideInDown\">
                        <ol class=\"breadcrumb justify-content-center mb-4\">
                            <li class=\"breadcrumb-item\"><a href=\"{{ path('app_home') }}\">Accueil</a></li>
                            <li class=\"breadcrumb-item active\" aria-current=\"page\">Exercices</li>
                        </ol>
                    </nav>
                    <a href=\"{{ path('app_exercice_new') }}\" class=\"btn btn-light btn-lg animated slideInUp\">
                        <i class=\"fas fa-plus-circle me-2\"></i>Ajouter un exercice
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class=\"container py-5\">
        {% for label, messages in app.flashes %}
            {% for message in messages %}
                <div class=\"alert alert-{{ label }} alert-dismissible fade show\" role=\"alert\">
                    <i class=\"fas fa-{% if label == 'success' %}check-circle{% else %}exclamation-circle{% endif %} me-2\"></i>
                    {{ message }}
                    <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
                </div>
            {% endfor %}
        {% endfor %}

        <div class=\"row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4\">
            {% for exercice in exercices %}
                <div class=\"col animated fadeIn\">
                    <div class=\"card h-100 shadow-sm hover-card\">
                        <div class=\"card-header bg-gradient-primary-to-secondary text-white p-3\">
                            <h5 class=\"card-title mb-0 text-truncate\">{{ exercice.titre }}</h5>
                        </div>
                        <div class=\"card-body\">
                            <div class=\"badge-container mb-3\">
                                <span class=\"badge {% if exercice.niveauDifficulte == 'facile' %}bg-success{% elseif exercice.niveauDifficulte == 'moyen' %}bg-warning{% else %}bg-danger{% endif %} mb-2\">
                                    <i class=\"fas fa-layer-group me-1\"></i>{{ exercice.niveauDifficulte|capitalize }}
                                </span>
                                <span class=\"badge bg-info ms-2\">
                                    <i class=\"fas fa-tasks me-1\"></i>{{ exercice.typeExercice|capitalize }}
                                </span>
                            </div>
                            
                            <div class=\"info-item mb-2\">
                                <i class=\"fas fa-clock text-primary me-2\"></i>
                                <span>{{ exercice.tempsEstime }} minutes</span>
                            </div>
                            
                            <div class=\"info-item mb-3\">
                                <i class=\"fas fa-star text-primary me-2\"></i>
                                <span>Note minimale: {{ exercice.noteMinimale }}/20</span>
                            </div>

                            {% if exercice.fichierPdf %}
                                <div class=\"pdf-button mb-3\">
                                    <a href=\"{{ asset('uploads/exercices/' ~ exercice.fichierPdf) }}\" 
                                       class=\"btn btn-outline-primary btn-sm w-100\" 
                                       target=\"_blank\">
                                        <i class=\"fas fa-file-pdf me-1\"></i>Voir le PDF
                                    </a>
                                </div>
                            {% endif %}
                        </div>
                        <div class=\"card-footer bg-transparent border-0 pt-0\">
                            <div class=\"d-flex justify-content-between align-items-center\">
                                <a href=\"{{ path('app_exercice_show', {'id': exercice.id}) }}\" 
                                   class=\"btn btn-primary btn-sm\">
                                    <i class=\"fas fa-eye me-1\"></i>Détails
                                </a>
                                <div class=\"btn-group\">
                                    <a href=\"{{ path('app_exercice_edit', {'id': exercice.id}) }}\" 
                                       class=\"btn btn-warning btn-sm\">
                                        <i class=\"fas fa-edit me-1\"></i>Modifier
                                    </a>
                                    <form method=\"post\" 
                                          action=\"{{ path('app_exercice_delete', {'id': exercice.id}) }}\" 
                                          class=\"d-inline\" 
                                          onsubmit=\"return confirm('Êtes-vous sûr de vouloir supprimer cet exercice ?');\">
                                        <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete' ~ exercice.id) }}\">
                                        <button class=\"btn btn-danger btn-sm\">
                                            <i class=\"fas fa-trash me-1\"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {% else %}
                <div class=\"col-12\">
                    <div class=\"alert alert-info text-center\" role=\"alert\">
                        <i class=\"fas fa-info-circle me-2\"></i>Aucun exercice n'a été trouvé.
                    </div>
                </div>
            {% endfor %}
        </div>
    </div>

    <style>
        .bg-gradient-primary-to-secondary {
            background: linear-gradient(45deg, #0d6efd, #6610f2);
        }
        .page-header {
            position: relative;
            background-size: cover;
            background-position: center;
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
        .hover-card {
            transition: all 0.3s ease;
            border: none;
        }
        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 2rem rgba(0,0,0,0.15)!important;
        }
        .card-header {
            border-bottom: none;
        }
        .badge {
            padding: 0.5em 1em;
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        .info-item {
            font-size: 0.9rem;
            color: #6c757d;
            display: flex;
            align-items: center;
        }
        .btn {
            padding: 0.5rem 1rem;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.25rem 0.5rem rgba(0,0,0,0.1);
        }
        .btn-group .btn {
            margin-left: 0.25rem;
        }
        .pdf-button .btn {
            transition: all 0.3s ease;
        }
        .pdf-button .btn:hover {
            background-color: #0d6efd;
            color: white;
        }
        .breadcrumb {
            background: rgba(255, 255, 255, 0.1);
            padding: 0.75rem 1rem;
            border-radius: 2rem;
        }
        .breadcrumb-item a {
            color: white;
            text-decoration: none;
        }
        .breadcrumb-item.active {
            color: rgba(255, 255, 255, 0.8);
        }
        .animated {
            animation-duration: 1s;
            animation-fill-mode: both;
        }
        @keyframes slideInDown {
            from {
                transform: translate3d(0, -100%, 0);
                visibility: visible;
            }
            to {
                transform: translate3d(0, 0, 0);
            }
        }
        .slideInDown {
            animation-name: slideInDown;
        }
        @keyframes slideInUp {
            from {
                transform: translate3d(0, 100%, 0);
                visibility: visible;
            }
            to {
                transform: translate3d(0, 0, 0);
            }
        }
        .slideInUp {
            animation-name: slideInUp;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        .fadeIn {
            animation-name: fadeIn;
        }
    </style>
{% endblock %}
", "admin/exercice/list.html.twig", "C:\\Users\\maram\\pi_symfony_DevSphere1\\templates\\admin\\exercice\\list.html.twig");
    }
}
