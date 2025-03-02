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

/* exercice/user_list.html.twig */
class __TwigTemplate_3dbacb8b90acba0208457be2aca8d868 extends Template
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
            'javascripts' => [$this, 'block_javascripts'],
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "exercice/user_list.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "exercice/user_list.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "exercice/user_list.html.twig", 1);
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

        yield "Liste des Exercices";
        
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
        yield "    <!-- Header -->
    <div class=\"container-fluid bg-primary py-5 mb-5 page-header\">
        <div class=\"container py-5\">
            <div class=\"row justify-content-center\">
                <div class=\"col-lg-10 text-center\">
                    <h1 class=\"display-3 text-white\">Exercices</h1>
                    <nav aria-label=\"breadcrumb\">
                        <ol class=\"breadcrumb justify-content-center\">
                            <li class=\"breadcrumb-item\"><a class=\"text-white\" href=\"";
        // line 16
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "\">Accueil</a></li>
                            <li class=\"breadcrumb-item text-white active\" aria-current=\"page\">Exercices</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class=\"container py-5\">
        <div class=\"row mb-4\">
            <div class=\"col-md-6\">
                <div class=\"input-group\">
                    <span class=\"input-group-text bg-primary text-white\"><i class=\"fas fa-search\"></i></span>
                    <input type=\"text\" id=\"searchInput\" class=\"form-control\" placeholder=\"Rechercher un exercice...\">
                </div>
            </div>
            <div class=\"col-md-6\">
                <div class=\"d-flex gap-2 justify-content-md-end\">
                    <select id=\"filterDifficulty\" class=\"form-select w-auto\">
                        <option value=\"\">Tous les niveaux</option>
                        <option value=\"facile\">Facile</option>
                        <option value=\"moyen\">Moyen</option>
                        <option value=\"difficile\">Difficile</option>
                    </select>
                    <select id=\"filterType\" class=\"form-select w-auto\">
                        <option value=\"\">Tous les types</option>
                        <option value=\"quiz\">Quiz</option>
                        <option value=\"pratique\">Pratique</option>
                        <option value=\"devoir\">Devoir</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Exercices Grid -->
        <div class=\"row g-4\">
            ";
        // line 54
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["exercices"]) || array_key_exists("exercices", $context) ? $context["exercices"] : (function () { throw new RuntimeError('Variable "exercices" does not exist.', 54, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["exercice"]) {
            // line 55
            yield "                <div class=\"col-lg-4 col-md-6 exercice-card\" 
                     data-difficulty=\"";
            // line 56
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "niveauDifficulte", [], "any", false, false, false, 56), "html", null, true);
            yield "\"
                     data-type=\"";
            // line 57
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "typeExercice", [], "any", false, false, false, 57), "html", null, true);
            yield "\">
                    <div class=\"card h-100 shadow-sm hover-elevate\">
                        <div class=\"card-header bg-light\">
                            <span class=\"badge ";
            // line 60
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "niveauDifficulte", [], "any", false, false, false, 60) == "facile")) {
                yield "bg-success";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "niveauDifficulte", [], "any", false, false, false, 60) == "moyen")) {
                yield "bg-warning";
            } else {
                yield "bg-danger";
            }
            yield " float-end\">
                                ";
            // line 61
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "niveauDifficulte", [], "any", false, false, false, 61)), "html", null, true);
            yield "
                            </span>
                            <h5 class=\"card-title mb-0\">";
            // line 63
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "titre", [], "any", false, false, false, 63), "html", null, true);
            yield "</h5>
                        </div>
                        <div class=\"card-body\">
                            <div class=\"mb-3\">
                                <small class=\"text-muted\">
                                    <i class=\"fas fa-clock me-1\"></i> ";
            // line 68
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "tempsEstime", [], "any", false, false, false, 68), "html", null, true);
            yield " minutes
                                    <span class=\"mx-2\">|</span>
                                    <i class=\"fas fa-star me-1\"></i> ";
            // line 70
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "noteMinimale", [], "any", false, false, false, 70), "html", null, true);
            yield "/20
                                    <span class=\"mx-2\">|</span>
                                    <i class=\"fas fa-tasks me-1\"></i> ";
            // line 72
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "typeExercice", [], "any", false, false, false, 72)), "html", null, true);
            yield "
                                </small>
                            </div>
                            ";
            // line 75
            if (CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "fichierPdf", [], "any", false, false, false, 75)) {
                // line 76
                yield "                                <div class=\"text-center mb-3\">
                                    <a href=\"";
                // line 77
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/exercices/" . CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "fichierPdf", [], "any", false, false, false, 77))), "html", null, true);
                yield "\" class=\"btn btn-outline-primary btn-sm\" target=\"_blank\">
                                        <i class=\"fas fa-file-pdf me-1\"></i> Voir le PDF
                                    </a>
                                </div>
                            ";
            }
            // line 82
            yield "                        </div>
                        <div class=\"card-footer bg-white border-top-0\">
                            <div class=\"d-flex justify-content-between align-items-center\">
                                <small class=\"text-muted\">
                                    <i class=\"fas fa-user me-1\"></i> ";
            // line 86
            yield ((CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "user", [], "any", false, false, false, 86)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "user", [], "any", false, false, false, 86), "prenom", [], "any", false, false, false, 86) . " ") . CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "user", [], "any", false, false, false, 86), "nom", [], "any", false, false, false, 86)), "html", null, true)) : ("N/A"));
            yield "
                                </small>
                                <a href=\"";
            // line 88
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_exercice_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "id", [], "any", false, false, false, 88)]), "html", null, true);
            yield "\" class=\"btn btn-primary btn-sm\">
                                    <i class=\"fas fa-eye me-1\"></i> Détails
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            ";
            $context['_iterated'] = true;
        }
        // line 101
        if (!$context['_iterated']) {
            // line 96
            yield "                <div class=\"col-12\">
                    <div class=\"alert alert-info text-center\">
                        <i class=\"fas fa-info-circle me-2\"></i>Aucun exercice disponible pour le moment.
                    </div>
                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['exercice'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 102
        yield "        </div>
    </div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 106
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        // line 107
        yield "    ";
        yield from $this->yieldParentBlock("javascripts", $context, $blocks);
        yield "
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const filterDifficulty = document.getElementById('filterDifficulty');
            const filterType = document.getElementById('filterType');
            const exerciceCards = document.querySelectorAll('.exercice-card');

            function filterExercices() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedDifficulty = filterDifficulty.value.toLowerCase();
                const selectedType = filterType.value.toLowerCase();

                exerciceCards.forEach(card => {
                    const title = card.querySelector('.card-title').textContent.toLowerCase();
                    const difficulty = card.dataset.difficulty.toLowerCase();
                    const type = card.dataset.type.toLowerCase();

                    const matchesSearch = title.includes(searchTerm);
                    const matchesDifficulty = !selectedDifficulty || difficulty === selectedDifficulty;
                    const matchesType = !selectedType || type === selectedType;

                    if (matchesSearch && matchesDifficulty && matchesType) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            searchInput.addEventListener('input', filterExercices);
            filterDifficulty.addEventListener('change', filterExercices);
            filterType.addEventListener('change', filterExercices);
        });
    </script>

    <style>
        .hover-elevate {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-elevate:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15)!important;
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
        .card {
            border: none;
            border-radius: 0.5rem;
        }
        .card-header {
            border-radius: 0.5rem 0.5rem 0 0 !important;
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
        return "exercice/user_list.html.twig";
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
        return array (  307 => 107,  294 => 106,  281 => 102,  270 => 96,  268 => 101,  256 => 88,  251 => 86,  245 => 82,  237 => 77,  234 => 76,  232 => 75,  226 => 72,  221 => 70,  216 => 68,  208 => 63,  203 => 61,  193 => 60,  187 => 57,  183 => 56,  180 => 55,  175 => 54,  134 => 16,  124 => 8,  111 => 7,  89 => 5,  66 => 3,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Liste des Exercices{% endblock %}

{% block carousel %}{% endblock %}

{% block content %}
    <!-- Header -->
    <div class=\"container-fluid bg-primary py-5 mb-5 page-header\">
        <div class=\"container py-5\">
            <div class=\"row justify-content-center\">
                <div class=\"col-lg-10 text-center\">
                    <h1 class=\"display-3 text-white\">Exercices</h1>
                    <nav aria-label=\"breadcrumb\">
                        <ol class=\"breadcrumb justify-content-center\">
                            <li class=\"breadcrumb-item\"><a class=\"text-white\" href=\"{{ path('app_home') }}\">Accueil</a></li>
                            <li class=\"breadcrumb-item text-white active\" aria-current=\"page\">Exercices</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class=\"container py-5\">
        <div class=\"row mb-4\">
            <div class=\"col-md-6\">
                <div class=\"input-group\">
                    <span class=\"input-group-text bg-primary text-white\"><i class=\"fas fa-search\"></i></span>
                    <input type=\"text\" id=\"searchInput\" class=\"form-control\" placeholder=\"Rechercher un exercice...\">
                </div>
            </div>
            <div class=\"col-md-6\">
                <div class=\"d-flex gap-2 justify-content-md-end\">
                    <select id=\"filterDifficulty\" class=\"form-select w-auto\">
                        <option value=\"\">Tous les niveaux</option>
                        <option value=\"facile\">Facile</option>
                        <option value=\"moyen\">Moyen</option>
                        <option value=\"difficile\">Difficile</option>
                    </select>
                    <select id=\"filterType\" class=\"form-select w-auto\">
                        <option value=\"\">Tous les types</option>
                        <option value=\"quiz\">Quiz</option>
                        <option value=\"pratique\">Pratique</option>
                        <option value=\"devoir\">Devoir</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Exercices Grid -->
        <div class=\"row g-4\">
            {% for exercice in exercices %}
                <div class=\"col-lg-4 col-md-6 exercice-card\" 
                     data-difficulty=\"{{ exercice.niveauDifficulte }}\"
                     data-type=\"{{ exercice.typeExercice }}\">
                    <div class=\"card h-100 shadow-sm hover-elevate\">
                        <div class=\"card-header bg-light\">
                            <span class=\"badge {% if exercice.niveauDifficulte == 'facile' %}bg-success{% elseif exercice.niveauDifficulte == 'moyen' %}bg-warning{% else %}bg-danger{% endif %} float-end\">
                                {{ exercice.niveauDifficulte|capitalize }}
                            </span>
                            <h5 class=\"card-title mb-0\">{{ exercice.titre }}</h5>
                        </div>
                        <div class=\"card-body\">
                            <div class=\"mb-3\">
                                <small class=\"text-muted\">
                                    <i class=\"fas fa-clock me-1\"></i> {{ exercice.tempsEstime }} minutes
                                    <span class=\"mx-2\">|</span>
                                    <i class=\"fas fa-star me-1\"></i> {{ exercice.noteMinimale }}/20
                                    <span class=\"mx-2\">|</span>
                                    <i class=\"fas fa-tasks me-1\"></i> {{ exercice.typeExercice|capitalize }}
                                </small>
                            </div>
                            {% if exercice.fichierPdf %}
                                <div class=\"text-center mb-3\">
                                    <a href=\"{{ asset('uploads/exercices/' ~ exercice.fichierPdf) }}\" class=\"btn btn-outline-primary btn-sm\" target=\"_blank\">
                                        <i class=\"fas fa-file-pdf me-1\"></i> Voir le PDF
                                    </a>
                                </div>
                            {% endif %}
                        </div>
                        <div class=\"card-footer bg-white border-top-0\">
                            <div class=\"d-flex justify-content-between align-items-center\">
                                <small class=\"text-muted\">
                                    <i class=\"fas fa-user me-1\"></i> {{ exercice.user ? exercice.user.prenom ~ ' ' ~ exercice.user.nom : 'N/A' }}
                                </small>
                                <a href=\"{{ path('app_exercice_show', {'id': exercice.id}) }}\" class=\"btn btn-primary btn-sm\">
                                    <i class=\"fas fa-eye me-1\"></i> Détails
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            {% else %}
                <div class=\"col-12\">
                    <div class=\"alert alert-info text-center\">
                        <i class=\"fas fa-info-circle me-2\"></i>Aucun exercice disponible pour le moment.
                    </div>
                </div>
            {% endfor %}
        </div>
    </div>
{% endblock %}

{% block javascripts %}
    {{ parent() }}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const filterDifficulty = document.getElementById('filterDifficulty');
            const filterType = document.getElementById('filterType');
            const exerciceCards = document.querySelectorAll('.exercice-card');

            function filterExercices() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedDifficulty = filterDifficulty.value.toLowerCase();
                const selectedType = filterType.value.toLowerCase();

                exerciceCards.forEach(card => {
                    const title = card.querySelector('.card-title').textContent.toLowerCase();
                    const difficulty = card.dataset.difficulty.toLowerCase();
                    const type = card.dataset.type.toLowerCase();

                    const matchesSearch = title.includes(searchTerm);
                    const matchesDifficulty = !selectedDifficulty || difficulty === selectedDifficulty;
                    const matchesType = !selectedType || type === selectedType;

                    if (matchesSearch && matchesDifficulty && matchesType) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            searchInput.addEventListener('input', filterExercices);
            filterDifficulty.addEventListener('change', filterExercices);
            filterType.addEventListener('change', filterExercices);
        });
    </script>

    <style>
        .hover-elevate {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-elevate:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15)!important;
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
        .card {
            border: none;
            border-radius: 0.5rem;
        }
        .card-header {
            border-radius: 0.5rem 0.5rem 0 0 !important;
        }
    </style>
{% endblock %}
", "exercice/user_list.html.twig", "C:\\Users\\maram\\pi_symfony_DevSphere1\\templates\\exercice\\user_list.html.twig");
    }
}
