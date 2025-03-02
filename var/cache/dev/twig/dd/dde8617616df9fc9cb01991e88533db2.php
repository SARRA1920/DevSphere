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

/* cours/index.html.twig */
class __TwigTemplate_f197126cfcabdf31fadc06e2f3019890 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "cours/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "cours/index.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "cours/index.html.twig", 1);
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

        yield "Courses - DevSphere";
        
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
        yield "    <!-- Courses Start -->
    <div class=\"container-xxl py-5\">
        <div class=\"container\">
            <div class=\"text-center wow fadeInUp\" data-wow-delay=\"0.1s\">
                <h6 class=\"section-title bg-white text-center text-primary px-3\">Courses</h6>
                <h1 class=\"mb-5\">Our Popular Courses</h1>
            </div>

            <!-- Category Filter Start -->
            <div class=\"row mb-4\">
                <div class=\"col-md-6 offset-md-3\">
                    <div class=\"bg-light p-4 rounded\">
                        <h5 class=\"text-center mb-3\">Filter by Category</h5>
                        <form method=\"get\" class=\"d-flex justify-content-center\">
                            <select name=\"category\" class=\"form-select me-2\" onchange=\"this.form.submit()\">
                                <option value=\"\">All Categories</option>
                                ";
        // line 24
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["categories"]) || array_key_exists("categories", $context) ? $context["categories"] : (function () { throw new RuntimeError('Variable "categories" does not exist.', 24, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
            // line 25
            yield "                                    <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["category"], "id", [], "any", false, false, false, 25), "html", null, true);
            yield "\" ";
            if (((isset($context["selected_category"]) || array_key_exists("selected_category", $context) ? $context["selected_category"] : (function () { throw new RuntimeError('Variable "selected_category" does not exist.', 25, $this->source); })()) == CoreExtension::getAttribute($this->env, $this->source, $context["category"], "id", [], "any", false, false, false, 25))) {
                yield "selected";
            }
            yield ">
                                        ";
            // line 26
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["category"], "nom", [], "any", false, false, false, 26), "html", null, true);
            yield "
                                    </option>
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['category'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 29
        yield "                            </select>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Category Filter End -->

            <div class=\"row g-4 justify-content-center\">
                ";
        // line 37
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable($context["cours"]);
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["cours"]) {
            // line 38
            yield "                    <div class=\"col-lg-4 col-md-6 wow fadeInUp\" data-wow-delay=\"0.1s\">
                        <div class=\"course-item bg-light\">
                            <div class=\"position-relative overflow-hidden\">
                                <img class=\"img-fluid\" src=\"";
            // line 41
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/course-1.jpg"), "html", null, true);
            yield "\" alt=\"Course Image\">
                                <div class=\"w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4\">
                                    <a href=\"";
            // line 43
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_cours_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["cours"], "id", [], "any", false, false, false, 43)]), "html", null, true);
            yield "\" class=\"flex-shrink-0 btn btn-sm btn-primary px-3\">Learn More</a>
                                </div>
                            </div>
                            <div class=\"text-center p-4 pb-0\">
                                <h3 class=\"mb-0\">";
            // line 47
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["cours"], "titre", [], "any", false, false, false, 47), "html", null, true);
            yield "</h3>
                                <span class=\"badge bg-primary mb-2\">";
            // line 48
            yield ((CoreExtension::getAttribute($this->env, $this->source, $context["cours"], "categorieCours", [], "any", false, false, false, 48)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["cours"], "categorieCours", [], "any", false, false, false, 48), "nom", [], "any", false, false, false, 48), "html", null, true)) : ("No Category"));
            yield "</span>
                                <div class=\"mb-3\">
                                    <small class=\"fa fa-star text-primary\"></small>
                                    <small class=\"fa fa-star text-primary\"></small>
                                    <small class=\"fa fa-star text-primary\"></small>
                                    <small class=\"fa fa-star text-primary\"></small>
                                    <small class=\"fa fa-star text-primary\"></small>
                                </div>
                                <h5 class=\"mb-4\">";
            // line 56
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["cours"], "description", [], "any", false, false, false, 56), "html", null, true);
            yield "</h5>
                            </div>
                            <div class=\"d-flex border-top\">
                                <small class=\"flex-fill text-center border-end py-2\"><i class=\"fa fa-clock text-primary me-2\"></i>";
            // line 59
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["cours"], "duree", [], "any", false, false, false, 59), "html", null, true);
            yield "</small>
                                <small class=\"flex-fill text-center py-2\"><i class=\"fa fa-level-up text-primary me-2\"></i>";
            // line 60
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["cours"], "niveau", [], "any", false, false, false, 60), "html", null, true);
            yield "</small>
                            </div>
                        </div>
                    </div>
                ";
            $context['_iterated'] = true;
        }
        // line 68
        if (!$context['_iterated']) {
            // line 65
            yield "                    <div class=\"col-12 text-center\">
                        <p>No courses found</p>
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['cours'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 69
        yield "            </div>
        </div>
    </div>
    <!-- Courses End -->
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
        return "cours/index.html.twig";
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
        return array (  240 => 69,  231 => 65,  229 => 68,  220 => 60,  216 => 59,  210 => 56,  199 => 48,  195 => 47,  188 => 43,  183 => 41,  178 => 38,  173 => 37,  163 => 29,  154 => 26,  145 => 25,  141 => 24,  123 => 8,  110 => 7,  88 => 5,  65 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Courses - DevSphere{% endblock %}

{% block carousel %}{% endblock %}

{% block content %}
    <!-- Courses Start -->
    <div class=\"container-xxl py-5\">
        <div class=\"container\">
            <div class=\"text-center wow fadeInUp\" data-wow-delay=\"0.1s\">
                <h6 class=\"section-title bg-white text-center text-primary px-3\">Courses</h6>
                <h1 class=\"mb-5\">Our Popular Courses</h1>
            </div>

            <!-- Category Filter Start -->
            <div class=\"row mb-4\">
                <div class=\"col-md-6 offset-md-3\">
                    <div class=\"bg-light p-4 rounded\">
                        <h5 class=\"text-center mb-3\">Filter by Category</h5>
                        <form method=\"get\" class=\"d-flex justify-content-center\">
                            <select name=\"category\" class=\"form-select me-2\" onchange=\"this.form.submit()\">
                                <option value=\"\">All Categories</option>
                                {% for category in categories %}
                                    <option value=\"{{ category.id }}\" {% if selected_category == category.id %}selected{% endif %}>
                                        {{ category.nom }}
                                    </option>
                                {% endfor %}
                            </select>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Category Filter End -->

            <div class=\"row g-4 justify-content-center\">
                {% for cours in cours %}
                    <div class=\"col-lg-4 col-md-6 wow fadeInUp\" data-wow-delay=\"0.1s\">
                        <div class=\"course-item bg-light\">
                            <div class=\"position-relative overflow-hidden\">
                                <img class=\"img-fluid\" src=\"{{ asset('img/course-1.jpg') }}\" alt=\"Course Image\">
                                <div class=\"w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4\">
                                    <a href=\"{{ path('app_cours_show', {'id': cours.id}) }}\" class=\"flex-shrink-0 btn btn-sm btn-primary px-3\">Learn More</a>
                                </div>
                            </div>
                            <div class=\"text-center p-4 pb-0\">
                                <h3 class=\"mb-0\">{{ cours.titre }}</h3>
                                <span class=\"badge bg-primary mb-2\">{{ cours.categorieCours ? cours.categorieCours.nom : 'No Category' }}</span>
                                <div class=\"mb-3\">
                                    <small class=\"fa fa-star text-primary\"></small>
                                    <small class=\"fa fa-star text-primary\"></small>
                                    <small class=\"fa fa-star text-primary\"></small>
                                    <small class=\"fa fa-star text-primary\"></small>
                                    <small class=\"fa fa-star text-primary\"></small>
                                </div>
                                <h5 class=\"mb-4\">{{ cours.description }}</h5>
                            </div>
                            <div class=\"d-flex border-top\">
                                <small class=\"flex-fill text-center border-end py-2\"><i class=\"fa fa-clock text-primary me-2\"></i>{{ cours.duree }}</small>
                                <small class=\"flex-fill text-center py-2\"><i class=\"fa fa-level-up text-primary me-2\"></i>{{ cours.niveau }}</small>
                            </div>
                        </div>
                    </div>
                {% else %}
                    <div class=\"col-12 text-center\">
                        <p>No courses found</p>
                    </div>
                {% endfor %}
            </div>
        </div>
    </div>
    <!-- Courses End -->
{% endblock %}", "cours/index.html.twig", "C:\\Users\\maram\\pi_symfony_DevSphere1\\templates\\cours\\index.html.twig");
    }
}
