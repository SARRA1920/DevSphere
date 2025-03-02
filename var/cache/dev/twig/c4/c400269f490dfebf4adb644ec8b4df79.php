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

/* publication/new.html.twig */
class __TwigTemplate_894953f10a4bbda365be55633c260404 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "publication/new.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "publication/new.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "publication/new.html.twig", 1);
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

        yield "New Publication - DevSphere Forum";
        
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
                    <h1 class=\"display-3 text-white animated slideInDown\">Create New Publication</h1>
                    <nav aria-label=\"breadcrumb\">
                        <ol class=\"breadcrumb justify-content-center\">
                            <li class=\"breadcrumb-item\"><a class=\"text-white\" href=\"";
        // line 14
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("home");
        yield "\">Home</a></li>
                            <li class=\"breadcrumb-item\"><a class=\"text-white\" href=\"";
        // line 15
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_publication_index");
        yield "\">Publications</a></li>
                            <li class=\"breadcrumb-item text-white active\" aria-current=\"page\">New Publication</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- New Publication Form Start -->
    <div class=\"container-xxl py-5\">
        <div class=\"container\">
            <div class=\"row justify-content-center\">
                <div class=\"col-lg-8\">
                    <div class=\"wow fadeInUp\" data-wow-delay=\"0.1s\">
                        <form method=\"post\" action=\"";
        // line 31
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_publication_new");
        yield "\" class=\"bg-light p-4 rounded\">
                            <div class=\"row g-3\">
                                <div class=\"col-12\">
                                    <div class=\"form-floating\">
                                        <input type=\"text\" class=\"form-control\" id=\"titre\" name=\"titre\" placeholder=\"Publication Title\" required>
                                        <label for=\"titre\">Publication Title</label>
                                    </div>
                                </div>
                                <div class=\"col-12\">
                                    <div class=\"form-floating\">
                                        <textarea class=\"form-control\" id=\"contenu\" name=\"contenu\" placeholder=\"Publication Content\" style=\"height: 200px\" required></textarea>
                                        <label for=\"contenu\">Publication Content</label>
                                    </div>
                                </div>
                                <div class=\"col-12\">
                                    <div class=\"form-floating\">
                                        <select class=\"form-select\" id=\"categorie\" name=\"categorie\" required>
                                            <option value=\"\">Select a Category</option>
                                            ";
        // line 49
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["categories"]) || array_key_exists("categories", $context) ? $context["categories"] : (function () { throw new RuntimeError('Variable "categories" does not exist.', 49, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
            // line 50
            yield "                                                <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["category"], "id", [], "any", false, false, false, 50), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 50), "html", null, true);
            yield "</option>
                                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['category'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 52
        yield "                                        </select>
                                        <label for=\"categorie\">Category</label>
                                    </div>
                                </div>
                                <input type=\"hidden\" name=\"token\" value=\"";
        // line 56
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken("create-publication"), "html", null, true);
        yield "\">
                                <div class=\"col-12 text-center\">
                                    <a href=\"";
        // line 58
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_publication_index");
        yield "\" class=\"btn btn-secondary me-2\">Cancel</a>
                                    <button class=\"btn btn-primary w-100 py-3\" type=\"submit\">Create Publication</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New Publication Form End -->
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
        return "publication/new.html.twig";
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
        return array (  180 => 58,  175 => 56,  169 => 52,  158 => 50,  154 => 49,  133 => 31,  114 => 15,  110 => 14,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}New Publication - DevSphere Forum{% endblock %}

{% block content %}
    <!-- Header Start -->
    <div class=\"container-fluid bg-primary py-5 mb-5 page-header\">
        <div class=\"container py-5\">
            <div class=\"row justify-content-center\">
                <div class=\"col-lg-10 text-center\">
                    <h1 class=\"display-3 text-white animated slideInDown\">Create New Publication</h1>
                    <nav aria-label=\"breadcrumb\">
                        <ol class=\"breadcrumb justify-content-center\">
                            <li class=\"breadcrumb-item\"><a class=\"text-white\" href=\"{{ path('home') }}\">Home</a></li>
                            <li class=\"breadcrumb-item\"><a class=\"text-white\" href=\"{{ path('app_publication_index') }}\">Publications</a></li>
                            <li class=\"breadcrumb-item text-white active\" aria-current=\"page\">New Publication</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- New Publication Form Start -->
    <div class=\"container-xxl py-5\">
        <div class=\"container\">
            <div class=\"row justify-content-center\">
                <div class=\"col-lg-8\">
                    <div class=\"wow fadeInUp\" data-wow-delay=\"0.1s\">
                        <form method=\"post\" action=\"{{ path('app_publication_new') }}\" class=\"bg-light p-4 rounded\">
                            <div class=\"row g-3\">
                                <div class=\"col-12\">
                                    <div class=\"form-floating\">
                                        <input type=\"text\" class=\"form-control\" id=\"titre\" name=\"titre\" placeholder=\"Publication Title\" required>
                                        <label for=\"titre\">Publication Title</label>
                                    </div>
                                </div>
                                <div class=\"col-12\">
                                    <div class=\"form-floating\">
                                        <textarea class=\"form-control\" id=\"contenu\" name=\"contenu\" placeholder=\"Publication Content\" style=\"height: 200px\" required></textarea>
                                        <label for=\"contenu\">Publication Content</label>
                                    </div>
                                </div>
                                <div class=\"col-12\">
                                    <div class=\"form-floating\">
                                        <select class=\"form-select\" id=\"categorie\" name=\"categorie\" required>
                                            <option value=\"\">Select a Category</option>
                                            {% for category in categories %}
                                                <option value=\"{{ category.id }}\">{{ category.name }}</option>
                                            {% endfor %}
                                        </select>
                                        <label for=\"categorie\">Category</label>
                                    </div>
                                </div>
                                <input type=\"hidden\" name=\"token\" value=\"{{ csrf_token('create-publication') }}\">
                                <div class=\"col-12 text-center\">
                                    <a href=\"{{ path('app_publication_index') }}\" class=\"btn btn-secondary me-2\">Cancel</a>
                                    <button class=\"btn btn-primary w-100 py-3\" type=\"submit\">Create Publication</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New Publication Form End -->
{% endblock %}
", "publication/new.html.twig", "C:\\Users\\maram\\pi_symfony_DevSphere1\\templates\\publication\\new.html.twig");
    }
}
