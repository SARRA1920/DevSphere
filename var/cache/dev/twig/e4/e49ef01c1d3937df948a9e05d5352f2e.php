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

/* admin/tentative/index.html.twig */
class __TwigTemplate_00af9daa5efd658e3bdcc825b434ace5 extends Template
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
            'javascripts' => [$this, 'block_javascripts'],
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/tentative/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/tentative/index.html.twig"));

        $this->parent = $this->loadTemplate("admin/base.html.twig", "admin/tentative/index.html.twig", 1);
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

        yield "Gestion des tentatives";
        
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
        <h1 class=\"h3 mb-4 text-gray-800\">Gestion des tentatives</h1>

        ";
        // line 9
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 9, $this->source); })()), "flashes", [], "any", false, false, false, 9));
        foreach ($context['_seq'] as $context["label"] => $context["messages"]) {
            // line 10
            yield "            ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 11
                yield "                <div class=\"alert alert-";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"], "html", null, true);
                yield " alert-dismissible fade show\" role=\"alert\">
                    ";
                // line 12
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
                yield "
                    <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
                </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 16
            yield "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['label'], $context['messages'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 17
        yield "
        <div class=\"card shadow mb-4\">
            <div class=\"card-header py-3 d-flex justify-content-between align-items-center\">
                <h6 class=\"m-0 font-weight-bold text-primary\">Liste des tentatives</h6>
                <div class=\"btn-group\">
                    <a href=\"";
        // line 22
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_tentative_new");
        yield "\" class=\"btn btn-success btn-sm\">
                        <i class=\"fas fa-plus\"></i> Nouvelle tentative
                    </a>
                    <a href=\"";
        // line 25
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_dashboard");
        yield "\" class=\"btn btn-secondary btn-sm\">
                        <i class=\"fas fa-arrow-left\"></i> Retour au tableau de bord
                    </a>
                </div>
            </div>
            <div class=\"card-body\">
                <div class=\"table-responsive\">
                    <table class=\"table table-bordered\" id=\"dataTable\" width=\"100%\" cellspacing=\"0\">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Exercice</th>
                                <th>Score</th>
                                <th>Statut</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            ";
        // line 44
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["tentatives"]) || array_key_exists("tentatives", $context) ? $context["tentatives"] : (function () { throw new RuntimeError('Variable "tentatives" does not exist.', 44, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["tentative"]) {
            // line 45
            yield "                                <tr>
                                    <td>";
            // line 46
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tentative"], "id", [], "any", false, false, false, 46), "html", null, true);
            yield "</td>
                                    <td>";
            // line 47
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["tentative"], "exercice", [], "any", false, false, false, 47), "titre", [], "any", false, false, false, 47), "html", null, true);
            yield "</td>
                                    <td>";
            // line 48
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["tentative"], "score", [], "any", false, false, false, 48), "html", null, true);
            yield "/100</td>
                                    <td>
                                        ";
            // line 50
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["tentative"], "statue", [], "any", false, false, false, 50) == "reussi")) {
                // line 51
                yield "                                            <span class=\"badge bg-success\">Réussi</span>
                                        ";
            } else {
                // line 53
                yield "                                            <span class=\"badge bg-danger\">Échoué</span>
                                        ";
            }
            // line 55
            yield "                                    </td>
                                    <td>";
            // line 56
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["tentative"], "date", [], "any", false, false, false, 56), "d/m/Y"), "html", null, true);
            yield "</td>
                                    <td>
                                        <div class=\"btn-group\">
                                            <a href=\"";
            // line 59
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_tentative_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["tentative"], "id", [], "any", false, false, false, 59)]), "html", null, true);
            yield "\" class=\"btn btn-info btn-sm\" title=\"Voir\">
                                                <i class=\"fas fa-eye\"></i>
                                            </a>
                                            <a href=\"";
            // line 62
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_tentative_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["tentative"], "id", [], "any", false, false, false, 62)]), "html", null, true);
            yield "\" class=\"btn btn-warning btn-sm\" title=\"Modifier\">
                                                <i class=\"fas fa-edit\"></i>
                                            </a>
                                            <form method=\"post\" action=\"";
            // line 65
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_tentative_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["tentative"], "id", [], "any", false, false, false, 65)]), "html", null, true);
            yield "\" style=\"display: inline-block\" onsubmit=\"return confirm('Êtes-vous sûr de vouloir supprimer cette tentative ?');\">
                                                <input type=\"hidden\" name=\"_token\" value=\"";
            // line 66
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, $context["tentative"], "id", [], "any", false, false, false, 66))), "html", null, true);
            yield "\">
                                                <button class=\"btn btn-danger btn-sm\" title=\"Supprimer\">
                                                    <i class=\"fas fa-trash\"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            ";
            $context['_iterated'] = true;
        }
        // line 78
        if (!$context['_iterated']) {
            // line 75
            yield "                                <tr>
                                    <td colspan=\"6\" class=\"text-center\">Aucune tentative trouvée</td>
                                </tr>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['tentative'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 79
        yield "                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 87
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

        // line 88
        yield "    ";
        yield from $this->yieldParentBlock("javascripts", $context, $blocks);
        yield "
    <script>
        \$(document).ready(function() {
            \$('#dataTable').DataTable({
                \"language\": {
                    \"url\": \"//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json\"
                }
            });

            // Fermeture automatique des alertes après 5 secondes
            setTimeout(function() {
                \$('.alert').fadeOut('slow');
            }, 5000);
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
        return "admin/tentative/index.html.twig";
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
        return array (  281 => 88,  268 => 87,  251 => 79,  242 => 75,  240 => 78,  227 => 66,  223 => 65,  217 => 62,  211 => 59,  205 => 56,  202 => 55,  198 => 53,  194 => 51,  192 => 50,  187 => 48,  183 => 47,  179 => 46,  176 => 45,  171 => 44,  149 => 25,  143 => 22,  136 => 17,  130 => 16,  120 => 12,  115 => 11,  110 => 10,  106 => 9,  101 => 6,  88 => 5,  65 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'admin/base.html.twig' %}

{% block title %}Gestion des tentatives{% endblock %}

{% block content %}
    <div class=\"container-fluid\">
        <h1 class=\"h3 mb-4 text-gray-800\">Gestion des tentatives</h1>

        {% for label, messages in app.flashes %}
            {% for message in messages %}
                <div class=\"alert alert-{{ label }} alert-dismissible fade show\" role=\"alert\">
                    {{ message }}
                    <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
                </div>
            {% endfor %}
        {% endfor %}

        <div class=\"card shadow mb-4\">
            <div class=\"card-header py-3 d-flex justify-content-between align-items-center\">
                <h6 class=\"m-0 font-weight-bold text-primary\">Liste des tentatives</h6>
                <div class=\"btn-group\">
                    <a href=\"{{ path('admin_tentative_new') }}\" class=\"btn btn-success btn-sm\">
                        <i class=\"fas fa-plus\"></i> Nouvelle tentative
                    </a>
                    <a href=\"{{ path('admin_dashboard') }}\" class=\"btn btn-secondary btn-sm\">
                        <i class=\"fas fa-arrow-left\"></i> Retour au tableau de bord
                    </a>
                </div>
            </div>
            <div class=\"card-body\">
                <div class=\"table-responsive\">
                    <table class=\"table table-bordered\" id=\"dataTable\" width=\"100%\" cellspacing=\"0\">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Exercice</th>
                                <th>Score</th>
                                <th>Statut</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {% for tentative in tentatives %}
                                <tr>
                                    <td>{{ tentative.id }}</td>
                                    <td>{{ tentative.exercice.titre }}</td>
                                    <td>{{ tentative.score }}/100</td>
                                    <td>
                                        {% if tentative.statue == 'reussi' %}
                                            <span class=\"badge bg-success\">Réussi</span>
                                        {% else %}
                                            <span class=\"badge bg-danger\">Échoué</span>
                                        {% endif %}
                                    </td>
                                    <td>{{ tentative.date|date('d/m/Y') }}</td>
                                    <td>
                                        <div class=\"btn-group\">
                                            <a href=\"{{ path('admin_tentative_show', {'id': tentative.id}) }}\" class=\"btn btn-info btn-sm\" title=\"Voir\">
                                                <i class=\"fas fa-eye\"></i>
                                            </a>
                                            <a href=\"{{ path('admin_tentative_edit', {'id': tentative.id}) }}\" class=\"btn btn-warning btn-sm\" title=\"Modifier\">
                                                <i class=\"fas fa-edit\"></i>
                                            </a>
                                            <form method=\"post\" action=\"{{ path('admin_tentative_delete', {'id': tentative.id}) }}\" style=\"display: inline-block\" onsubmit=\"return confirm('Êtes-vous sûr de vouloir supprimer cette tentative ?');\">
                                                <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete' ~ tentative.id) }}\">
                                                <button class=\"btn btn-danger btn-sm\" title=\"Supprimer\">
                                                    <i class=\"fas fa-trash\"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            {% else %}
                                <tr>
                                    <td colspan=\"6\" class=\"text-center\">Aucune tentative trouvée</td>
                                </tr>
                            {% endfor %}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
{% endblock %}

{% block javascripts %}
    {{ parent() }}
    <script>
        \$(document).ready(function() {
            \$('#dataTable').DataTable({
                \"language\": {
                    \"url\": \"//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json\"
                }
            });

            // Fermeture automatique des alertes après 5 secondes
            setTimeout(function() {
                \$('.alert').fadeOut('slow');
            }, 5000);
        });
    </script>
{% endblock %}
", "admin/tentative/index.html.twig", "C:\\Users\\maram\\pi_symfony_DevSphere1\\templates\\admin\\tentative\\index.html.twig");
    }
}
