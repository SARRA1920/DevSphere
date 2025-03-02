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

/* exercice/recommendations.html.twig */
class __TwigTemplate_be6c2646d541a868e235f7aaeb60b3e6 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "exercice/recommendations.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "exercice/recommendations.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "exercice/recommendations.html.twig", 1);
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

        yield "Exercices Recommandés";
        
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
        yield "<div class=\"container py-5\">
    <h1 class=\"mb-4\">Exercices Recommandés pour Vous</h1>
    
    <div class=\"row mb-4\">
        <div class=\"col-md-12\">
            <div class=\"card\">
                <div class=\"card-header bg-primary text-white\">
                    <h3 class=\"mb-0\">Recommandations Personnalisées</h3>
                </div>
                <div class=\"card-body\">
                    <p class=\"lead\">
                        Ces exercices sont recommandés en fonction de vos performances passées et de vos préférences.
                    </p>
                    
                    ";
        // line 20
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 20, $this->source); })()), "flashes", ["error"], "method", false, false, false, 20));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 21
            yield "                        <div class=\"alert alert-danger mb-4\">
                            ";
            // line 22
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "
                        </div>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 25
        yield "                    
                    ";
        // line 26
        if (array_key_exists("error", $context)) {
            // line 27
            yield "                        <div class=\"alert alert-danger mb-4\">
                            <h5 class=\"alert-heading\">Erreur technique</h5>
                            <p>";
            // line 29
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 29, $this->source); })()), "html", null, true);
            yield "</p>
                            <hr>
                            <p class=\"mb-0\">Veuillez réessayer plus tard ou contacter l'administrateur si le problème persiste.</p>
                        </div>
                    ";
        }
        // line 34
        yield "                    
                    <div class=\"row\">
                        ";
        // line 36
        if ((array_key_exists("recommendations", $context) && (Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["recommendations"]) || array_key_exists("recommendations", $context) ? $context["recommendations"] : (function () { throw new RuntimeError('Variable "recommendations" does not exist.', 36, $this->source); })())) > 0))) {
            // line 37
            yield "                            ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["recommendations"]) || array_key_exists("recommendations", $context) ? $context["recommendations"] : (function () { throw new RuntimeError('Variable "recommendations" does not exist.', 37, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["rec"]) {
                // line 38
                yield "                                ";
                if ( !(null === CoreExtension::getAttribute($this->env, $this->source, $context["rec"], "exercice", [], "any", false, false, false, 38))) {
                    // line 39
                    yield "                                    <div class=\"col-md-6 col-lg-4 mb-4\">
                                        <div class=\"card h-100 border-";
                    // line 40
                    yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["rec"], "exercice", [], "any", false, false, false, 40), "noteMinimale", [], "any", false, false, false, 40) < 8)) ? ("success") : ((((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["rec"], "exercice", [], "any", false, false, false, 40), "noteMinimale", [], "any", false, false, false, 40) < 14)) ? ("warning") : ("danger"))));
                    yield "\">
                                            <div class=\"card-header bg-";
                    // line 41
                    yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["rec"], "exercice", [], "any", false, false, false, 41), "noteMinimale", [], "any", false, false, false, 41) < 8)) ? ("success") : ((((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["rec"], "exercice", [], "any", false, false, false, 41), "noteMinimale", [], "any", false, false, false, 41) < 14)) ? ("warning") : ("danger"))));
                    yield " text-white d-flex justify-content-between align-items-center\">
                                                <h5 class=\"mb-0\">";
                    // line 42
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["rec"], "exercice", [], "any", false, false, false, 42), "titre", [], "any", false, false, false, 42), "html", null, true);
                    yield "</h5>
                                                <span class=\"badge bg-light text-dark\">
                                                    ";
                    // line 44
                    if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["rec"], "exercice", [], "any", false, false, false, 44), "noteMinimale", [], "any", false, false, false, 44) < 8)) {
                        // line 45
                        yield "                                                        Facile
                                                    ";
                    } elseif ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,                     // line 46
