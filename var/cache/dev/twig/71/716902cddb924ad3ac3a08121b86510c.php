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

/* tentative/mes_tentatives.html.twig */
class __TwigTemplate_e3d0116bbd6c94e70e3a250dada92040 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "tentative/mes_tentatives.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "tentative/mes_tentatives.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "tentative/mes_tentatives.html.twig", 1);
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

        yield "Mes Tentatives";
        
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
        <h1 class=\"mb-4\">Mes Tentatives</h1>

        ";
        // line 9
        if (Twig\Extension\CoreExtension::testEmpty((isset($context["tentatives"]) || array_key_exists("tentatives", $context) ? $context["tentatives"] : (function () { throw new RuntimeError('Variable "tentatives" does not exist.', 9, $this->source); })()))) {
            // line 10
            yield "            <div class=\"alert alert-info\">
                <i class=\"fas fa-info-circle me-2\"></i>
                Vous n'avez pas encore fait de tentatives.
            </div>
        ";
        } else {
            // line 15
            yield "            <div class=\"row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4\">
                ";
            // line 16
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["tentatives"]) || array_key_exists("tentatives", $context) ? $context["tentatives"] : (function () { throw new RuntimeError('Variable "tentatives" does not exist.', 16, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["tentative"]) {
                // line 17
                yield "                    <div class=\"col\">
                        <div class=\"card h-100 shadow-sm\">
                            <div class=\"card-header bg-white position-relative pt-4\">
                                <span class=\"badge position-absolute top-0 start-50 translate-middle 
                                    ";
                // line 21
                if ((CoreExtension::getAttribute($this->env, $this->source, $context["tentative"], "statue", [], "any", false, false, false, 21) == "reussi")) {
                    yield "bg-success
                                    ";
                } else {
                    // line 22
                    yield "bg-danger";
                }
                yield "\">
                                    ";
                // line 23
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["tentative"], "statue", [], "any", false, false, false, 23)), "html", null, true);
                yield "
                                </span>
                                <h5 class=\"card-title text-center mt-2\">";
                // line 25
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["tentative"], "exercice", [], "any", false, false, false, 25), "titre", [], "any", false, false, false, 25), "html", null, true);
                yield "</h5>
                            </div>
                            <div class=\"card-body\">
                                <div class=\"mb-3\">
                                    <small class=\"text-muted\">
                                        <i class=\"fas fa-calendar me-1\"></i>
                                        ";
                // line 31
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["tentative"], "date", [], "any", false, false, false, 31), "d/m/Y H:i"), "html", null, true);
                yield "
                                    </small>
                                </div>
                                <div class=\"score-display text-center mb-3\">
                                    <div class=\"display-4 text-";
                // line 35
                yield (((CoreExtension::getAttribute($this->env, $this->source, $context["tentative"], "score", [], "any", false, false, false, 35) >= CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["tentative"], "exercice", [], "any", false, false, false, 35), "noteMinimale", [], "any", false, false, false, 35))) ? ("success") : ("danger"));
                yield "\">
                                        ";
                // line 36
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tentative"], "score", [], "any", false, false, false, 36), "html", null, true);
                yield "/100
                                    </div>
                                    <small class=\"text-muted\">Note minimale requise: ";
                // line 38
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["tentative"], "exercice", [], "any", false, false, false, 38), "noteMinimale", [], "any", false, false, false, 38), "html", null, true);
                yield "/100</small>
                                </div>
                                <div class=\"reponse-section\">
                                    <h6>Ma réponse :</h6>
                                    <pre class=\"bg-light p-2 rounded\"><code>";
                // line 42
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tentative"], "reponse", [], "any", false, false, false, 42), "html", null, true);
                yield "</code></pre>
                                </div>
                            </div>
                            <div class=\"card-footer bg-white border-0\">
                                <a href=\"";
                // line 46
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_exercice_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["tentative"], "exercice", [], "any", false, false, false, 46), "id", [], "any", false, false, false, 46)]), "html", null, true);
                yield "\" 
                                   class=\"btn btn-primary w-100\">
                                    <i class=\"fas fa-redo me-1\"></i>
                                    Réessayer l'exercice
                                </a>
                            </div>
                        </div>
                    </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['tentative'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 55
            yield "            </div>
        ";
        }
        // line 57
        yield "    </div>

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
        return "tentative/mes_tentatives.html.twig";
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
        return array (  200 => 57,  196 => 55,  181 => 46,  174 => 42,  167 => 38,  162 => 36,  158 => 35,  151 => 31,  142 => 25,  137 => 23,  132 => 22,  127 => 21,  121 => 17,  117 => 16,  114 => 15,  107 => 10,  105 => 9,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Mes Tentatives{% endblock %}

{% block content %}
    <div class=\"container py-5\">
        <h1 class=\"mb-4\">Mes Tentatives</h1>

        {% if tentatives is empty %}
            <div class=\"alert alert-info\">
                <i class=\"fas fa-info-circle me-2\"></i>
                Vous n'avez pas encore fait de tentatives.
            </div>
        {% else %}
            <div class=\"row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4\">
                {% for tentative in tentatives %}
                    <div class=\"col\">
                        <div class=\"card h-100 shadow-sm\">
                            <div class=\"card-header bg-white position-relative pt-4\">
                                <span class=\"badge position-absolute top-0 start-50 translate-middle 
                                    {% if tentative.statue == 'reussi' %}bg-success
                                    {% else %}bg-danger{% endif %}\">
                                    {{ tentative.statue|capitalize }}
                                </span>
                                <h5 class=\"card-title text-center mt-2\">{{ tentative.exercice.titre }}</h5>
                            </div>
                            <div class=\"card-body\">
                                <div class=\"mb-3\">
                                    <small class=\"text-muted\">
                                        <i class=\"fas fa-calendar me-1\"></i>
                                        {{ tentative.date|date('d/m/Y H:i') }}
                                    </small>
                                </div>
                                <div class=\"score-display text-center mb-3\">
                                    <div class=\"display-4 text-{{ tentative.score >= tentative.exercice.noteMinimale ? 'success' : 'danger' }}\">
                                        {{ tentative.score }}/100
                                    </div>
                                    <small class=\"text-muted\">Note minimale requise: {{ tentative.exercice.noteMinimale }}/100</small>
                                </div>
                                <div class=\"reponse-section\">
                                    <h6>Ma réponse :</h6>
                                    <pre class=\"bg-light p-2 rounded\"><code>{{ tentative.reponse }}</code></pre>
                                </div>
                            </div>
                            <div class=\"card-footer bg-white border-0\">
                                <a href=\"{{ path('app_exercice_show', {'id': tentative.exercice.id}) }}\" 
                                   class=\"btn btn-primary w-100\">
                                    <i class=\"fas fa-redo me-1\"></i>
                                    Réessayer l'exercice
                                </a>
                            </div>
                        </div>
                    </div>
                {% endfor %}
            </div>
        {% endif %}
    </div>

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
", "tentative/mes_tentatives.html.twig", "C:\\Users\\maram\\pi_symfony_DevSphere1\\templates\\tentative\\mes_tentatives.html.twig");
    }
}
