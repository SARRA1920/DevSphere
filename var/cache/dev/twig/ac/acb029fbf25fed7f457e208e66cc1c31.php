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

/* tentative/resultat.html.twig */
class __TwigTemplate_3c6cd10007c7095efa9ee63d236c5a98 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "tentative/resultat.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "tentative/resultat.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "tentative/resultat.html.twig", 1);
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

        yield "Résultat de votre tentative";
        
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
        <div class=\"row justify-content-center\">
            <div class=\"col-lg-8\">
                <div class=\"card shadow-lg border-0 rounded-lg\">
                    <div class=\"card-header bg-";
        // line 10
        yield (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["tentative"]) || array_key_exists("tentative", $context) ? $context["tentative"] : (function () { throw new RuntimeError('Variable "tentative" does not exist.', 10, $this->source); })()), "statue", [], "any", false, false, false, 10) == "reussi")) ? ("success") : ("danger"));
        yield " text-white\">
                        <h3 class=\"mb-0\">
                            ";
        // line 12
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["tentative"]) || array_key_exists("tentative", $context) ? $context["tentative"] : (function () { throw new RuntimeError('Variable "tentative" does not exist.', 12, $this->source); })()), "statue", [], "any", false, false, false, 12) == "reussi")) {
            // line 13
            yield "                                <i class=\"fas fa-check-circle me-2\"></i>Exercice réussi !
                            ";
        } else {
            // line 15
            yield "                                <i class=\"fas fa-times-circle me-2\"></i>Exercice non réussi
                            ";
        }
        // line 17
        yield "                        </h3>
                    </div>
                    <div class=\"card-body\">
                        <div class=\"score-display text-center mb-4\">
                            <div class=\"display-1 ";
        // line 21
        yield (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["tentative"]) || array_key_exists("tentative", $context) ? $context["tentative"] : (function () { throw new RuntimeError('Variable "tentative" does not exist.', 21, $this->source); })()), "statue", [], "any", false, false, false, 21) == "reussi")) ? ("text-success") : ("text-danger"));
        yield "\">
                                ";
        // line 22
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["tentative"]) || array_key_exists("tentative", $context) ? $context["tentative"] : (function () { throw new RuntimeError('Variable "tentative" does not exist.', 22, $this->source); })()), "score", [], "any", false, false, false, 22), "html", null, true);
        yield "/100
                            </div>
                            <p class=\"text-muted\">
                                Note minimale requise : ";
        // line 25
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["tentative"]) || array_key_exists("tentative", $context) ? $context["tentative"] : (function () { throw new RuntimeError('Variable "tentative" does not exist.', 25, $this->source); })()), "exercice", [], "any", false, false, false, 25), "noteMinimale", [], "any", false, false, false, 25) * 5), "html", null, true);
        yield "/100
                            </p>
                        </div>

                        ";
        // line 29
        if ( !Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["tentative"]) || array_key_exists("tentative", $context) ? $context["tentative"] : (function () { throw new RuntimeError('Variable "tentative" does not exist.', 29, $this->source); })()), "feedback", [], "any", false, false, false, 29))) {
            // line 30
            yield "                            <div class=\"feedback-section mb-4\">
                                <h4 class=\"mb-3\">Retour sur votre réponse :</h4>
                                ";
            // line 32
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["tentative"]) || array_key_exists("tentative", $context) ? $context["tentative"] : (function () { throw new RuntimeError('Variable "tentative" does not exist.', 32, $this->source); })()), "feedback", [], "any", false, false, false, 32));
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 33
                yield "                                    <div class=\"alert alert-info\">
                                        ";
                // line 34
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
                yield "
                                    </div>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 37
            yield "                            </div>
                        ";
        }
        // line 39
        yield "
                        <div class=\"code-section mb-4\">
                            <h4>Votre réponse :</h4>
                            <pre class=\"bg-light p-3 rounded\"><code>";
        // line 42
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["tentative"]) || array_key_exists("tentative", $context) ? $context["tentative"] : (function () { throw new RuntimeError('Variable "tentative" does not exist.', 42, $this->source); })()), "reponse", [], "any", false, false, false, 42), "html", null, true);
        yield "</code></pre>
                        </div>

                        <div class=\"mt-4 d-flex justify-content-between\">
                            <a href=\"";
        // line 46
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_exercice_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["tentative"]) || array_key_exists("tentative", $context) ? $context["tentative"] : (function () { throw new RuntimeError('Variable "tentative" does not exist.', 46, $this->source); })()), "exercice", [], "any", false, false, false, 46), "id", [], "any", false, false, false, 46)]), "html", null, true);
        yield "\" class=\"btn btn-primary\">
                                <i class=\"fas fa-redo me-2\"></i>Réessayer
                            </a>
                            <a href=\"";
        // line 49
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_mes_tentatives");
        yield "\" class=\"btn btn-secondary\">
                                <i class=\"fas fa-list me-2\"></i>Voir toutes mes tentatives
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .score-display {
            padding: 2rem;
            border-radius: 1rem;
            background-color: #f8f9fa;
        }
        pre {
            max-height: 300px;
            overflow-y: auto;
        }
        .feedback-section .alert {
            margin-bottom: 0.5rem;
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
        return "tentative/resultat.html.twig";
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
        return array (  188 => 49,  182 => 46,  175 => 42,  170 => 39,  166 => 37,  157 => 34,  154 => 33,  150 => 32,  146 => 30,  144 => 29,  137 => 25,  131 => 22,  127 => 21,  121 => 17,  117 => 15,  113 => 13,  111 => 12,  106 => 10,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Résultat de votre tentative{% endblock %}

{% block content %}
    <div class=\"container py-5\">
        <div class=\"row justify-content-center\">
            <div class=\"col-lg-8\">
                <div class=\"card shadow-lg border-0 rounded-lg\">
                    <div class=\"card-header bg-{{ tentative.statue == 'reussi' ? 'success' : 'danger' }} text-white\">
                        <h3 class=\"mb-0\">
                            {% if tentative.statue == 'reussi' %}
                                <i class=\"fas fa-check-circle me-2\"></i>Exercice réussi !
                            {% else %}
                                <i class=\"fas fa-times-circle me-2\"></i>Exercice non réussi
                            {% endif %}
                        </h3>
                    </div>
                    <div class=\"card-body\">
                        <div class=\"score-display text-center mb-4\">
                            <div class=\"display-1 {{ tentative.statue == 'reussi' ? 'text-success' : 'text-danger' }}\">
                                {{ tentative.score }}/100
                            </div>
                            <p class=\"text-muted\">
                                Note minimale requise : {{ tentative.exercice.noteMinimale * 5 }}/100
                            </p>
                        </div>

                        {% if tentative.feedback is not empty %}
                            <div class=\"feedback-section mb-4\">
                                <h4 class=\"mb-3\">Retour sur votre réponse :</h4>
                                {% for message in tentative.feedback %}
                                    <div class=\"alert alert-info\">
                                        {{ message }}
                                    </div>
                                {% endfor %}
                            </div>
                        {% endif %}

                        <div class=\"code-section mb-4\">
                            <h4>Votre réponse :</h4>
                            <pre class=\"bg-light p-3 rounded\"><code>{{ tentative.reponse }}</code></pre>
                        </div>

                        <div class=\"mt-4 d-flex justify-content-between\">
                            <a href=\"{{ path('app_exercice_show', {'id': tentative.exercice.id}) }}\" class=\"btn btn-primary\">
                                <i class=\"fas fa-redo me-2\"></i>Réessayer
                            </a>
                            <a href=\"{{ path('app_mes_tentatives') }}\" class=\"btn btn-secondary\">
                                <i class=\"fas fa-list me-2\"></i>Voir toutes mes tentatives
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .score-display {
            padding: 2rem;
            border-radius: 1rem;
            background-color: #f8f9fa;
        }
        pre {
            max-height: 300px;
            overflow-y: auto;
        }
        .feedback-section .alert {
            margin-bottom: 0.5rem;
        }
    </style>
{% endblock %}
", "tentative/resultat.html.twig", "C:\\Users\\maram\\pi_symfony_DevSphere1\\templates\\tentative\\resultat.html.twig");
    }
}
