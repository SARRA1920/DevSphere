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

/* exercice/list.html.twig */
class __TwigTemplate_38d14e9634d520d5c03abaa1f28e41a9 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "exercice/list.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "exercice/list.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "exercice/list.html.twig", 1);
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

        yield "Exercices Disponibles";
        
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
        yield "    <!-- Header Section -->
    <div class=\"container-fluid bg-primary py-5 mb-5 page-header\">
        <div class=\"container py-5\">
            <div class=\"row justify-content-center\">
                <div class=\"col-lg-10 text-center\">
                    <h1 class=\"display-3 text-white animated slideInDown\">Exercices Disponibles</h1>
                    <nav aria-label=\"breadcrumb\">
                        <ol class=\"breadcrumb justify-content-center\">
                            <li class=\"breadcrumb-item\"><a class=\"text-white\" href=\"";
        // line 14
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "\">Accueil</a></li>
                            <li class=\"breadcrumb-item text-white active\">Exercices</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class=\"container py-5\">
        <!-- Filter Section -->
        <div class=\"row mb-4\">
            <div class=\"col-md-6 mx-auto\">
                <div class=\"filter-box bg-light p-4 rounded-lg shadow-sm\">
                    <h5 class=\"text-center mb-3\">Filtrer par niveau</h5>
                    <select class=\"form-select\" id=\"difficultyFilter\">
                        <option value=\"all\">Tous les niveaux</option>
                        <option value=\"facile\">Facile</option>
                        <option value=\"moyen\">Moyen</option>
                        <option value=\"difficile\">Difficile</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Exercises Grid -->
        <div class=\"row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4\">
            ";
        // line 41
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["exercices"]) || array_key_exists("exercices", $context) ? $context["exercices"] : (function () { throw new RuntimeError('Variable "exercices" does not exist.', 41, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["exercice"]) {
            // line 42
            yield "                <div class=\"col exercise-card\" data-difficulty=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "niveauDifficulte", [], "any", false, false, false, 42), "html", null, true);
            yield "\">
                    <div class=\"card h-100 border-0 shadow-sm hover-card animated fadeIn\">
                        <!-- Card Header with Difficulty Badge -->
                        <div class=\"card-header border-0 bg-white position-relative pt-4 pb-0\">
                            <span class=\"badge position-absolute top-0 start-50 translate-middle 
                                ";
            // line 47
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "niveauDifficulte", [], "any", false, false, false, 47) == "facile")) {
                yield "bg-success
                                ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 48
$context["exercice"], "niveauDifficulte", [], "any", false, false, false, 48) == "moyen")) {
                yield "bg-warning
                                ";
            } else {
                // line 49
                yield "bg-danger";
            }
            yield "\">
                                ";
            // line 50
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "niveauDifficulte", [], "any", false, false, false, 50)), "html", null, true);
            yield "
                            </span>
                            <h5 class=\"card-title text-center mt-2\">";
            // line 52
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "titre", [], "any", false, false, false, 52), "html", null, true);
            yield "</h5>
                        </div>

                        <!-- Card Body -->
                        <div class=\"card-body\">
                            <!-- Exercise Type -->
                            <div class=\"mb-3 text-center\">
                                <span class=\"badge bg-info\">
                                    <i class=\"fas fa-code me-1\"></i>";
            // line 60
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "typeExercice", [], "any", false, false, false, 60), "html", null, true);
            yield "
                                </span>
                            </div>

                            <!-- Exercise Info -->
                            <div class=\"info-list\">
                                <div class=\"info-item\">
                                    <i class=\"fas fa-clock text-primary\"></i>
                                    <span>";
            // line 68
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "tempsEstime", [], "any", false, false, false, 68), "html", null, true);
            yield " minutes</span>
                                </div>
                                <div class=\"info-item\">
                                    <i class=\"fas fa-star text-warning\"></i>
                                    <span>Note minimale: ";
            // line 72
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "noteMinimale", [], "any", false, false, false, 72), "html", null, true);
            yield "/20</span>
                                </div>
                            </div>

                            <!-- PDF Link if available -->
                            ";
            // line 77
            if (CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "fichierPdf", [], "any", false, false, false, 77)) {
                // line 78
                yield "                                <div class=\"text-center mt-3\">
                                    <a href=\"";
                // line 79
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/exercices/" . CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "fichierPdf", [], "any", false, false, false, 79))), "html", null, true);
                yield "\" 
                                       class=\"btn btn-outline-primary btn-sm\" 
                                       target=\"_blank\">
                                        <i class=\"fas fa-file-pdf me-1\"></i>Voir l'énoncé
                                    </a>
                                </div>
                            ";
            }
            // line 86
            yield "                        </div>

                        <!-- Card Footer -->
                        <div class=\"card-footer border-0 bg-white text-center pb-4\">
                            <a href=\"";
            // line 90
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_exercice_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "id", [], "any", false, false, false, 90)]), "html", null, true);
            yield "\" 
                               class=\"btn btn-primary\">
                                Commencer l'exercice
                                <i class=\"fas fa-arrow-right ms-1\"></i>
                            </a>
                        </div>
                    </div>
                </div>
            ";
            $context['_iterated'] = true;
        }
        // line 105
        if (!$context['_iterated']) {
            // line 99
            yield "                <div class=\"col-12\">
                    <div class=\"alert alert-info text-center\" role=\"alert\">
                        <i class=\"fas fa-info-circle me-2\"></i>
                        Aucun exercice n'est disponible pour le moment.
                    </div>
                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['exercice'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 106
        yield "        </div>
    </div>

    <style>
        .page-header {
            background: linear-gradient(rgba(24, 29, 56, .7), rgba(24, 29, 56, .7)), url('";
        // line 111
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/header-bg.jpg"), "html", null, true);
        yield "');
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        
        .hover-card {
            transition: all 0.3s ease;
        }
        
        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15)!important;
        }
        
        .filter-box {
            border-radius: 15px;
        }
        
        .info-list {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            color: #6c757d;
        }
        
        .badge {
            padding: 0.5em 1em;
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        
        .animated {
            animation-duration: 1s;
            animation-fill-mode: both;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fadeIn {
            animation-name: fadeIn;
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

        /* Add filter functionality */
        .exercise-card {
            transition: all 0.3s ease;
        }
        
        .exercise-card.hidden {
            display: none;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const difficultyFilter = document.getElementById('difficultyFilter');
            const exerciseCards = document.querySelectorAll('.exercise-card');

            difficultyFilter.addEventListener('change', function() {
                const selectedDifficulty = this.value;
                
                exerciseCards.forEach(card => {
                    const cardDifficulty = card.dataset.difficulty;
                    
                    if (selectedDifficulty === 'all' || selectedDifficulty === cardDifficulty) {
                        card.classList.remove('hidden');
                    } else {
                        card.classList.add('hidden');
                    }
                });
            });
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
        return "exercice/list.html.twig";
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
        return array (  265 => 111,  258 => 106,  246 => 99,  244 => 105,  231 => 90,  225 => 86,  215 => 79,  212 => 78,  210 => 77,  202 => 72,  195 => 68,  184 => 60,  173 => 52,  168 => 50,  163 => 49,  158 => 48,  154 => 47,  145 => 42,  140 => 41,  110 => 14,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Exercices Disponibles{% endblock %}

{% block content %}
    <!-- Header Section -->
    <div class=\"container-fluid bg-primary py-5 mb-5 page-header\">
        <div class=\"container py-5\">
            <div class=\"row justify-content-center\">
                <div class=\"col-lg-10 text-center\">
                    <h1 class=\"display-3 text-white animated slideInDown\">Exercices Disponibles</h1>
                    <nav aria-label=\"breadcrumb\">
                        <ol class=\"breadcrumb justify-content-center\">
                            <li class=\"breadcrumb-item\"><a class=\"text-white\" href=\"{{ path('app_home') }}\">Accueil</a></li>
                            <li class=\"breadcrumb-item text-white active\">Exercices</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class=\"container py-5\">
        <!-- Filter Section -->
        <div class=\"row mb-4\">
            <div class=\"col-md-6 mx-auto\">
                <div class=\"filter-box bg-light p-4 rounded-lg shadow-sm\">
                    <h5 class=\"text-center mb-3\">Filtrer par niveau</h5>
                    <select class=\"form-select\" id=\"difficultyFilter\">
                        <option value=\"all\">Tous les niveaux</option>
                        <option value=\"facile\">Facile</option>
                        <option value=\"moyen\">Moyen</option>
                        <option value=\"difficile\">Difficile</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Exercises Grid -->
        <div class=\"row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4\">
            {% for exercice in exercices %}
                <div class=\"col exercise-card\" data-difficulty=\"{{ exercice.niveauDifficulte }}\">
                    <div class=\"card h-100 border-0 shadow-sm hover-card animated fadeIn\">
                        <!-- Card Header with Difficulty Badge -->
                        <div class=\"card-header border-0 bg-white position-relative pt-4 pb-0\">
                            <span class=\"badge position-absolute top-0 start-50 translate-middle 
                                {% if exercice.niveauDifficulte == 'facile' %}bg-success
                                {% elseif exercice.niveauDifficulte == 'moyen' %}bg-warning
                                {% else %}bg-danger{% endif %}\">
                                {{ exercice.niveauDifficulte|capitalize }}
                            </span>
                            <h5 class=\"card-title text-center mt-2\">{{ exercice.titre }}</h5>
                        </div>

                        <!-- Card Body -->
                        <div class=\"card-body\">
                            <!-- Exercise Type -->
                            <div class=\"mb-3 text-center\">
                                <span class=\"badge bg-info\">
                                    <i class=\"fas fa-code me-1\"></i>{{ exercice.typeExercice }}
                                </span>
                            </div>

                            <!-- Exercise Info -->
                            <div class=\"info-list\">
                                <div class=\"info-item\">
                                    <i class=\"fas fa-clock text-primary\"></i>
                                    <span>{{ exercice.tempsEstime }} minutes</span>
                                </div>
                                <div class=\"info-item\">
                                    <i class=\"fas fa-star text-warning\"></i>
                                    <span>Note minimale: {{ exercice.noteMinimale }}/20</span>
                                </div>
                            </div>

                            <!-- PDF Link if available -->
                            {% if exercice.fichierPdf %}
                                <div class=\"text-center mt-3\">
                                    <a href=\"{{ asset('uploads/exercices/' ~ exercice.fichierPdf) }}\" 
                                       class=\"btn btn-outline-primary btn-sm\" 
                                       target=\"_blank\">
                                        <i class=\"fas fa-file-pdf me-1\"></i>Voir l'énoncé
                                    </a>
                                </div>
                            {% endif %}
                        </div>

                        <!-- Card Footer -->
                        <div class=\"card-footer border-0 bg-white text-center pb-4\">
                            <a href=\"{{ path('app_exercice_show', {'id': exercice.id}) }}\" 
                               class=\"btn btn-primary\">
                                Commencer l'exercice
                                <i class=\"fas fa-arrow-right ms-1\"></i>
                            </a>
                        </div>
                    </div>
                </div>
            {% else %}
                <div class=\"col-12\">
                    <div class=\"alert alert-info text-center\" role=\"alert\">
                        <i class=\"fas fa-info-circle me-2\"></i>
                        Aucun exercice n'est disponible pour le moment.
                    </div>
                </div>
            {% endfor %}
        </div>
    </div>

    <style>
        .page-header {
            background: linear-gradient(rgba(24, 29, 56, .7), rgba(24, 29, 56, .7)), url('{{ asset('images/header-bg.jpg') }}');
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        
        .hover-card {
            transition: all 0.3s ease;
        }
        
        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15)!important;
        }
        
        .filter-box {
            border-radius: 15px;
        }
        
        .info-list {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            color: #6c757d;
        }
        
        .badge {
            padding: 0.5em 1em;
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        
        .animated {
            animation-duration: 1s;
            animation-fill-mode: both;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fadeIn {
            animation-name: fadeIn;
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

        /* Add filter functionality */
        .exercise-card {
            transition: all 0.3s ease;
        }
        
        .exercise-card.hidden {
            display: none;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const difficultyFilter = document.getElementById('difficultyFilter');
            const exerciseCards = document.querySelectorAll('.exercise-card');

            difficultyFilter.addEventListener('change', function() {
                const selectedDifficulty = this.value;
                
                exerciseCards.forEach(card => {
                    const cardDifficulty = card.dataset.difficulty;
                    
                    if (selectedDifficulty === 'all' || selectedDifficulty === cardDifficulty) {
                        card.classList.remove('hidden');
                    } else {
                        card.classList.add('hidden');
                    }
                });
            });
        });
    </script>
{% endblock %}
", "exercice/list.html.twig", "C:\\Users\\maram\\pi_symfony_DevSphere1\\templates\\exercice\\list.html.twig");
    }
}
