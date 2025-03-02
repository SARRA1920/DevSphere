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

/* cours/show.html.twig */
class __TwigTemplate_e71c491257fcd2d2fcfa80f6f36edebe extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "cours/show.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "cours/show.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "cours/show.html.twig", 1);
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

        yield "Course Details - DevSphere";
        
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
                    <h1 class=\"display-3 text-white animated slideInDown\">Course Details</h1>
                    <nav aria-label=\"breadcrumb\">
                        <ol class=\"breadcrumb justify-content-center\">
                            <li class=\"breadcrumb-item\"><a class=\"text-white\" href=\"";
        // line 14
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "\">Home</a></li>
                            <li class=\"breadcrumb-item\"><a class=\"text-white\" href=\"";
        // line 15
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_cours_index");
        yield "\">Courses</a></li>
                            <li class=\"breadcrumb-item text-white active\" aria-current=\"page\">Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Course Detail Start -->
    <div class=\"container-xxl py-5\">
        <div class=\"container\">
            <div class=\"row g-5\">
                <!-- Course Details -->
                <div class=\"col-lg-8 wow fadeInUp\" data-wow-delay=\"0.1s\">
                    <div class=\"course-item bg-light\">
                        <div class=\"position-relative overflow-hidden\">
                            <img class=\"img-fluid\" src=\"";
        // line 33
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("img/course-1.jpg"), "html", null, true);
        yield "\" alt=\"Course Image\">
                        </div>
                        <div class=\"p-4\">
                            <div class=\"course-details\">
                                <h3>";
        // line 37
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["cours"]) || array_key_exists("cours", $context) ? $context["cours"] : (function () { throw new RuntimeError('Variable "cours" does not exist.', 37, $this->source); })()), "titre", [], "any", false, false, false, 37), "html", null, true);
        yield "</h3>
                                <p>";
        // line 38
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["cours"]) || array_key_exists("cours", $context) ? $context["cours"] : (function () { throw new RuntimeError('Variable "cours" does not exist.', 38, $this->source); })()), "description", [], "any", false, false, false, 38), "html", null, true);
        yield "</p>
                                <div class=\"course-meta\">
                                    ";
        // line 40
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["cours"]) || array_key_exists("cours", $context) ? $context["cours"] : (function () { throw new RuntimeError('Variable "cours" does not exist.', 40, $this->source); })()), "instructeur", [], "any", false, false, false, 40)) {
            // line 41
            yield "                                        <p><i class=\"fa fa-user-tie text-primary me-2\"></i>";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["cours"]) || array_key_exists("cours", $context) ? $context["cours"] : (function () { throw new RuntimeError('Variable "cours" does not exist.', 41, $this->source); })()), "instructeur", [], "any", false, false, false, 41), "html", null, true);
            yield "</p>
                                    ";
        }
        // line 43
        yield "                                    <p><i class=\"fa fa-clock text-primary me-2\"></i>";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["cours"]) || array_key_exists("cours", $context) ? $context["cours"] : (function () { throw new RuntimeError('Variable "cours" does not exist.', 43, $this->source); })()), "duree", [], "any", false, false, false, 43), "html", null, true);
        yield "</p>
                                    <p><i class=\"fa fa-graduation-cap text-primary me-2\"></i>";
        // line 44
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["cours"]) || array_key_exists("cours", $context) ? $context["cours"] : (function () { throw new RuntimeError('Variable "cours" does not exist.', 44, $this->source); })()), "niveau", [], "any", false, false, false, 44), "html", null, true);
        yield "</p>
                                </div>
                                ";
        // line 46
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["cours"]) || array_key_exists("cours", $context) ? $context["cours"] : (function () { throw new RuntimeError('Variable "cours" does not exist.', 46, $this->source); })()), "pdfFilename", [], "any", false, false, false, 46)) {
            // line 47
            yield "                                    ";
            if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 47, $this->source); })()), "user", [], "any", false, false, false, 47) && CoreExtension::getAttribute($this->env, $this->source, (isset($context["cours"]) || array_key_exists("cours", $context) ? $context["cours"] : (function () { throw new RuntimeError('Variable "cours" does not exist.', 47, $this->source); })()), "isUserEnrolled", [CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 47, $this->source); })()), "user", [], "any", false, false, false, 47)], "method", false, false, false, 47))) {
                // line 48
                yield "                                        <div class=\"mt-4\">
                                            <a href=\"";
                // line 49
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_cours_pdf", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["cours"]) || array_key_exists("cours", $context) ? $context["cours"] : (function () { throw new RuntimeError('Variable "cours" does not exist.', 49, $this->source); })()), "id", [], "any", false, false, false, 49)]), "html", null, true);
                yield "\" class=\"btn btn-primary\" target=\"_blank\">
                                                <i class=\"fa fa-file-pdf me-2\"></i>Download Course Material
                                            </a>
                                        </div>
                                    ";
            } else {
                // line 54
                yield "                                        <div class=\"mt-4\">
                                            <div class=\"alert alert-info\">
                                                <i class=\"fa fa-info-circle me-2\"></i>
                                                ";
                // line 57
                if ( !CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 57, $this->source); })()), "user", [], "any", false, false, false, 57)) {
                    // line 58
                    yield "                                                    Please <a href=\"";
                    yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_login");
                    yield "\">login</a> and enroll in this course to access the course materials.
                                                ";
                } else {
                    // line 60
                    yield "                                                    Enroll in this course to access the course materials.
                                                ";
                }
                // line 62
                yield "                                            </div>
                                        </div>
                                    ";
            }
            // line 65
            yield "                                ";
        }
        // line 66
        yield "                                <div class=\"row g-4\">
                                    <div class=\"col-6\">
                                        <div class=\"d-flex align-items-center mb-3\">
                                            <i class=\"fa fa-clock text-primary me-2\"></i>
                                            <small>";
        // line 70
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["cours"]) || array_key_exists("cours", $context) ? $context["cours"] : (function () { throw new RuntimeError('Variable "cours" does not exist.', 70, $this->source); })()), "duree", [], "any", false, false, false, 70), "html", null, true);
        yield "</small>
                                        </div>
                                        <div class=\"d-flex align-items-center mb-3\">
                                            <i class=\"fa fa-signal text-primary me-2\"></i>
                                            <small>";
        // line 74
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["cours"]) || array_key_exists("cours", $context) ? $context["cours"] : (function () { throw new RuntimeError('Variable "cours" does not exist.', 74, $this->source); })()), "niveau", [], "any", false, false, false, 74), "html", null, true);
        yield "</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Registration Form -->
                <div class=\"col-lg-4 wow fadeInUp\" data-wow-delay=\"0.3s\">
                    <div class=\"bg-light rounded p-4\">
                        <h4 class=\"mb-4 text-primary text-center\">Register for this Course</h4>
                        
                        ";
        // line 88
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 88, $this->source); })()), "flashes", [], "any", false, false, false, 88));
        foreach ($context['_seq'] as $context["label"] => $context["messages"]) {
            // line 89
            yield "                            ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 90
                yield "                                <div class=\"alert alert-";
                yield ((($context["label"] == "error")) ? ("danger") : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"], "html", null, true)));
                yield "\">
                                    ";
                // line 91
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
                yield "
                                </div>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 94
            yield "                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['label'], $context['messages'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 95
        yield "
                        ";
        // line 96
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["inscriptionForm"]) || array_key_exists("inscriptionForm", $context) ? $context["inscriptionForm"] : (function () { throw new RuntimeError('Variable "inscriptionForm" does not exist.', 96, $this->source); })()), 'form_start', ["attr" => ["class" => "needs-validation", "novalidate" => "novalidate"]]);
        yield "
                            <div class=\"mb-3\">
                                ";
        // line 98
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["inscriptionForm"]) || array_key_exists("inscriptionForm", $context) ? $context["inscriptionForm"] : (function () { throw new RuntimeError('Variable "inscriptionForm" does not exist.', 98, $this->source); })()), "nom", [], "any", false, false, false, 98), 'label', ["label_attr" => ["class" => "form-label"]]);
        yield "
                                ";
        // line 99
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["inscriptionForm"]) || array_key_exists("inscriptionForm", $context) ? $context["inscriptionForm"] : (function () { throw new RuntimeError('Variable "inscriptionForm" does not exist.', 99, $this->source); })()), "nom", [], "any", false, false, false, 99), 'widget', ["attr" => ["class" => ("form-control" . ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["inscriptionForm"]) || array_key_exists("inscriptionForm", $context) ? $context["inscriptionForm"] : (function () { throw new RuntimeError('Variable "inscriptionForm" does not exist.', 99, $this->source); })()), "nom", [], "any", false, false, false, 99), "vars", [], "any", false, false, false, 99), "valid", [], "any", false, false, false, 99)) ? ("") : (" is-invalid")))]]);
        yield "
                                ";
        // line 100
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["inscriptionForm"]) || array_key_exists("inscriptionForm", $context) ? $context["inscriptionForm"] : (function () { throw new RuntimeError('Variable "inscriptionForm" does not exist.', 100, $this->source); })()), "nom", [], "any", false, false, false, 100), 'errors', ["attr" => ["class" => "invalid-feedback"]]);
        yield "
                            </div>
                            <div class=\"mb-3\">
                                ";
        // line 103
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["inscriptionForm"]) || array_key_exists("inscriptionForm", $context) ? $context["inscriptionForm"] : (function () { throw new RuntimeError('Variable "inscriptionForm" does not exist.', 103, $this->source); })()), "email", [], "any", false, false, false, 103), 'label', ["label_attr" => ["class" => "form-label"]]);
        yield "
                                ";
        // line 104
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["inscriptionForm"]) || array_key_exists("inscriptionForm", $context) ? $context["inscriptionForm"] : (function () { throw new RuntimeError('Variable "inscriptionForm" does not exist.', 104, $this->source); })()), "email", [], "any", false, false, false, 104), 'widget', ["attr" => ["class" => ("form-control" . ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["inscriptionForm"]) || array_key_exists("inscriptionForm", $context) ? $context["inscriptionForm"] : (function () { throw new RuntimeError('Variable "inscriptionForm" does not exist.', 104, $this->source); })()), "email", [], "any", false, false, false, 104), "vars", [], "any", false, false, false, 104), "valid", [], "any", false, false, false, 104)) ? ("") : (" is-invalid")))]]);
        yield "
                                ";
        // line 105
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["inscriptionForm"]) || array_key_exists("inscriptionForm", $context) ? $context["inscriptionForm"] : (function () { throw new RuntimeError('Variable "inscriptionForm" does not exist.', 105, $this->source); })()), "email", [], "any", false, false, false, 105), 'errors', ["attr" => ["class" => "invalid-feedback"]]);
        yield "
                            </div>
                            <div class=\"mb-3\">
                                ";
        // line 108
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["inscriptionForm"]) || array_key_exists("inscriptionForm", $context) ? $context["inscriptionForm"] : (function () { throw new RuntimeError('Variable "inscriptionForm" does not exist.', 108, $this->source); })()), "telephone", [], "any", false, false, false, 108), 'label', ["label_attr" => ["class" => "form-label"]]);
        yield "
                                ";
        // line 109
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["inscriptionForm"]) || array_key_exists("inscriptionForm", $context) ? $context["inscriptionForm"] : (function () { throw new RuntimeError('Variable "inscriptionForm" does not exist.', 109, $this->source); })()), "telephone", [], "any", false, false, false, 109), 'widget', ["attr" => ["class" => ("form-control" . ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["inscriptionForm"]) || array_key_exists("inscriptionForm", $context) ? $context["inscriptionForm"] : (function () { throw new RuntimeError('Variable "inscriptionForm" does not exist.', 109, $this->source); })()), "telephone", [], "any", false, false, false, 109), "vars", [], "any", false, false, false, 109), "valid", [], "any", false, false, false, 109)) ? ("") : (" is-invalid")))]]);
        yield "
                                ";
        // line 110
        yield $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(CoreExtension::getAttribute($this->env, $this->source, (isset($context["inscriptionForm"]) || array_key_exists("inscriptionForm", $context) ? $context["inscriptionForm"] : (function () { throw new RuntimeError('Variable "inscriptionForm" does not exist.', 110, $this->source); })()), "telephone", [], "any", false, false, false, 110), 'errors', ["attr" => ["class" => "invalid-feedback"]]);
        yield "
                            </div>
                            <button type=\"submit\" class=\"btn btn-primary w-100\">Register Now</button>
                        ";
        // line 113
        yield         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["inscriptionForm"]) || array_key_exists("inscriptionForm", $context) ? $context["inscriptionForm"] : (function () { throw new RuntimeError('Variable "inscriptionForm" does not exist.', 113, $this->source); })()), 'form_end');
        yield "
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Course Detail End -->
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
        return "cours/show.html.twig";
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
        return array (  319 => 113,  313 => 110,  309 => 109,  305 => 108,  299 => 105,  295 => 104,  291 => 103,  285 => 100,  281 => 99,  277 => 98,  272 => 96,  269 => 95,  263 => 94,  254 => 91,  249 => 90,  244 => 89,  240 => 88,  223 => 74,  216 => 70,  210 => 66,  207 => 65,  202 => 62,  198 => 60,  192 => 58,  190 => 57,  185 => 54,  177 => 49,  174 => 48,  171 => 47,  169 => 46,  164 => 44,  159 => 43,  153 => 41,  151 => 40,  146 => 38,  142 => 37,  135 => 33,  114 => 15,  110 => 14,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Course Details - DevSphere{% endblock %}

{% block content %}
    <!-- Header Start -->
    <div class=\"container-fluid bg-primary py-5 mb-5 page-header\">
        <div class=\"container py-5\">
            <div class=\"row justify-content-center\">
                <div class=\"col-lg-10 text-center\">
                    <h1 class=\"display-3 text-white animated slideInDown\">Course Details</h1>
                    <nav aria-label=\"breadcrumb\">
                        <ol class=\"breadcrumb justify-content-center\">
                            <li class=\"breadcrumb-item\"><a class=\"text-white\" href=\"{{ path('app_home') }}\">Home</a></li>
                            <li class=\"breadcrumb-item\"><a class=\"text-white\" href=\"{{ path('app_cours_index') }}\">Courses</a></li>
                            <li class=\"breadcrumb-item text-white active\" aria-current=\"page\">Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Course Detail Start -->
    <div class=\"container-xxl py-5\">
        <div class=\"container\">
            <div class=\"row g-5\">
                <!-- Course Details -->
                <div class=\"col-lg-8 wow fadeInUp\" data-wow-delay=\"0.1s\">
                    <div class=\"course-item bg-light\">
                        <div class=\"position-relative overflow-hidden\">
                            <img class=\"img-fluid\" src=\"{{ asset('img/course-1.jpg') }}\" alt=\"Course Image\">
                        </div>
                        <div class=\"p-4\">
                            <div class=\"course-details\">
                                <h3>{{ cours.titre }}</h3>
                                <p>{{ cours.description }}</p>
                                <div class=\"course-meta\">
                                    {% if cours.instructeur %}
                                        <p><i class=\"fa fa-user-tie text-primary me-2\"></i>{{ cours.instructeur }}</p>
                                    {% endif %}
                                    <p><i class=\"fa fa-clock text-primary me-2\"></i>{{ cours.duree }}</p>
                                    <p><i class=\"fa fa-graduation-cap text-primary me-2\"></i>{{ cours.niveau }}</p>
                                </div>
                                {% if cours.pdfFilename %}
                                    {% if app.user and cours.isUserEnrolled(app.user) %}
                                        <div class=\"mt-4\">
                                            <a href=\"{{ path('app_cours_pdf', {'id': cours.id}) }}\" class=\"btn btn-primary\" target=\"_blank\">
                                                <i class=\"fa fa-file-pdf me-2\"></i>Download Course Material
                                            </a>
                                        </div>
                                    {% else %}
                                        <div class=\"mt-4\">
                                            <div class=\"alert alert-info\">
                                                <i class=\"fa fa-info-circle me-2\"></i>
                                                {% if not app.user %}
                                                    Please <a href=\"{{ path('app_login') }}\">login</a> and enroll in this course to access the course materials.
                                                {% else %}
                                                    Enroll in this course to access the course materials.
                                                {% endif %}
                                            </div>
                                        </div>
                                    {% endif %}
                                {% endif %}
                                <div class=\"row g-4\">
                                    <div class=\"col-6\">
                                        <div class=\"d-flex align-items-center mb-3\">
                                            <i class=\"fa fa-clock text-primary me-2\"></i>
                                            <small>{{ cours.duree }}</small>
                                        </div>
                                        <div class=\"d-flex align-items-center mb-3\">
                                            <i class=\"fa fa-signal text-primary me-2\"></i>
                                            <small>{{ cours.niveau }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Registration Form -->
                <div class=\"col-lg-4 wow fadeInUp\" data-wow-delay=\"0.3s\">
                    <div class=\"bg-light rounded p-4\">
                        <h4 class=\"mb-4 text-primary text-center\">Register for this Course</h4>
                        
                        {% for label, messages in app.flashes %}
                            {% for message in messages %}
                                <div class=\"alert alert-{{ label == 'error' ? 'danger' : label }}\">
                                    {{ message }}
                                </div>
                            {% endfor %}
                        {% endfor %}

                        {{ form_start(inscriptionForm, {'attr': {'class': 'needs-validation', 'novalidate': 'novalidate'}}) }}
                            <div class=\"mb-3\">
                                {{ form_label(inscriptionForm.nom, null, {'label_attr': {'class': 'form-label'}}) }}
                                {{ form_widget(inscriptionForm.nom, {'attr': {'class': 'form-control' ~ (inscriptionForm.nom.vars.valid ? '' : ' is-invalid')}}) }}
                                {{ form_errors(inscriptionForm.nom, {'attr': {'class': 'invalid-feedback'}}) }}
                            </div>
                            <div class=\"mb-3\">
                                {{ form_label(inscriptionForm.email, null, {'label_attr': {'class': 'form-label'}}) }}
                                {{ form_widget(inscriptionForm.email, {'attr': {'class': 'form-control' ~ (inscriptionForm.email.vars.valid ? '' : ' is-invalid')}}) }}
                                {{ form_errors(inscriptionForm.email, {'attr': {'class': 'invalid-feedback'}}) }}
                            </div>
                            <div class=\"mb-3\">
                                {{ form_label(inscriptionForm.telephone, null, {'label_attr': {'class': 'form-label'}}) }}
                                {{ form_widget(inscriptionForm.telephone, {'attr': {'class': 'form-control' ~ (inscriptionForm.telephone.vars.valid ? '' : ' is-invalid')}}) }}
                                {{ form_errors(inscriptionForm.telephone, {'attr': {'class': 'invalid-feedback'}}) }}
                            </div>
                            <button type=\"submit\" class=\"btn btn-primary w-100\">Register Now</button>
                        {{ form_end(inscriptionForm) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Course Detail End -->
{% endblock %}
", "cours/show.html.twig", "C:\\Users\\maram\\pi_symfony_DevSphere1\\templates\\cours\\show.html.twig");
    }
}
