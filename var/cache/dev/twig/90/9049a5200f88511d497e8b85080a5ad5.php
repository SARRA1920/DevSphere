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

/* forum/index.html.twig */
class __TwigTemplate_c1efa11110030b5de31db91d74c66261 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "forum/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "forum/index.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "forum/index.html.twig", 1);
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

        yield "Forum - DevSphere";
        
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
        yield "    <!-- Header Start -->
    <div class=\"container-fluid bg-primary py-5 mb-5 page-header\">
        <div class=\"container py-5\">
            <div class=\"row justify-content-center\">
                <div class=\"col-lg-10 text-center\">
                    <h1 class=\"display-3 text-white animated slideInDown\">Forum</h1>
                    <nav aria-label=\"breadcrumb\">
                        <ol class=\"breadcrumb justify-content-center\">
                            <li class=\"breadcrumb-item\"><a class=\"text-white\" href=\"";
        // line 14
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "\">Home</a></li>
                            <li class=\"breadcrumb-item text-white active\" aria-current=\"page\">Forum</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Forum Start -->
    <div class=\"container-xxl py-5\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-lg-12\">
                    <div class=\"d-flex justify-content-between align-items-center mb-4\">
                        <h3 class=\"mb-0\">Topics</h3>
                        ";
        // line 31
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 31, $this->source); })()), "user", [], "any", false, false, false, 31)) {
            // line 32
            yield "                            <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_forum_new");
            yield "\" class=\"btn btn-primary\">Create New Topic</a>
                        ";
        }
        // line 34
        yield "                    </div>

                    ";
        // line 36
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["publications"]) || array_key_exists("publications", $context) ? $context["publications"] : (function () { throw new RuntimeError('Variable "publications" does not exist.', 36, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["publication"]) {
            // line 37
            yield "                        <div class=\"bg-light rounded p-4 mb-4\">
                            <h3 class=\"mb-3\">
                                <a href=\"";
            // line 39
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_forum_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["publication"], "id", [], "any", false, false, false, 39)]), "html", null, true);
            yield "\" class=\"text-dark text-decoration-none\">
                                    ";
            // line 40
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["publication"], "titre", [], "any", false, false, false, 40), "html", null, true);
            yield "
                                </a>
                            </h3>
                            <div class=\"d-flex align-items-center mb-3\">
                                <div>
                                    <span class=\"text-primary\">";
            // line 45
            yield ((CoreExtension::getAttribute($this->env, $this->source, $context["publication"], "user", [], "any", false, false, false, 45)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["publication"], "user", [], "any", false, false, false, 45), "email", [], "any", false, false, false, 45), "html", null, true)) : ("Anonymous"));
            yield "</span>
                                    <span class=\"text-muted ms-2\">";
            // line 46
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["publication"], "date", [], "any", false, false, false, 46), "M d, Y"), "html", null, true);
            yield "</span>
                                </div>
                            </div>
                            <div class=\"mb-3\">
                                <span class=\"badge bg-primary\">";
            // line 50
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["publication"], "category", [], "any", false, false, false, 50), "category", [], "any", false, false, false, 50), "value", [], "any", false, false, false, 50), "html", null, true);
            yield "</span>
                                <span class=\"text-muted ms-3\">
                                    <i class=\"fa fa-comments me-1\"></i>
                                    ";
            // line 53
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["publication"], "commentaires", [], "any", false, false, false, 53)), "html", null, true);
            yield " Comments
                                </span>
                            </div>
                            <div class=\"d-flex justify-content-between\">
                                <a href=\"";
            // line 57
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_forum_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["publication"], "id", [], "any", false, false, false, 57)]), "html", null, true);
            yield "\" class=\"btn btn-sm btn-outline-primary\">Read More</a>
                                ";
            // line 58
            if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 58, $this->source); })()), "user", [], "any", false, false, false, 58) == CoreExtension::getAttribute($this->env, $this->source, $context["publication"], "user", [], "any", false, false, false, 58))) {
                // line 59
                yield "                                    <div>
                                        <a href=\"";
                // line 60
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_forum_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["publication"], "id", [], "any", false, false, false, 60)]), "html", null, true);
                yield "\" class=\"btn btn-sm btn-outline-secondary me-2\">Edit</a>
                                        <form action=\"";
                // line 61
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_forum_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["publication"], "id", [], "any", false, false, false, 61)]), "html", null, true);
                yield "\" method=\"post\" style=\"display: inline-block\">
                                            <input type=\"hidden\" name=\"_token\" value=\"";
                // line 62
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, $context["publication"], "id", [], "any", false, false, false, 62))), "html", null, true);
                yield "\">
                                            <button class=\"btn btn-sm btn-outline-danger\" onclick=\"return confirm('Are you sure?')\">Delete</button>
                                        </form>
                                    </div>
                                ";
            }
            // line 67
            yield "                            </div>
                        </div>
                    ";
            $context['_iterated'] = true;
        }
        // line 76
        if (!$context['_iterated']) {
            // line 70
            yield "                        <div class=\"text-center py-5\">
                            <p class=\"text-muted mb-0\">No topics found.</p>
                            ";
            // line 72
            if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 72, $this->source); })()), "user", [], "any", false, false, false, 72)) {
                // line 73
                yield "                                <a href=\"";
                yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_forum_new");
                yield "\" class=\"btn btn-primary mt-3\">Create the First Topic</a>
                            ";
            }
            // line 75
            yield "                        </div>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['publication'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 77
        yield "                </div>
            </div>
        </div>
    </div>
    <!-- Forum End -->
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
        return "forum/index.html.twig";
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
        return array (  239 => 77,  232 => 75,  226 => 73,  224 => 72,  220 => 70,  218 => 76,  212 => 67,  204 => 62,  200 => 61,  196 => 60,  193 => 59,  191 => 58,  187 => 57,  180 => 53,  174 => 50,  167 => 46,  163 => 45,  155 => 40,  151 => 39,  147 => 37,  142 => 36,  138 => 34,  132 => 32,  130 => 31,  110 => 14,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Forum - DevSphere{% endblock %}

{% block content %}
    <!-- Header Start -->
    <div class=\"container-fluid bg-primary py-5 mb-5 page-header\">
        <div class=\"container py-5\">
            <div class=\"row justify-content-center\">
                <div class=\"col-lg-10 text-center\">
                    <h1 class=\"display-3 text-white animated slideInDown\">Forum</h1>
                    <nav aria-label=\"breadcrumb\">
                        <ol class=\"breadcrumb justify-content-center\">
                            <li class=\"breadcrumb-item\"><a class=\"text-white\" href=\"{{ path('app_home') }}\">Home</a></li>
                            <li class=\"breadcrumb-item text-white active\" aria-current=\"page\">Forum</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Forum Start -->
    <div class=\"container-xxl py-5\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-lg-12\">
                    <div class=\"d-flex justify-content-between align-items-center mb-4\">
                        <h3 class=\"mb-0\">Topics</h3>
                        {% if app.user %}
                            <a href=\"{{ path('app_forum_new') }}\" class=\"btn btn-primary\">Create New Topic</a>
                        {% endif %}
                    </div>

                    {% for publication in publications %}
                        <div class=\"bg-light rounded p-4 mb-4\">
                            <h3 class=\"mb-3\">
                                <a href=\"{{ path('app_forum_show', {'id': publication.id}) }}\" class=\"text-dark text-decoration-none\">
                                    {{ publication.titre }}
                                </a>
                            </h3>
                            <div class=\"d-flex align-items-center mb-3\">
                                <div>
                                    <span class=\"text-primary\">{{ publication.user ? publication.user.email : 'Anonymous' }}</span>
                                    <span class=\"text-muted ms-2\">{{ publication.date|date('M d, Y') }}</span>
                                </div>
                            </div>
                            <div class=\"mb-3\">
                                <span class=\"badge bg-primary\">{{ publication.category.category.value }}</span>
                                <span class=\"text-muted ms-3\">
                                    <i class=\"fa fa-comments me-1\"></i>
                                    {{ publication.commentaires|length }} Comments
                                </span>
                            </div>
                            <div class=\"d-flex justify-content-between\">
                                <a href=\"{{ path('app_forum_show', {'id': publication.id}) }}\" class=\"btn btn-sm btn-outline-primary\">Read More</a>
                                {% if app.user == publication.user %}
                                    <div>
                                        <a href=\"{{ path('app_forum_edit', {'id': publication.id}) }}\" class=\"btn btn-sm btn-outline-secondary me-2\">Edit</a>
                                        <form action=\"{{ path('app_forum_delete', {'id': publication.id}) }}\" method=\"post\" style=\"display: inline-block\">
                                            <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete' ~ publication.id) }}\">
                                            <button class=\"btn btn-sm btn-outline-danger\" onclick=\"return confirm('Are you sure?')\">Delete</button>
                                        </form>
                                    </div>
                                {% endif %}
                            </div>
                        </div>
                    {% else %}
                        <div class=\"text-center py-5\">
                            <p class=\"text-muted mb-0\">No topics found.</p>
                            {% if app.user %}
                                <a href=\"{{ path('app_forum_new') }}\" class=\"btn btn-primary mt-3\">Create the First Topic</a>
                            {% endif %}
                        </div>
                    {% endfor %}
                </div>
            </div>
        </div>
    </div>
    <!-- Forum End -->
{% endblock %}
", "forum/index.html.twig", "C:\\Users\\maram\\pi_symfony_DevSphere1\\templates\\forum\\index.html.twig");
    }
}
