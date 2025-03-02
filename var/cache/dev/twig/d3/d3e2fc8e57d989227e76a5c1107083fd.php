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

/* categorie_cours/show.html.twig */
class __TwigTemplate_d18d4d90efdb2e61670a8d6664ef3ed2 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "categorie_cours/show.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "categorie_cours/show.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "categorie_cours/show.html.twig", 1);
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

        yield "Détails de la Catégorie";
        
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
        yield "    <div class=\"container mt-4\">
        <h1>Détails de la Catégorie</h1>

        <table class=\"table\">
            <tbody>
                <tr>
                    <th>Nom</th>
                    <td>";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["categorie_cours"]) || array_key_exists("categorie_cours", $context) ? $context["categorie_cours"] : (function () { throw new RuntimeError('Variable "categorie_cours" does not exist.', 13, $this->source); })()), "nom", [], "any", false, false, false, 13), "html", null, true);
        yield "</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>";
        // line 17
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["categorie_cours"]) || array_key_exists("categorie_cours", $context) ? $context["categorie_cours"] : (function () { throw new RuntimeError('Variable "categorie_cours" does not exist.', 17, $this->source); })()), "description", [], "any", false, false, false, 17), "html", null, true);
        yield "</td>
                </tr>
                <tr>
                    <th>Niveau</th>
                    <td>";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["categorie_cours"]) || array_key_exists("categorie_cours", $context) ? $context["categorie_cours"] : (function () { throw new RuntimeError('Variable "categorie_cours" does not exist.', 21, $this->source); })()), "niveau", [], "any", false, false, false, 21), "html", null, true);
        yield "</td>
                </tr>
            </tbody>
        </table>

        <a href=\"";
        // line 26
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_categorie_cours_index");
        yield "\" class=\"btn btn-secondary\">Retour à la liste</a>
        <a href=\"";
        // line 27
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_categorie_cours_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["categorie_cours"]) || array_key_exists("categorie_cours", $context) ? $context["categorie_cours"] : (function () { throw new RuntimeError('Variable "categorie_cours" does not exist.', 27, $this->source); })()), "id", [], "any", false, false, false, 27)]), "html", null, true);
        yield "\" class=\"btn btn-warning\">Modifier</a>

        <form method=\"post\" action=\"";
        // line 29
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_categorie_cours_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["categorie_cours"]) || array_key_exists("categorie_cours", $context) ? $context["categorie_cours"] : (function () { throw new RuntimeError('Variable "categorie_cours" does not exist.', 29, $this->source); })()), "id", [], "any", false, false, false, 29)]), "html", null, true);
        yield "\" onsubmit=\"return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');\" style=\"display: inline-block\">
            <input type=\"hidden\" name=\"_token\" value=\"";
        // line 30
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["categorie_cours"]) || array_key_exists("categorie_cours", $context) ? $context["categorie_cours"] : (function () { throw new RuntimeError('Variable "categorie_cours" does not exist.', 30, $this->source); })()), "id", [], "any", false, false, false, 30))), "html", null, true);
        yield "\">
            <button class=\"btn btn-danger\">Supprimer</button>
        </form>
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
        return "categorie_cours/show.html.twig";
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
        return array (  144 => 30,  140 => 29,  135 => 27,  131 => 26,  123 => 21,  116 => 17,  109 => 13,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Détails de la Catégorie{% endblock %}

{% block content %}
    <div class=\"container mt-4\">
        <h1>Détails de la Catégorie</h1>

        <table class=\"table\">
            <tbody>
                <tr>
                    <th>Nom</th>
                    <td>{{ categorie_cours.nom }}</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>{{ categorie_cours.description }}</td>
                </tr>
                <tr>
                    <th>Niveau</th>
                    <td>{{ categorie_cours.niveau }}</td>
                </tr>
            </tbody>
        </table>

        <a href=\"{{ path('app_categorie_cours_index') }}\" class=\"btn btn-secondary\">Retour à la liste</a>
        <a href=\"{{ path('app_categorie_cours_edit', {'id': categorie_cours.id}) }}\" class=\"btn btn-warning\">Modifier</a>

        <form method=\"post\" action=\"{{ path('app_categorie_cours_delete', {'id': categorie_cours.id}) }}\" onsubmit=\"return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');\" style=\"display: inline-block\">
            <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete' ~ categorie_cours.id) }}\">
            <button class=\"btn btn-danger\">Supprimer</button>
        </form>
    </div>
{% endblock %}
", "categorie_cours/show.html.twig", "C:\\Users\\maram\\pi_symfony_DevSphere1\\templates\\categorie_cours\\show.html.twig");
    }
}