$context["rec"], "exercice", [], "any", false, false, false, 46), "noteMinimale", [], "any", false, false, false, 46) < 14)) {
                        // line 47
                        yield "                                                        Moyen
                                                    ";
                    } else {
                        // line 49
                        yield "                                                        Difficile
                                                    ";
                    }
                    // line 51
                    yield "                                                </span>
                                            </div>
                                            <div class=\"card-body\">
                                                <p class=\"card-text\">";
                    // line 54
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["rec"], "exercice", [], "any", false, false, false, 54), "description", [], "any", false, false, false, 54), "html", null, true);
                    yield "</p>
                                                <div class=\"d-flex justify-content-between align-items-center mb-3\">
                                                    <span class=\"badge bg-info\">
                                                        ";
                    // line 57
                    $context["types"] = ["qcm" => "QCM", "text" => "Texte", "php" => "PHP", "javascript" => "JavaScript", "html" => "HTML", "true_false" => "Vrai/Faux"];
                    // line 65
                    yield "                                                        ";
                    yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["types"] ?? null), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["rec"], "exercice", [], "any", false, false, false, 65), "typeExercice", [], "any", false, false, false, 65), [], "array", true, true, false, 65) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["types"]) || array_key_exists("types", $context) ? $context["types"] : (function () { throw new RuntimeError('Variable "types" does not exist.', 65, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["rec"], "exercice", [], "any", false, false, false, 65), "typeExercice", [], "any", false, false, false, 65), [], "array", false, false, false, 65)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["types"]) || array_key_exists("types", $context) ? $context["types"] : (function () { throw new RuntimeError('Variable "types" does not exist.', 65, $this->source); })()), CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["rec"], "exercice", [], "any", false, false, false, 65), "typeExercice", [], "any", false, false, false, 65), [], "array", false, false, false, 65), "html", null, true)) : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["rec"], "exercice", [], "any", false, false, false, 65), "typeExercice", [], "any", false, false, false, 65), "html", null, true)));
                    yield "
                                                    </span>
                                                    <div class=\"text-muted small\">Score: ";
                    // line 67
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["rec"], "score", [], "any", false, false, false, 67), "html", null, true);
                    yield "/100</div>
                                                </div>
                                                <p class=\"card-text text-muted fst-italic small\">";
                    // line 69
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["rec"], "reason", [], "any", false, false, false, 69), "html", null, true);
                    yield "</p>
                                            </div>
                                            <div class=\"card-footer\">
                                                <a href=\"";
                    // line 72
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_exercice_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["rec"], "exercice", [], "any", false, false, false, 72), "id", [], "any", false, false, false, 72)]), "html", null, true);
                    yield "\" class=\"btn btn-primary w-100\">Commencer cet exercice</a>
                                            </div>
                                        </div>
                                    </div>
                                ";
                }
                // line 77
                yield "                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['rec'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 78
            yield "                        ";
        } else {
            // line 79
            yield "                            <div class=\"col-12\">
                                <div class=\"alert alert-info\">
                                    Aucune recommandation disponible pour le moment. Essayez de compléter quelques exercices pour obtenir des recommandations personnalisées.
                                </div>
                            </div>
                        ";
        }
        // line 85
        yield "                    </div>
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

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "exercice/recommendations.html.twig";
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
        return array (  249 => 85,  241 => 79,  238 => 78,  232 => 77,  224 => 72,  218 => 69,  213 => 67,  207 => 65,  205 => 57,  199 => 54,  194 => 51,  190 => 49,  186 => 47,  184 => 46,  181 => 45,  179 => 44,  174 => 42,  170 => 41,  166 => 40,  163 => 39,  160 => 38,  155 => 37,  153 => 36,  149 => 34,  141 => 29,  137 => 27,  135 => 26,  132 => 25,  123 => 22,  120 => 21,  116 => 20,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Exercices Recommandés{% endblock %}

{% block content %}
<div class=\"container py-5\">
    <h1 class=\"mb-4\">Exercices Recommandés pour Vous</h1>
    
    <div class=\"row mb-4\">
        <div class=\"col-md-12\">
            <div class=\"card\">
                <div class=\"card-header bg-primary text-white\">
                    <h3 class=\"mb-0\">Recommandations Personnalisées</h3>
                </div>
                <div class=\"card-body\">
                    <p class=\"lead\">
                        Ces exercices sont recommandés en fonction de vos performances passées et de vos préférences.
                    </p>
                    
                    {% for message in app.flashes('error') %}
                        <div class=\"alert alert-danger mb-4\">
                            {{ message }}
                        </div>
                    {% endfor %}
                    
                    {% if error is defined %}
                        <div class=\"alert alert-danger mb-4\">
                            <h5 class=\"alert-heading\">Erreur technique</h5>
                            <p>{{ error }}</p>
                            <hr>
                            <p class=\"mb-0\">Veuillez réessayer plus tard ou contacter l'administrateur si le problème persiste.</p>
                        </div>
                    {% endif %}
                    
                    <div class=\"row\">
                        {% if recommendations is defined and recommendations|length > 0 %}
                            {% for rec in recommendations %}
                                {% if rec.exercice is not null %}
                                    <div class=\"col-md-6 col-lg-4 mb-4\">
                                        <div class=\"card h-100 border-{{ rec.exercice.noteMinimale < 8 ? 'success' : (rec.exercice.noteMinimale < 14 ? 'warning' : 'danger') }}\">
                                            <div class=\"card-header bg-{{ rec.exercice.noteMinimale < 8 ? 'success' : (rec.exercice.noteMinimale < 14 ? 'warning' : 'danger') }} text-white d-flex justify-content-between align-items-center\">
                                                <h5 class=\"mb-0\">{{ rec.exercice.titre }}</h5>
                                                <span class=\"badge bg-light text-dark\">
                                                    {% if rec.exercice.noteMinimale < 8 %}
                                                        Facile
                                                    {% elseif rec.exercice.noteMinimale < 14 %}
                                                        Moyen
                                                    {% else %}
                                                        Difficile
                                                    {% endif %}
                                                </span>
                                            </div>
                                            <div class=\"card-body\">
                                                <p class=\"card-text\">{{ rec.exercice.description }}</p>
                                                <div class=\"d-flex justify-content-between align-items-center mb-3\">
                                                    <span class=\"badge bg-info\">
                                                        {% set types = {
                                                            'qcm': 'QCM',
                                                            'text': 'Texte',
                                                            'php': 'PHP',
                                                            'javascript': 'JavaScript',
                                                            'html': 'HTML',
                                                            'true_false': 'Vrai/Faux'
                                                        } %}
                                                        {{ types[rec.exercice.typeExercice] ?? rec.exercice.typeExercice }}
                                                    </span>
                                                    <div class=\"text-muted small\">Score: {{ rec.score }}/100</div>
                                                </div>
                                                <p class=\"card-text text-muted fst-italic small\">{{ rec.reason }}</p>
                                            </div>
                                            <div class=\"card-footer\">
                                                <a href=\"{{ path('app_exercice_show', {'id': rec.exercice.id}) }}\" class=\"btn btn-primary w-100\">Commencer cet exercice</a>
                                            </div>
                                        </div>
                                    </div>
                                {% endif %}
                            {% endfor %}
                        {% else %}
                            <div class=\"col-12\">
                                <div class=\"alert alert-info\">
                                    Aucune recommandation disponible pour le moment. Essayez de compléter quelques exercices pour obtenir des recommandations personnalisées.
                                </div>
                            </div>
                        {% endif %}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}
", "exercice/recommendations.html.twig", "C:\\Users\\maram\\pi_symfony_DevSphere1\\templates\\exercice\\recommendations.html.twig");
    }
}
