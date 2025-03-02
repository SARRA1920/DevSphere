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

/* tentative/exercice_tentatives.html.twig */
class __TwigTemplate_12f2caa4ef85aa9e8636d0a5fee84eaa extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "tentative/exercice_tentatives.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "tentative/exercice_tentatives.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "tentative/exercice_tentatives.html.twig", 1);
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

        yield "Tentatives pour ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 3, $this->source); })()), "titre", [], "any", false, false, false, 3), "html", null, true);
        
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
        yield "    <div class=\"container py-5\">
        <div class=\"row mb-4\">
            <div class=\"col\">
                <h1>Tentatives pour l'exercice : ";
        // line 9
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 9, $this->source); })()), "titre", [], "any", false, false, false, 9), "html", null, true);
        yield "</h1>
                <p class=\"text-muted\">
                    <i class=\"fas fa-info-circle me-1\"></i>
                    Note minimale requise : ";
        // line 12
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 12, $this->source); })()), "noteMinimale", [], "any", false, false, false, 12), "html", null, true);
        yield "/100
                </p>
            </div>
        </div>

        ";
        // line 17
        if (Twig\Extension\CoreExtension::testEmpty((isset($context["tentatives"]) || array_key_exists("tentatives", $context) ? $context["tentatives"] : (function () { throw new RuntimeError('Variable "tentatives" does not exist.', 17, $this->source); })()))) {
            // line 18
            yield "            <div class=\"alert alert-info\">
                <i class=\"fas fa-info-circle me-2\"></i>
                Vous n'avez pas encore fait de tentatives pour cet exercice.
            </div>
            
            <div class=\"text-center mt-4\">
                <a href=\"";
            // line 24
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_exercice_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 24, $this->source); })()), "id", [], "any", false, false, false, 24)]), "html", null, true);
            yield "\" class=\"btn btn-primary btn-lg\">
                    <i class=\"fas fa-play me-1\"></i>
                    Commencer l'exercice
                </a>
            </div>
        ";
        } else {
            // line 30
            yield "            <!-- Progress Chart -->
            <div class=\"card mb-4\">
                <div class=\"card-body\">
                    <h5 class=\"card-title\">Progression</h5>
                    <canvas id=\"progressChart\"></canvas>
                </div>
            </div>

            <!-- Attempts List -->
            <div class=\"row\">
                ";
            // line 40
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["tentatives"]) || array_key_exists("tentatives", $context) ? $context["tentatives"] : (function () { throw new RuntimeError('Variable "tentatives" does not exist.', 40, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["tentative"]) {
                // line 41
                yield "                    <div class=\"col-md-6 mb-4\">
                        <div class=\"card h-100 shadow-sm\">
                            <div class=\"card-header d-flex justify-content-between align-items-center\">
                                <span class=\"badge ";
                // line 44
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["tentative"], "statue", [], "any", false, false, false, 44) == "reussi")) {
                    yield "bg-success";
                } else {
                    yield "bg-danger";
                }
                yield "\">
                                    ";
                // line 45
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["tentative"], "statue", [], "any", false, false, false, 45)), "html", null, true);
                yield "
                                </span>
                                <small class=\"text-muted\">
                                    ";
                // line 48
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["tentative"], "date", [], "any", false, false, false, 48), "d/m/Y H:i"), "html", null, true);
                yield "
                                </small>
                            </div>
                            <div class=\"card-body\">
                                <div class=\"score-display text-center mb-3\">
                                    <div class=\"display-4 text-";
                // line 53
                yield (((CoreExtension::getAttribute($this->env, $this->source, $context["tentative"], "score", [], "any", false, false, false, 53) >= CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 53, $this->source); })()), "noteMinimale", [], "any", false, false, false, 53))) ? ("success") : ("danger"));
                yield "\">
                                        ";
                // line 54
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tentative"], "score", [], "any", false, false, false, 54), "html", null, true);
                yield "/100
                                    </div>
                                </div>
                                <div class=\"reponse-section\">
                                    <h6>Réponse soumise :</h6>
                                    <pre class=\"bg-light p-2 rounded\"><code>";
                // line 59
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tentative"], "reponse", [], "any", false, false, false, 59), "html", null, true);
                yield "</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['tentative'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 65
            yield "            </div>

            <div class=\"text-center mt-4\">
                <a href=\"";
            // line 68
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_exercice_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 68, $this->source); })()), "id", [], "any", false, false, false, 68)]), "html", null, true);
            yield "\" class=\"btn btn-primary\">
                    <i class=\"fas fa-redo me-1\"></i>
                    Réessayer l'exercice
                </a>
            </div>
        ";
        }
        // line 74
        yield "    </div>

    ";
        // line 76
        if ( !Twig\Extension\CoreExtension::testEmpty((isset($context["tentatives"]) || array_key_exists("tentatives", $context) ? $context["tentatives"] : (function () { throw new RuntimeError('Variable "tentatives" does not exist.', 76, $this->source); })()))) {
            // line 77
            yield "        <script src=\"https://cdn.jsdelivr.net/npm/chart.js\"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('progressChart').getContext('2d');
                const scores = ";
            // line 81
            yield json_encode(Twig\Extension\CoreExtension::map($this->env, (isset($context["tentatives"]) || array_key_exists("tentatives", $context) ? $context["tentatives"] : (function () { throw new RuntimeError('Variable "tentatives" does not exist.', 81, $this->source); })()), function ($__t__) use ($context, $macros) { $context["t"] = $__t__; return CoreExtension::getAttribute($this->env, $this->source, (isset($context["t"]) || array_key_exists("t", $context) ? $context["t"] : (function () { throw new RuntimeError('Variable "t" does not exist.', 81, $this->source); })()), "score", [], "any", false, false, false, 81); }));
            yield ";
                const dates = ";
            // line 82
            yield json_encode(Twig\Extension\CoreExtension::map($this->env, (isset($context["tentatives"]) || array_key_exists("tentatives", $context) ? $context["tentatives"] : (function () { throw new RuntimeError('Variable "tentatives" does not exist.', 82, $this->source); })()), function ($__t__) use ($context, $macros) { $context["t"] = $__t__; return $this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["t"]) || array_key_exists("t", $context) ? $context["t"] : (function () { throw new RuntimeError('Variable "t" does not exist.', 82, $this->source); })()), "date", [], "any", false, false, false, 82), "d/m/Y H:i"); }));
            yield ";
                
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: dates.reverse(),
                        datasets: [{
                            label: 'Score',
                            data: scores.reverse(),
                            borderColor: 'rgb(75, 192, 192)',
                            tension: 0.1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 100
                            }
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: 'Évolution des scores'
                            }
                        }
                    }
                });
            });
        </script>
    ";
        }
        // line 114
        yield "
    <style>
        .score-display {
            padding: 1rem;
            border-radius: 0.5rem;
            background-color: #f8f9fa;
        }
        
        .card {
            transition: transform 0.2s;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        pre {
            max-height: 150px;
            overflow-y: auto;
        }
        
        .badge {
            padding: 0.5em 1em;
            font-size: 0.875rem;
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
        return "tentative/exercice_tentatives.html.twig";
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
        return array (  271 => 114,  236 => 82,  232 => 81,  226 => 77,  224 => 76,  220 => 74,  211 => 68,  206 => 65,  194 => 59,  186 => 54,  182 => 53,  174 => 48,  168 => 45,  160 => 44,  155 => 41,  151 => 40,  139 => 30,  130 => 24,  122 => 18,  120 => 17,  112 => 12,  106 => 9,  101 => 6,  88 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Tentatives pour {{ exercice.titre }}{% endblock %}

{% block content %}
    <div class=\"container py-5\">
        <div class=\"row mb-4\">
            <div class=\"col\">
                <h1>Tentatives pour l'exercice : {{ exercice.titre }}</h1>
                <p class=\"text-muted\">
                    <i class=\"fas fa-info-circle me-1\"></i>
                    Note minimale requise : {{ exercice.noteMinimale }}/100
                </p>
            </div>
        </div>

        {% if tentatives is empty %}
            <div class=\"alert alert-info\">
                <i class=\"fas fa-info-circle me-2\"></i>
                Vous n'avez pas encore fait de tentatives pour cet exercice.
            </div>
            
            <div class=\"text-center mt-4\">
                <a href=\"{{ path('app_exercice_show', {'id': exercice.id}) }}\" class=\"btn btn-primary btn-lg\">
                    <i class=\"fas fa-play me-1\"></i>
                    Commencer l'exercice
                </a>
            </div>
        {% else %}
            <!-- Progress Chart -->
            <div class=\"card mb-4\">
                <div class=\"card-body\">
                    <h5 class=\"card-title\">Progression</h5>
                    <canvas id=\"progressChart\"></canvas>
                </div>
            </div>

            <!-- Attempts List -->
            <div class=\"row\">
                {% for tentative in tentatives %}
                    <div class=\"col-md-6 mb-4\">
                        <div class=\"card h-100 shadow-sm\">
                            <div class=\"card-header d-flex justify-content-between align-items-center\">
                                <span class=\"badge {% if tentative.statue == 'reussi' %}bg-success{% else %}bg-danger{% endif %}\">
                                    {{ tentative.statue|capitalize }}
                                </span>
                                <small class=\"text-muted\">
                                    {{ tentative.date|date('d/m/Y H:i') }}
                                </small>
                            </div>
                            <div class=\"card-body\">
                                <div class=\"score-display text-center mb-3\">
                                    <div class=\"display-4 text-{{ tentative.score >= exercice.noteMinimale ? 'success' : 'danger' }}\">
                                        {{ tentative.score }}/100
                                    </div>
                                </div>
                                <div class=\"reponse-section\">
                                    <h6>Réponse soumise :</h6>
                                    <pre class=\"bg-light p-2 rounded\"><code>{{ tentative.reponse }}</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                {% endfor %}
            </div>

            <div class=\"text-center mt-4\">
                <a href=\"{{ path('app_exercice_show', {'id': exercice.id}) }}\" class=\"btn btn-primary\">
                    <i class=\"fas fa-redo me-1\"></i>
                    Réessayer l'exercice
                </a>
            </div>
        {% endif %}
    </div>

    {% if tentatives is not empty %}
        <script src=\"https://cdn.jsdelivr.net/npm/chart.js\"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('progressChart').getContext('2d');
                const scores = {{ tentatives|map(t => t.score)|json_encode|raw }};
                const dates = {{ tentatives|map(t => t.date|date('d/m/Y H:i'))|json_encode|raw }};
                
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: dates.reverse(),
                        datasets: [{
                            label: 'Score',
                            data: scores.reverse(),
                            borderColor: 'rgb(75, 192, 192)',
                            tension: 0.1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 100
                            }
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: 'Évolution des scores'
                            }
                        }
                    }
                });
            });
        </script>
    {% endif %}

    <style>
        .score-display {
            padding: 1rem;
            border-radius: 0.5rem;
            background-color: #f8f9fa;
        }
        
        .card {
            transition: transform 0.2s;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        pre {
            max-height: 150px;
            overflow-y: auto;
        }
        
        .badge {
            padding: 0.5em 1em;
            font-size: 0.875rem;
        }
    </style>
{% endblock %}
", "tentative/exercice_tentatives.html.twig", "C:\\Users\\maram\\pi_symfony_DevSphere1\\templates\\tentative\\exercice_tentatives.html.twig");
    }
}
